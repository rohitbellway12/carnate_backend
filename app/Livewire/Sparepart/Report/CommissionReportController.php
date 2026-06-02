<?php

namespace App\Livewire\Sparepart\Report;

use App\Models\OrderItem;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.spare-part-app')]
class CommissionReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public string $search = '';
    public int $perPage = 10;

    // Filters
    public ?string $filterType = null;
    public ?string $fromDate = null;
    public ?string $toDate = null;

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingFilterType(): void { $this->resetPage(); }
    public function updatingFromDate(): void { $this->resetPage(); }
    public function updatingToDate(): void { $this->resetPage(); }

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

        return OrderItem::query()
            ->with(['order', 'SpareParts'])
            ->where('user_id', $vendorId)
            ->whereIn('status', [1, 3, 4])
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->where('order_id', 'LIKE', "%$s%")
                        ->orWhereHas('SpareParts', function ($pQ) use ($s) {
                            $pQ->where('name', 'LIKE', "%$s%");
                        })
                        ->orWhereHas('order', function ($oQ) use ($s) {
                            $oQ->where('invoice_number', 'LIKE', "%$s%")
                                ->orWhere('id', 'LIKE', "%$s%");
                        });
                });
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereRaw('DATE(created_at) BETWEEN ? AND ?', [$startDate, $endDate]);
            })
            ->orderBy('created_at', 'desc');
    }

    public function downloadExcel()
    {
        $query = $this->getBaseQuery();
        $items = $query->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=commission-report.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($items) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, [
                '#', 
                'Order ID', 
                'Order Date', 
                'Invoice No.', 
                'Part Name', 
                'Gross Total (₹)', 
                'Commission Rate (%)', 
                'Commission Deducted (₹)', 
                'Net Payout / Settled (₹)',
                'Status'
            ]);

            foreach ($items as $index => $item) {
                $commissionPercent = (float) getCommission($item->category);
                $grossAmount = (float) $item->total_amount;
                $commissionAmount = ($grossAmount * $commissionPercent) / 100;
                $netAmount = $grossAmount - $commissionAmount;

                $statusText = match ($item->status) {
                    1 => 'Accepted',
                    3 => 'Handover',
                    4 => 'Received',
                    default => 'N/A'
                };

                fputcsv($file, [
                    $index + 1,
                    '#' . $item->order_id,
                    $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y, h:i A') : 'N/A',
                    sparepartOrderReference($item->order),
                    $item->SpareParts->name ?? 'N/A',
                    round($grossAmount, 2),
                    $commissionPercent . '%',
                    round($commissionAmount, 2),
                    round($netAmount, 2),
                    $statusText
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'commission-report.csv', $headers);
    }

    public function downloadPDF()
    {
        $query = $this->getBaseQuery();
        $items = $query->get();

        $totals = [
            'total_items' => $items->count(),
            'total_gross' => 0.0,
            'total_commission' => 0.0,
            'total_net' => 0.0,
        ];

        foreach ($items as $item) {
            $commissionPercent = (float) getCommission($item->category);
            $grossAmount = (float) $item->total_amount;
            $commissionAmount = ($grossAmount * $commissionPercent) / 100;
            $netAmount = $grossAmount - $commissionAmount;

            $totals['total_gross'] += $grossAmount;
            $totals['total_commission'] += $commissionAmount;
            $totals['total_net'] += $netAmount;
        }

        $pdf = Pdf::loadView('livewire.sparepart.report.pdf.commission-report', [
            'items' => $items,
            'totals' => $totals,
            'filterType' => $this->filterType,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'search' => $this->search,
        ])->setPaper('a4', 'landscape');

        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'commission-report.pdf'
        );
    }

    public function render()
    {
        $query = $this->getBaseQuery();
        $items = $query->paginate($this->perPage);

        // Stats summary
        $allItems = $this->getBaseQuery()->get();
        $totals = [
            'total_items' => $allItems->count(),
            'total_gross' => 0.0,
            'total_commission' => 0.0,
            'total_net' => 0.0,
        ];

        foreach ($allItems as $item) {
            $commissionPercent = (float) getCommission($item->category);
            $grossAmount = (float) $item->total_amount;
            $commissionAmount = ($grossAmount * $commissionPercent) / 100;
            $netAmount = $grossAmount - $commissionAmount;

            $totals['total_gross'] += $grossAmount;
            $totals['total_commission'] += $commissionAmount;
            $totals['total_net'] += $netAmount;
        }

        return view('livewire.sparepart.report.commission-report', compact('items', 'totals'));
    }
}
