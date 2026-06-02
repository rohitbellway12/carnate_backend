<?php

namespace App\Livewire\Workshop;

use App\Models\JobCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

#[Layout('components.layouts.workshop-app')]
class JobCardsReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public int $workshopId;
    public string $search = '';
    public int $perPage = 10;
    public ?int $viewJobCardId = null;

    // 🔍 Additional Filters
    public ?string $filterType = ''; // daily, weekly, monthly
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public ?string $status = null;
    public function mount(): void
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterType(): void
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
        } else {
            $this->fromDate = null;
            $this->toDate = null;
        }
    }

    private function getFilteredQuery()
    {
        // return JobCard::with(['customer', 'vehicle', 'jobCardSpareParts'])
        return JobCard::with([
            'customer',
            'vehicle.brand',
            'vehicle.vehicletype',
            'jobCardSpareParts',
            'labours' => function ($q) {
                $q->leftJoin('work_shop_vendor as w', 'w.id', '=', 'job_card_extra_charges.machanic_id')
                  ->select('job_card_extra_charges.*', DB::raw("TRIM(CONCAT(COALESCE(w.name,''),' ',COALESCE(w.lastname,''))) as mechanic_name"));
            }
        ])->where('user_id', $this->workshopId)
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
            ->when($this->status, function ($q) {
                $q->where('status', $this->status);
            })
            ->orderBy('created_at', 'desc');
    }

    public function viewJobCard(int $jobcardId): void
    {
        $this->viewJobCardId = $jobcardId;
    }

    public function render()
    {
        $baseQuery = $this->getFilteredQuery();
        $jobcards = (clone $baseQuery)->paginate($this->perPage);

        $detail = null;
        if ($this->viewJobCardId) {
            $detail = (clone $baseQuery)->find($this->viewJobCardId);
            if ($detail) {
                $detail->labours = DB::table('job_card_extra_charges as l')
                    ->leftJoin('work_shop_vendor as w', 'w.id', '=', 'l.machanic_id')
                    ->where('l.jobcard_id', $detail->id)
                    ->select('l.*', DB::raw("TRIM(CONCAT(COALESCE(w.name,''),' ',COALESCE(w.lastname,''))) as mechanic_name"))
                    ->get();
            }
        }

        // ✅ Totals (with filters)
        $allIds = (clone $baseQuery)->pluck('id');
        $total = $allIds->count();

        $statusCounts = DB::table('job_cards')
            ->select('status', DB::raw('COUNT(*) as cnt'))
            ->whereIn('id', $allIds)
            ->groupBy('status')
            ->pluck('cnt', 'status');

        $open = (int) ($statusCounts[0] ?? 0);
        $confirmed = (int) ($statusCounts[1] ?? 0);
        $completed = (int) ($statusCounts[2] ?? 0);
        $closed = (int) ($statusCounts[3] ?? 0);
        $totalAmount = (clone $baseQuery)->sum(DB::raw('COALESCE(final_amount, amount, 0)'));

        $totals = [
            'total' => $total,
            'open' => $open,
            'confirmed' => $confirmed,
            'completed' => $completed,
            'closed' => $closed,
            'amount' => (float) $totalAmount,
        ];

        return view('livewire.workshop.jobcards-report', [
            'jobcards' => $jobcards,
            'detail' => $detail,
            'totals' => $totals,
        ]);
    }

    // PDF Export (with same filters)
    public function downloadPDF()
    {
        $baseQuery = $this->getFilteredQuery();
        $jobcards = (clone $baseQuery)->get();

        $allIds = (clone $baseQuery)->pluck('id');
        $total = $allIds->count();

        $statusCounts = DB::table('job_cards')
            ->select('status', DB::raw('COUNT(*) as cnt'))
            ->whereIn('id', $allIds)
            ->groupBy('status')
            ->pluck('cnt', 'status');

        $open = (int) ($statusCounts[0] ?? 0);
        $confirmed = (int) ($statusCounts[1] ?? 0);
        $completed = (int) ($statusCounts[2] ?? 0);
        $closed = (int) ($statusCounts[3] ?? 0);
        $totalAmount = (clone $baseQuery)->sum(DB::raw('COALESCE(final_amount, amount, 0)'));

        $totals = [
            'total' => $total,
            'open' => $open,
            'confirmed' => $confirmed,
            'completed' => $completed,
            'closed' => $closed,
            'amount' => (float) $totalAmount,
        ];
        //dd($jobcards,$baseQuery);
        $pdf = Pdf::loadView('livewire.workshop.pdf.jobcards-report', [
            'jobcards' => $jobcards,
            'totals' => $totals,
            'search' => $this->search,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'filterType' => $this->filterType,
        ])->setPaper('a4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);
        return response()->streamDownload(
            fn() => print($pdf->output()),
            'jobcards-report.pdf'
        );
    }
}
