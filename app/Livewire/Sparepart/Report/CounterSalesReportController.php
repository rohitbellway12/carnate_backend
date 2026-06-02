<?php

namespace App\Livewire\Sparepart\Report;

use App\Models\CounterSale;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.spare-part-app')]
class CounterSalesReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public string $search = '';
    public int $perPage = 10;

    // Filters
    public ?string $filterType = null; // daily, weekly, monthly
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public string $statusFilter = ''; // status: 0 (Un-paid), 1 (Partial Payment), 2 (Full Paid)

    public ?int $viewSaleId = null;

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingFilterType(): void { $this->resetPage(); }
    public function updatingFromDate(): void { $this->resetPage(); }
    public function updatingToDate(): void { $this->resetPage(); }
    public function updatingStatusFilter(): void { $this->resetPage(); }

    public function viewSale(int $saleId): void
    {
        $this->viewSaleId = $saleId;
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
        $vendorId = Auth::guard('sparepart')->user()->id;

        return CounterSale::query()
            ->with(['Customer', 'counterSalesSpareParts'])
            ->where('type', 0)
            ->where('sparepart_id', $vendorId)
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->where('countersale_number', 'LIKE', "%$s%")
                        ->orWhereHas('Customer', function ($cQ) use ($s) {
                            $cQ->where('name', 'LIKE', "%$s%")
                               ->orWhere('mobile_no', 'LIKE', "%$s%");
                        });
                });
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereRaw('DATE(date) BETWEEN ? AND ?', [$startDate, $endDate]);
            })
            ->when($this->statusFilter !== '', function ($q) {
                $q->where('status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc');
    }

    public function downloadExcel()
    {
        $query = $this->getBaseQuery();
        $sales = $query->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=counter-sales-report.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($sales) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['#', 'Invoice No.', 'Customer Name', 'Mobile', 'Billing Date', 'Subtotal (₹)', 'Total Discount (₹)', 'Net Total (₹)', 'Paid Amount (₹)', 'Balance (₹)', 'Status']);

            foreach ($sales as $index => $s) {
                $discount = (float)$s->total - (float)$s->subtotal;
                $status = match ((int)$s->status) {
                    1 => 'Partially Paid',
                    2 => 'Fully Paid',
                    default => 'Un-paid',
                };

                fputcsv($file, [
                    $index + 1,
                    $s->countersale_number,
                    $s->Customer->name ?? 'N/A',
                    $s->Customer->mobile_no ?? 'N/A',
                    $s->date ? \Carbon\Carbon::parse($s->date)->format('d M Y') : 'N/A',
                    (float)$s->total,
                    round($discount, 2),
                    (float)$s->subtotal,
                    (float)$s->partial_amount,
                    (float)$s->balance_amount,
                    $status
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'counter-sales-report.csv', $headers);
    }

    public function downloadPDF()
    {
        $query = $this->getBaseQuery();
        $sales = $query->get();

        $totals = [
            'total' => $sales->count(),
            'unpaid' => $sales->where('status', 0)->count(),
            'partial' => $sales->where('status', 1)->count(),
            'paid' => $sales->where('status', 2)->count(),
            'total_amount' => (float)$sales->sum(fn($s) => (float)$s->subtotal),
            'paid_amount' => (float)$sales->sum(fn($s) => (float)$s->partial_amount),
            'balance_amount' => (float)$sales->sum(fn($s) => (float)$s->balance_amount),
        ];

        $pdf = Pdf::loadView('livewire.sparepart.report.pdf.counter-sales-report', [
            'sales' => $sales,
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
            'counter-sales-report.pdf'
        );
    }

    public function render()
    {
        $query = $this->getBaseQuery();
        $sales = $query->paginate($this->perPage);

        // Stats summary
        $allSales = $this->getBaseQuery()->get();
        $totals = [
            'total' => $allSales->count(),
            'unpaid' => $allSales->where('status', 0)->count(),
            'partial' => $allSales->where('status', 1)->count(),
            'paid' => $allSales->where('status', 2)->count(),
            'total_amount' => (float)$allSales->sum(fn($s) => (float)$s->subtotal),
            'paid_amount' => (float)$allSales->sum(fn($s) => (float)$s->partial_amount),
            'balance_amount' => (float)$allSales->sum(fn($s) => (float)$s->balance_amount),
        ];

        $selectedSale = null;
        if ($this->viewSaleId) {
            $selectedSale = CounterSale::with(['Customer', 'counterSalesSpareParts'])->find($this->viewSaleId);
        }

        return view('livewire.sparepart.report.counter-sales-report', compact('sales', 'totals', 'selectedSale'));
    }
}
