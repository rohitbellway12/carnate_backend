<?php

namespace App\Livewire\Workshop;

use App\Models\JobCard;
use App\Models\JobCardExtraCharge;
use App\Models\JobCardSparePart;
use App\Models\CounterSale;
use App\Models\CounterSaleSparePart;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

#[Layout('components.layouts.workshop-app')]
class ProfitReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public int $workshopId;
    public string $search = '';
    public int $perPage = 10;

    // Filters
    public ?string $filterType = 'monthly'; // daily, weekly, monthly, all, custom
    public ?string $fromDate = null;
    public ?string $toDate = null;

    public function mount(): void
    {
        $this->workshopId = (int) Auth::guard('workshop')->user()->id;
        $this->setFilterDates();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterType(): void
    {
        $this->setFilterDates();
        $this->resetPage();
    }

    public function updatedFromDate(): void
    {
        $this->filterType = 'custom';
        $this->resetPage();
    }

    public function updatedToDate(): void
    {
        $this->filterType = 'custom';
        $this->resetPage();
    }

    private function setFilterDates(): void
    {
        if ($this->filterType === 'daily') {
            $this->fromDate = Carbon::today()->toDateString();
            $this->toDate = Carbon::today()->toDateString();
        } elseif ($this->filterType === 'weekly') {
            $this->fromDate = Carbon::now()->startOfWeek()->toDateString();
            $this->toDate = Carbon::now()->endOfWeek()->toDateString();
        } elseif ($this->filterType === 'monthly') {
            $this->fromDate = Carbon::now()->startOfMonth()->toDateString();
            $this->toDate = Carbon::now()->endOfMonth()->toDateString();
        } elseif ($this->filterType === 'all') {
            $this->fromDate = null;
            $this->toDate = null;
        }
    }

    /**
     * Compute comprehensive financial figures according to user formula:
     * 1) Labour charges + Parts sale + Lubes sale + Accessory sale + Tools sale + Outsource sale = Total (1)
     * Less
     * 2) Parts purchase + Lubes purchase + Accessory purchase + Tools purchase + Outsource purchase + Expenses = Total (2)
     * 1 Total - 2 Total = Profit
     */
    public function getFinancials(): array
    {
        // 1. Get JobCard IDs for this workshop in selected date range
        $jobcardQuery = JobCard::where('user_id', $this->workshopId);
        if ($this->fromDate && $this->toDate) {
            $jobcardQuery->whereBetween(DB::raw('DATE(created_at)'), [$this->fromDate, $this->toDate]);
        }
        $jobcardIds = (clone $jobcardQuery)->pluck('id')->toArray();

        // 2. Extra charges (Labour & Outsource)
        $extraCharges = JobCardExtraCharge::whereIn('jobcard_id', $jobcardIds)->get();

        // Labour charges sale (charge_type = 1 or null)
        $labourChargesSale = (float) $extraCharges->where('charge_type', '!=', 2)->sum(function ($c) {
            return (float) ($c->amount ?? $c->charges ?? 0);
        });

        // Outsource sale (charge_type = 2)
        $outsourceSale = (float) $extraCharges->where('charge_type', 2)->sum(function ($c) {
            return (float) ($c->amount ?? $c->charges ?? 0);
        });

        // Outsource purchase (charge_type = 2 cost paid to outside vendor)
        $outsourcePurchase = (float) $extraCharges->where('charge_type', 2)->sum(function ($c) {
            return (float) ($c->outsource_price ?? 0);
        });

        // 3. Spare parts used in JobCards
        // Categories: 1 => Accessory, 2 => Parts, 3 => Tools, 4 => Lubricants (Lubes)
        $jobcardParts = JobCardSparePart::whereIn('job_card_spare_parts.jobcard_id', $jobcardIds)
            ->leftJoin('spare_part_labels', 'spare_part_labels.id', '=', 'job_card_spare_parts.stock_label_id')
            ->select(
                'job_card_spare_parts.*',
                'spare_part_labels.spare_part_type'
            )
            ->get();

        $partsSale = (float) $jobcardParts->filter(fn($p) => ($p->spare_part_type == 2 || empty($p->spare_part_type)))->sum('final_amount');
        $partsPurchase = (float) $jobcardParts->filter(fn($p) => ($p->spare_part_type == 2 || empty($p->spare_part_type)))->sum(function ($p) {
            $qty = $p->quantity ?: 1;
            return $qty * (float) ($p->purchase_price ?? 0);
        });

        $lubesSale = (float) $jobcardParts->where('spare_part_type', 4)->sum('final_amount');
        $lubesPurchase = (float) $jobcardParts->where('spare_part_type', 4)->sum(function ($p) {
            $qty = $p->quantity ?: 1;
            return $qty * (float) ($p->purchase_price ?? 0);
        });

        $accessorySale = (float) $jobcardParts->where('spare_part_type', 1)->sum('final_amount');
        $accessoryPurchase = (float) $jobcardParts->where('spare_part_type', 1)->sum(function ($p) {
            $qty = $p->quantity ?: 1;
            return $qty * (float) ($p->purchase_price ?? 0);
        });

        $toolsSale = (float) $jobcardParts->where('spare_part_type', 3)->sum('final_amount');
        $toolsPurchase = (float) $jobcardParts->where('spare_part_type', 3)->sum(function ($p) {
            $qty = $p->quantity ?: 1;
            return $qty * (float) ($p->purchase_price ?? 0);
        });

        // 4. Counter Sales (if any exist for this workshop)
        $counterSaleQuery = CounterSale::where('workshop_id', $this->workshopId);
        if ($this->fromDate && $this->toDate) {
            $counterSaleQuery->whereBetween(DB::raw('DATE(date)'), [$this->fromDate, $this->toDate]);
        }
        $counterSaleIds = $counterSaleQuery->pluck('id')->toArray();
        if (!empty($counterSaleIds)) {
            $counterParts = CounterSaleSparePart::whereIn('countersale_id', $counterSaleIds)
                ->leftJoin('spare_part_labels', 'spare_part_labels.id', '=', 'counter_sale_spare_parts.stock_label_id')
                ->select('counter_sale_spare_parts.*', 'spare_part_labels.spare_part_type')
                ->get();

            $partsSale += (float) $counterParts->filter(fn($p) => ($p->spare_part_type == 2 || empty($p->spare_part_type)))->sum('final_amount');
            $lubesSale += (float) $counterParts->where('spare_part_type', 4)->sum('final_amount');
            $accessorySale += (float) $counterParts->where('spare_part_type', 1)->sum('final_amount');
            $toolsSale += (float) $counterParts->where('spare_part_type', 3)->sum('final_amount');
        }

        // 5. Total Sales (1)
        $totalSales = $labourChargesSale + $partsSale + $lubesSale + $accessorySale + $toolsSale + $outsourceSale;

        // 6. Overhead Expenses
        $expenseQuery = Expense::where('parent_id', $this->workshopId);
        if ($this->fromDate && $this->toDate) {
            $expenseQuery->whereBetween(DB::raw('DATE(date)'), [$this->fromDate, $this->toDate]);
        }
        $expenses = (float) $expenseQuery->sum('total_amount');

        // 7. Total Cost & Expenses (2)
        $totalCosts = $partsPurchase + $lubesPurchase + $accessoryPurchase + $toolsPurchase + $outsourcePurchase + $expenses;

        // 8. Net Profit = 1 Total - 2 Total
        $netProfit = $totalSales - $totalCosts;
        $profitMargin = $totalSales > 0 ? round(($netProfit / $totalSales) * 100, 2) : 0;

        return [
            'sales' => [
                'labour_charges' => round($labourChargesSale, 2),
                'parts_sale'     => round($partsSale, 2),
                'lubes_sale'     => round($lubesSale, 2),
                'accessory_sale' => round($accessorySale, 2),
                'tools_sale'     => round($toolsSale, 2),
                'outsource_sale' => round($outsourceSale, 2),
                'total'          => round($totalSales, 2),
            ],
            'costs' => [
                'parts_purchase'     => round($partsPurchase, 2),
                'lubes_purchase'     => round($lubesPurchase, 2),
                'accessory_purchase' => round($accessoryPurchase, 2),
                'tools_purchase'     => round($toolsPurchase, 2),
                'outsource_purchase' => round($outsourcePurchase, 2),
                'expenses'           => round($expenses, 2),
                'total'              => round($totalCosts, 2),
            ],
            'net_profit'    => round($netProfit, 2),
            'profit_margin' => $profitMargin,
            'jobcards_count' => count($jobcardIds),
        ];
    }

    public function downloadPDF()
    {
        $financials = $this->getFinancials();
        $workshop = Auth::guard('workshop')->user();

        $pdf = Pdf::loadView('livewire.workshop.pdf.profit-report', [
            'financials' => $financials,
            'workshop'   => $workshop,
            'fromDate'   => $this->fromDate,
            'toDate'     => $this->toDate,
            'filterType' => $this->filterType,
        ])->setPaper('a4', 'portrait');

        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        $fileName = 'Profit_Loss_Report_' . ($this->fromDate ?? 'all') . '_to_' . ($this->toDate ?? 'all') . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $fileName);
    }

    public function render()
    {
        $financials = $this->getFinancials();

        // Paginated jobcards with individual profit calculation
        $jobcardsQuery = JobCard::with([
            'customer',
            'vehicle',
            'jobCardSpareParts',
            'labours'
        ])
        ->where('user_id', $this->workshopId)
        ->when(trim($this->search) !== '', function ($q) {
            $s = trim($this->search);
            $q->where(function ($qq) use ($s) {
                $qq->where('jobcard_number', 'LIKE', "%$s%")
                    ->orWhere('customer_name', 'LIKE', "%$s%")
                    ->orWhere('vehical_number', 'LIKE', "%$s%");
            });
        })
        ->when($this->fromDate && $this->toDate, function ($q) {
            $q->whereBetween(DB::raw('DATE(created_at)'), [$this->fromDate, $this->toDate]);
        })
        ->orderBy('created_at', 'desc');

        $jobcards = $jobcardsQuery->paginate($this->perPage);

        return view('livewire.workshop.profit-report', [
            'financials' => $financials,
            'jobcards'   => $jobcards,
        ]);
    }
}

