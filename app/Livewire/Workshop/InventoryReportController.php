<?php

namespace App\Livewire\Workshop;

use App\Models\ProductStock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

#[Layout('components.layouts.workshop-app')]
class InventoryReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public int $workshopId;
    public string $search = '';
    public int $perPage = 10;
    public $viewStockId;
    public $detail = null;

    // Filters
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public ?string $filterType = null;

    public function mount(): void
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function viewStock(int $stockId): void
    {
        $this->viewStockId = $stockId;
        $this->detail = ProductStock::with(['label','categories','unit'])
            ->where('user_id', $this->workshopId)
            ->find($stockId);
    }

    public function render()
    {
        $baseQuery = ProductStock::with(['label','categories','unit'])
            ->where('user_id', $this->workshopId)
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                // Wrap all OR conditions in a nested where
                $q->where(function($q2) use ($s) {
                    $q2->whereHas('label', fn($ql) => $ql->where('title', 'LIKE', "%$s%"))
                       ->orWhereHas('categories', fn($qc) => $qc->where('title', 'LIKE', "%$s%"))
                       ->orWhere('part_number', 'LIKE', "%$s%")
                       ->orWhere('rack_no', 'LIKE', "%$s%");
                });
            });

        // Date Range Filter
        if ($this->fromDate && $this->toDate) {
            $baseQuery->whereBetween(DB::raw('DATE(created_at)'), [$this->fromDate, $this->toDate]);
        }

        // Filter Type: daily / weekly / monthly
        if ($this->filterType === 'daily') {
            $baseQuery->whereDate('created_at', today());
        } elseif ($this->filterType === 'weekly') {
            $baseQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->filterType === 'monthly') {
            $baseQuery->whereMonth('created_at', now()->month);
        }

        $baseQuery->orderBy('created_at', 'desc');

        $stocks = (clone $baseQuery)->paginate($this->perPage);

        // Totals
        $allMatched = (clone $baseQuery);
        $count = (clone $allMatched)->count();
        $qty = (int) (clone $allMatched)->sum('stock');
        $value = (float) (clone $allMatched)->sum(DB::raw('COALESCE(price,0) * COALESCE(stock,0)'));

        $totals = [
            'count' => $count,
            'qty' => $qty,
            'value' => round($value, 2),
        ];

        return view('livewire.workshop.inventory-report', [
            'stocks' => $stocks,
            'totals' => $totals,
        ]);
    }

    // PDF Export
    public function downloadPDF()
    {
        $query = ProductStock::with(['label','categories','unit'])
            ->where('user_id', $this->workshopId)
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function($q2) use ($s) {
                    $q2->whereHas('label', fn($ql) => $ql->where('title', 'LIKE', "%$s%"))
                       ->orWhereHas('categories', fn($qc) => $qc->where('title', 'LIKE', "%$s%"))
                       ->orWhere('part_number', 'LIKE', "%$s%")
                       ->orWhere('rack_no', 'LIKE', "%$s%");
                });
            });

        if ($this->fromDate && $this->toDate) {
            $query->whereBetween(DB::raw('DATE(created_at)'), [$this->fromDate, $this->toDate]);
        }

        if ($this->filterType === 'daily') {
            $query->whereDate('created_at', today());
        } elseif ($this->filterType === 'weekly') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->filterType === 'monthly') {
            $query->whereMonth('created_at', now()->month);
        }

        $stocks = $query->get();

        $pdf = Pdf::loadView('livewire.workshop.pdf.inventory-report', [
            'stocks' => $stocks,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'search' => $this->search,
            'filterType' => $this->filterType,
        ]);
        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Inventory_Report.pdf');
    }
}
