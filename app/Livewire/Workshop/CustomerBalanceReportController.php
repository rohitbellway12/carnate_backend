<?php

namespace App\Livewire\Workshop;

use App\Models\Customer;
use App\Models\JobCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

#[Layout('components.layouts.workshop-app')]
class CustomerBalanceReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public int $workshopId;
    public string $search = '';
    public int $perPage = 10;

    // Filter properties
    public ?string $filterType = null; // daily, weekly, monthly
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public string $balanceFilter = 'has_balance'; // 'all', 'has_balance'

    public ?int $viewCustomerId = null;

    public function mount(): void
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
    }

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingFilterType(): void { $this->resetPage(); }
    public function updatingFromDate(): void { $this->resetPage(); }
    public function updatingToDate(): void { $this->resetPage(); }
    public function updatingBalanceFilter(): void { $this->resetPage(); }

    public function viewCustomerBalances(int $customerId): void
    {
        $this->viewCustomerId = $customerId;
        $this->dispatch('show-customer-balance-modal');
    }

    private function getDateRange(): array
    {
        $today = now();

        if (!empty($this->fromDate) && !empty($this->toDate)) {
            return [$this->fromDate, $this->toDate];
        }

        return match ($this->filterType) {
            'daily'   => [$today->toDateString(), $today->toDateString()],
            'weekly'  => [$today->startOfWeek()->toDateString(), $today->endOfWeek()->toDateString()],
            'monthly' => [$today->startOfMonth()->toDateString(), $today->endOfMonth()->toDateString()],
            default   => [null, null],
        };
    }

    private function getBaseQuery($startDate, $endDate)
    {
        return Customer::query()
            ->where('customers.user_id', $this->workshopId)
            ->select('customers.*')
            ->selectSub(function ($q) use ($startDate, $endDate) {
                $q->from('job_cards')
                    ->whereColumn('job_cards.customer_id', 'customers.id')
                    ->where('job_cards.soft_delete', 0)
                    ->when($startDate && $endDate, function ($qq) use ($startDate, $endDate) {
                        $qq->whereBetween('job_cards.created_at', [
                            Carbon::parse($startDate)->startOfDay(),
                            Carbon::parse($endDate)->endOfDay()
                        ]);
                    })
                    ->selectRaw('COALESCE(SUM(COALESCE(final_amount, amount, 0)), 0)');
            }, 'total_bill')
            ->selectSub(function ($q) use ($startDate, $endDate) {
                $q->from('job_cards')
                    ->whereColumn('job_cards.customer_id', 'customers.id')
                    ->where('job_cards.soft_delete', 0)
                    ->when($startDate && $endDate, function ($qq) use ($startDate, $endDate) {
                        $qq->whereBetween('job_cards.created_at', [
                            Carbon::parse($startDate)->startOfDay(),
                            Carbon::parse($endDate)->endOfDay()
                        ]);
                    })
                    ->selectRaw('COALESCE(SUM(COALESCE(final_paid, 0)), 0)');
            }, 'total_paid')
            ->selectSub(function ($q) use ($startDate, $endDate) {
                $q->from('job_cards')
                    ->whereColumn('job_cards.customer_id', 'customers.id')
                    ->where('job_cards.soft_delete', 0)
                    ->when($startDate && $endDate, function ($qq) use ($startDate, $endDate) {
                        $qq->whereBetween('job_cards.created_at', [
                            Carbon::parse($startDate)->startOfDay(),
                            Carbon::parse($endDate)->endOfDay()
                        ]);
                    })
                    ->selectRaw('COALESCE(SUM(COALESCE(balance_amount, 0)), 0)');
            }, 'total_balance')
            ->selectSub(function ($q) use ($startDate, $endDate) {
                $q->from('job_cards')
                    ->whereColumn('job_cards.customer_id', 'customers.id')
                    ->where('job_cards.soft_delete', 0)
                    ->when($startDate && $endDate, function ($qq) use ($startDate, $endDate) {
                        $qq->whereBetween('job_cards.created_at', [
                            Carbon::parse($startDate)->startOfDay(),
                            Carbon::parse($endDate)->endOfDay()
                        ]);
                    })
                    ->selectRaw('COUNT(*)');
            }, 'jobcards_count')
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($qq) use ($s) {
                    $qq->whereRaw("CONCAT(name,' ',lastname) LIKE ?", ["%$s%"])
                      ->orWhere('email', 'LIKE', "%$s%")
                      ->orWhere('mobile_no', 'LIKE', "%$s%");
                });
            })
            ->when($this->balanceFilter === 'has_balance', function ($q) {
                $q->having('total_balance', '>', 0);
            });
    }

    public function render()
    {
        [$startDate, $endDate] = $this->getDateRange();

        $baseQuery = $this->getBaseQuery($startDate, $endDate);

        // Fetch totals
        $totalsQuery = clone $baseQuery;
        // In order to perform SUM aggregates on alias fields, we wrap the query as a subquery.
        $allStats = DB::table(DB::raw("({$totalsQuery->toSql()}) as sub"))
            ->mergeBindings($totalsQuery->getQuery())
            ->selectRaw('COUNT(*) as total_customers, SUM(total_bill) as total_bill, SUM(total_paid) as total_paid, SUM(total_balance) as total_balance')
            ->first();

        $totals = [
            'total_customers' => $allStats ? (int) $allStats->total_customers : 0,
            'total_bill' => $allStats ? (float) $allStats->total_bill : 0.0,
            'total_paid' => $allStats ? (float) $allStats->total_paid : 0.0,
            'total_balance' => $allStats ? (float) $allStats->total_balance : 0.0,
        ];

        $customers = $baseQuery->orderBy('total_balance', 'desc')->paginate($this->perPage);

        // Details modal data
        $detail = null;
        $customerJobCards = [];
        if ($this->viewCustomerId) {
            $detail = Customer::where('user_id', $this->workshopId)->find($this->viewCustomerId);
            if ($detail) {
                $customerJobCards = JobCard::where('customer_id', $this->viewCustomerId)
                    ->where('user_id', $this->workshopId)
                    ->where('soft_delete', 0)
                    ->when($startDate && $endDate, function ($qq) use ($startDate, $endDate) {
                        $qq->whereBetween('created_at', [
                            Carbon::parse($startDate)->startOfDay(),
                            Carbon::parse($endDate)->endOfDay()
                        ]);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }

        return view('livewire.workshop.customer-balance-report', [
            'customers' => $customers,
            'totals' => $totals,
            'detail' => $detail,
            'customerJobCards' => $customerJobCards,
        ]);
    }

    public function downloadPDF()
    {
        [$startDate, $endDate] = $this->getDateRange();

        $baseQuery = $this->getBaseQuery($startDate, $endDate);

        $totalsQuery = clone $baseQuery;
        $allStats = DB::table(DB::raw("({$totalsQuery->toSql()}) as sub"))
            ->mergeBindings($totalsQuery->getQuery())
            ->selectRaw('COUNT(*) as total_customers, SUM(total_bill) as total_bill, SUM(total_paid) as total_paid, SUM(total_balance) as total_balance')
            ->first();

        $totals = [
            'total_customers' => $allStats ? (int) $allStats->total_customers : 0,
            'total_bill' => $allStats ? (float) $allStats->total_bill : 0.0,
            'total_paid' => $allStats ? (float) $allStats->total_paid : 0.0,
            'total_balance' => $allStats ? (float) $allStats->total_balance : 0.0,
        ];

        $customers = $baseQuery->orderBy('total_balance', 'desc')->get();

        $pdf = Pdf::loadView('livewire.workshop.pdf.customer-balance-report', [
            'customers' => $customers,
            'totals' => $totals,
            'filterType' => $this->filterType,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'search' => $this->search,
            'balanceFilter' => $this->balanceFilter,
        ])->setPaper('a4', 'portrait');

        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'customer-balance-report.pdf'
        );
    }
}
