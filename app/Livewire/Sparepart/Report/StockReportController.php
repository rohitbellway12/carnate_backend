<?php

namespace App\Livewire\Sparepart\Report;

use App\Models\SparePart;
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
    public string $categoryFilter = ''; // '', '1'=Accessory, '2'=Parts, '3'=Tools, '4'=Lubricants

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingStockStatusFilter(): void { $this->resetPage(); }
    public function updatingBrandFilter(): void { $this->resetPage(); }
    public function updatingCategoryFilter(): void { $this->resetPage(); }

    protected function getBaseQuery()
    {
        $vendorId = Auth::guard('sparepart')->user()->id;

        return SparePart::with(['label', 'unit'])
            ->where('user_id', $vendorId)
            ->whereIn('spare_part_type', [1, 2, 3, 4])
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->where('brand', 'LIKE', "%$s%")
                        ->orWhere('part_number', 'LIKE', "%$s%")
                        ->orWhere('rack_no', 'LIKE', "%$s%")
                        ->orWhereHas('label', function ($lq) use ($s) {
                            $lq->where('title', 'LIKE', "%$s%");
                        });
                });
            })
            ->when($this->brandFilter !== '', function ($q) {
                $q->where('brand', $this->brandFilter);
            })
            ->when($this->categoryFilter !== '', function ($q) {
                $q->where('spare_part_type', $this->categoryFilter);
            })
            ->when($this->stockStatusFilter !== '', function ($q) {
                if ($this->stockStatusFilter === 'low') {
                    $q->where('stock', '>', 0)->where('stock', '<=', 5);
                } elseif ($this->stockStatusFilter === 'out') {
                    $q->where('stock', '<=', 0);
                } elseif ($this->stockStatusFilter === 'in') {
                    $q->where('stock', '>', 5);
                }
            })
            ->orderBy('spare_part_type', 'asc')
            ->orderByRaw('(SELECT title FROM spare_part_labels WHERE spare_part_labels.id = spare_parts.label_id LIMIT 1) ASC');
    }

    public function downloadExcel()
    {
        $query = $this->getBaseQuery();
        $stocks = $query->get();

        $headers = [
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=sparepart-stock-report.csv',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0'
        ];

        $categoryMap = [1 => 'Accessory', 2 => 'Parts', 3 => 'Tools', 4 => 'Lubricants'];

        $callback = function () use ($stocks, $categoryMap) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($file, ['#', 'Category', 'Part Name', 'Part Number', 'Brand', 'Rack No.', 'Stock Qty', 'Unit', 'Selling Price (₹)', 'Purchase Price (₹)', 'Status']);

            foreach ($stocks as $index => $s) {
                $stockQty = (int) $s->stock;
                $status   = $stockQty <= 0 ? 'Out of Stock' : ($stockQty <= 5 ? 'Low Stock' : 'In Stock');

                fputcsv($file, [
                    $index + 1,
                    $categoryMap[$s->spare_part_type] ?? 'Other',
                    $s->label->title ?? 'N/A',
                    $s->part_number ?: 'N/A',
                    $s->brand ?: 'N/A',
                    $s->rack_no ?: 'N/A',
                    $stockQty,
                    $s->unit->name ?? 'pcs',
                    (float) $s->price,
                    (float) $s->purchase_price,
                    $status,
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'sparepart-stock-report.csv', $headers);
    }

    public function downloadPDF()
    {
        $query  = $this->getBaseQuery();
        $stocks = $query->get();

        $totals = $this->buildTotals($stocks);

        $pdf = Pdf::loadView('livewire.sparepart.report.pdf.stock-report', [
            'stocks'            => $stocks,
            'totals'            => $totals,
            'stockStatusFilter' => $this->stockStatusFilter,
            'brandFilter'       => $this->brandFilter,
            'categoryFilter'    => $this->categoryFilter,
            'search'            => $this->search,
        ])->setPaper('a4', 'landscape');

        $pdf->setOptions([
            'defaultFont'          => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true,
        ]);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            'sparepart-stock-report.pdf'
        );
    }

    private function buildTotals($stocks): array
    {
        return [
            'total_entries'  => $stocks->count(),
            'total_quantity' => (float) $stocks->sum('stock'),
            'total_value'    => (float) $stocks->sum(fn ($s) => (float) $s->price * (int) $s->stock),
            'low_stock'      => $stocks->filter(fn ($s) => $s->stock > 0 && $s->stock <= 5)->count(),
            'out_of_stock'   => $stocks->filter(fn ($s) => $s->stock <= 0)->count(),
            'by_category'    => [
                1 => $stocks->where('spare_part_type', 1)->count(),
                2 => $stocks->where('spare_part_type', 2)->count(),
                3 => $stocks->where('spare_part_type', 3)->count(),
                4 => $stocks->where('spare_part_type', 4)->count(),
            ],
        ];
    }

    public function render()
    {
        $query  = $this->getBaseQuery();
        $stocks = $query->paginate($this->perPage);

        $vendorId = Auth::guard('sparepart')->user()->id;

        // Brands for filter dropdown
        $brands = SparePart::where('user_id', $vendorId)
            ->whereIn('spare_part_type', [1, 2, 3, 4])
            ->whereNotNull('brand')
            ->where('brand', '!=', '')
            ->distinct()
            ->pluck('brand');

        // Stats summary (all matching, un-paginated)
        $allStocks = $this->getBaseQuery()->get();
        $totals    = $this->buildTotals($allStocks);

        return view('livewire.sparepart.report.stock-report', compact('stocks', 'brands', 'totals'));
    }
}
