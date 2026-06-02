<?php

namespace App\Livewire\Admin;

use App\Models\JobCard;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class JobCardsReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public string $search = '';
    public int $perPage = 10;

    // Filters
    public ?string $filterType = null; // daily, weekly, monthly
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public string $statusFilter = ''; // 0 = Open, 1 = Confirmed, 2 = Completed, 3 = Closed

    public ?int $viewJobCardId = null;

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingFilterType(): void { $this->resetPage(); }
    public function updatingFromDate(): void { $this->resetPage(); }
    public function updatingToDate(): void { $this->resetPage(); }
    public function updatingStatusFilter(): void { $this->resetPage(); }

    public function viewJobCard(int $jobCardId): void
    {
        $this->viewJobCardId = $jobCardId;
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

    protected function getBaseQuery()
    {
        [$startDate, $endDate] = $this->getDateRange();

        return JobCard::query()
            ->with(['workshop', 'customer', 'vehicle'])
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->where('jobcard_number', 'LIKE', "%$s%")
                        ->orWhere('customer_name', 'LIKE', "%$s%")
                        ->orWhere('vehical_number', 'LIKE', "%$s%")
                        ->orWhereHas('workshop', function ($wQ) use ($s) {
                            $wQ->where('company_name', 'LIKE', "%$s%")
                               ->orWhereRaw("CONCAT(name,' ',lastname) LIKE ?", ["%$s%"]);
                        });
                });
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereBetween('entry_date', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay()
                ]);
            })
            ->when($this->statusFilter !== '', function ($q) {
                $q->where('status', $this->statusFilter);
            })
            ->orderBy('entry_date', 'desc');
    }

    public function downloadExcel()
    {
        $query = $this->getBaseQuery();
        $jobcards = $query->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=job-cards-report.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($jobcards) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['#', 'Job Card #', 'Customer Name', 'Vehicle No', 'Vehicle', 'Workshop', 'Date', 'Final Bill (₹)', 'Paid (Adv) (₹)', 'Balance (₹)', 'Status']);

            foreach ($jobcards as $index => $j) {
                $status = match ($j->status) {
                    1 => 'Confirmed',
                    2 => 'Completed',
                    3 => 'Closed',
                    default => 'Open',
                };

                fputcsv($file, [
                    $index + 1,
                    $j->jobcard_number,
                    $j->customer_name ?? 'N/A',
                    $j->vehical_number ?? 'N/A',
                    $j->vehical ?? 'N/A',
                    $j->workshop->company_name ?? ($j->workshop ? $j->workshop->name.' '.$j->workshop->lastname : 'N/A'),
                    $j->entry_date ? \Carbon\Carbon::parse($j->entry_date)->format('d M Y') : 'N/A',
                    (float)($j->final_amount ?? $j->amount ?? 0),
                    (float)($j->advance ?? 0),
                    (float)($j->balance_amount ?? 0),
                    $status
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'job-cards-report.csv', $headers);
    }

    public function downloadPDF()
    {
        $query = $this->getBaseQuery();
        $jobcards = $query->get();

        // Calculate Totals
        $totals = [
            'total' => $jobcards->count(),
            'open' => $jobcards->where('status', 0)->count(),
            'confirmed' => $jobcards->where('status', 1)->count(),
            'completed' => $jobcards->where('status', 2)->count(),
            'closed' => $jobcards->where('status', 3)->count(),
            'total_amount' => (float) $jobcards->sum(fn($j) => (float)($j->final_amount ?? $j->amount ?? 0)),
            'total_paid' => (float) $jobcards->sum(fn($j) => (float)($j->advance ?? 0)),
            'total_balance' => (float) $jobcards->sum(fn($j) => (float)($j->balance_amount ?? 0)),
        ];

        $pdf = Pdf::loadView('livewire.admin.pdf.jobcards-report', [
            'jobcards' => $jobcards,
            'totals' => $totals,
            'filterType' => $this->filterType,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'statusFilter' => $this->statusFilter,
            'search' => $this->search,
        ])->setPaper('a4', 'landscape');

        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'job-cards-report.pdf'
        );
    }

    public function render()
    {
        $query = $this->getBaseQuery();
        $jobcards = (clone $query)->paginate($this->perPage);

        // Stats calculation
        $allJobCards = (clone $query)->get();
        $totals = [
            'total' => $allJobCards->count(),
            'open' => $allJobCards->where('status', 0)->count(),
            'confirmed' => $allJobCards->where('status', 1)->count(),
            'completed' => $allJobCards->where('status', 2)->count(),
            'closed' => $allJobCards->where('status', 3)->count(),
            'total_amount' => (float) $allJobCards->sum(fn($j) => (float)($j->final_amount ?? $j->amount ?? 0)),
            'total_paid' => (float) $allJobCards->sum(fn($j) => (float)($j->advance ?? 0)),
            'total_balance' => (float) $allJobCards->sum(fn($j) => (float)($j->balance_amount ?? 0)),
        ];

        $detail = null;
        if ($this->viewJobCardId) {
            $detail = JobCard::with(['workshop', 'customer', 'vehicle', 'labours', 'jobCardSpareParts.productStock.sparePart'])->find($this->viewJobCardId);
        }

        return view('livewire.admin.jobcards-report', [
            'jobcards' => $jobcards,
            'totals' => $totals,
            'detail' => $detail,
        ]);
    }
}
