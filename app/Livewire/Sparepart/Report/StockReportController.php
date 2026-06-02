<?php

namespace App\Livewire\Sparepart\Report;

use App\Models\SparePartProductStock;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.spare-part-app')]
class StockReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public string $search = '';
    public int $perPage = 10;

    // Filters
    public string $stockStatusFilter = ''; // '', 'low', 'out', 'in'
    public string $brandFilter = '';

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingStockStatusFilter(): void { $this->resetPage(); }
    public function updatingBrandFilter(): void { $this->resetPage(); }

    protected function getBaseQuery()
    {
        $vendorId = Auth::guard('sparepart')->user()->id;

        return SparePartProductStock::query()
            ->with('unit')
            ->where('user_id', $vendorId)
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->where('partname', 'LIKE', "%$s%")
                        ->orWhere('part_no', 'LIKE', "%$s%")
                        ->orWhere('company_name', 'LIKE', "%$s%");
                });
            })
            ->when($this->brandFilter !== '', function ($q) {
                $q->where('company_name', $this->brandFilter);
            })
            ->when($this->stockStatusFilter !== '', function ($q) {
                if ($this->stockStatusFilter === 'low') {
                    $q->where('quantity', '>', 0)->where('quantity', '<=', 5);
                } elseif ($this->stockStatusFilter === 'out') {
                    $q->where('quantity', '<=', 0);
                } elseif ($this->stockStatusFilter === 'in') {
                    $q->where('quantity', '>', 5);
                }
            })
            ->orderBy('partname', 'asc');
    }

    public function downloadExcel()
    {
        $query = $this->getBaseQuery();
        $stocks = $query->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=sparepart-stock-report.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($stocks) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['#', 'Part Name', 'Part No.', 'Brand / Manufacturer', 'Rack No.', 'Quantity', 'Unit', 'Stock Value / Payable (₹)', 'Status']);

            foreach ($stocks as $index => $s) {
                $status = $s->quantity <= 0 ? 'Out of Stock' : ($s->quantity <= 5 ? 'Low Stock' : 'In Stock');

                fputcsv($file, [
                    $index + 1,
                    $s->partname ?: 'N/A',
                    $s->part_no ?: 'N/A',
                    $s->company_name ?: 'N/A',
                    $s->rack_no ?: 'N/A',
                    (float)$s->quantity,
                    $s->unit->name ?? 'pcs',
                    (float)$s->total_payable,
                    $status
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'sparepart-stock-report.csv', $headers);
    }

    public function downloadPDF()
    {
        $query = $this->getBaseQuery();
        $stocks = $query->get();

        $totals = [
            'total_entries' => $stocks->count(),
            'total_quantity' => (float)$stocks->sum('quantity'),
            'total_value' => (float)$stocks->sum('total_payable'),
            'low_stock' => $stocks->where('quantity', '>', 0)->where('quantity', '<=', 5)->count(),
            'out_of_stock' => $stocks->where('quantity', '<=', 0)->count(),
        ];

        $pdf = Pdf::loadView('livewire.sparepart.report.pdf.stock-report', [
            'stocks' => $stocks,
            'totals' => $totals,
            'stockStatusFilter' => $this->stockStatusFilter,
            'brandFilter' => $this->brandFilter,
            'search' => $this->search,
        ])->setPaper('a4', 'landscape');

        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'sparepart-stock-report.pdf'
        );
    }

    public function render()
    {
        $query = $this->getBaseQuery();
        $stocks = $query->paginate($this->perPage);

        $vendorId = Auth::guard('sparepart')->user()->id;

        // Fetch all brands/companies for dropdown filter
        $brands = SparePartProductStock::where('user_id', $vendorId)
            ->whereNotNull('company_name')
            ->where('company_name', '!=', '')
            ->distinct()
            ->pluck('company_name');

        // Stats summary
        $allStocks = $this->getBaseQuery()->get();
        $totals = [
            'total_entries' => $allStocks->count(),
            'total_quantity' => (float)$allStocks->sum('quantity'),
            'total_value' => (float)$allStocks->sum('total_payable'),
            'low_stock' => $allStocks->where('quantity', '>', 0)->where('quantity', '<=', 5)->count(),
            'out_of_stock' => $allStocks->where('quantity', '<=', 0)->count(),
        ];

        return view('livewire.sparepart.report.stock-report', compact('stocks', 'brands', 'totals'));
    }
}
