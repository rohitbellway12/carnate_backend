<?php

namespace App\Livewire\Sparepart\Report;

use App\Models\CounterSale;
use App\Models\Expense;
use App\Models\OrderItem;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

#[Layout('components.layouts.spare-part-app')]
class ProfitReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public int $sparepartId;
    public string $search = '';
    public int $perPage = 10;

    // Filters
    public ?string $filterType = 'monthly'; // daily, weekly, monthly, all, custom
    public ?string $fromDate = null;
    public ?string $toDate = null;

    public function mount(): void
    {
        $this->sparepartId = (int) Auth::guard('sparepart')->user()->id;
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
     * Compute financial figures according to user formula:
     * 1) Counter sale + Online sale = Total (1)
     * Less
     * 2) Parts purchase + Lubes purchase + Accessory purchase + Tools purchase + Platform charges (Commission) + Expenses = Total (2)
     * 
     * 1 Total - 2 Total = Profit
     */
    public function getFinancials(): array
    {
        // 1. Counter Sales
        $counterQuery = CounterSale::where('type', 0)->where('sparepart_id', $this->sparepartId);
        if ($this->fromDate && $this->toDate) {
            $counterQuery->whereBetween(DB::raw('DATE(date)'), [$this->fromDate, $this->toDate]);
        }
        $counterSalesList = (clone $counterQuery)->get();
        $counterSaleAmount = (float) $counterSalesList->sum('total');
        $counterSaleCount = $counterSalesList->count();

        // 2. Online Sales (Confirmed / Dispatched / Delivered orders)
        $orderItemQuery = OrderItem::query()
            ->with(['order', 'SpareParts'])
            ->where('user_id', $this->sparepartId)
            ->whereIn('status', [1, 3, 4]);

        if ($this->fromDate && $this->toDate) {
            $orderItemQuery->whereHas('order', function ($oQ) {
                $oQ->whereBetween(DB::raw('DATE(created_at)'), [$this->fromDate, $this->toDate]);
            });
        }
        $onlineItems = $orderItemQuery->get();
        $onlineSaleAmount = (float) $onlineItems->sum('total_amount');
        $onlineOrdersCount = $onlineItems->pluck('order_id')->unique()->count();

        // Total Sales (1)
        $totalSales = $counterSaleAmount + $onlineSaleAmount;

        // 3. Platform Charges (Commission on online items)
        $platformCharges = 0.0;
        foreach ($onlineItems as $item) {
            $cat = $item->category;
            $commissionPercent = (float) getCommission($cat);
            $gross = (float) $item->total_amount;
            $platformCharges += ($gross * $commissionPercent) / 100;
        }

        // 4. Purchases (Purchase Orders grouped by spare_part_type)
        // 1 => Accessory, 2 => Parts, 3 => Tools, 4 => Lubes
        $poQuery = PurchaseOrder::where('user_id', $this->sparepartId);
        if ($this->fromDate && $this->toDate) {
            $poQuery->where(function ($q) {
                $q->whereBetween(DB::raw('DATE(po_date)'), [$this->fromDate, $this->toDate])
                  ->orWhere(function ($sub) {
                      $sub->whereNull('po_date')
                          ->whereBetween(DB::raw('DATE(created_at)'), [$this->fromDate, $this->toDate]);
                  });
            });
        }
        $poIds = (clone $poQuery)->pluck('id')->toArray();
        $poCount = count($poIds);

        $partsPurchase = 0.0;
        $lubesPurchase = 0.0;
        $accessoryPurchase = 0.0;
        $toolsPurchase = 0.0;

        if (!empty($poIds)) {
            $poItems = PurchaseOrderItem::whereIn('purchase_order_id', $poIds)->with('part')->get();
            foreach ($poItems as $pItem) {
                $type = $pItem->part?->spare_part_type ?? 2; // Default to 2 (Parts)
                $cost = (float) ($pItem->total ?? ($pItem->qty * $pItem->unit_price));
                if ($type == 1) {
                    $accessoryPurchase += $cost;
                } elseif ($type == 4) {
                    $lubesPurchase += $cost;
                } elseif ($type == 3) {
                    $toolsPurchase += $cost;
                } else {
                    $partsPurchase += $cost;
                }
            }
        }
        $totalPurchases = $partsPurchase + $lubesPurchase + $accessoryPurchase + $toolsPurchase;

        // 5. Direct Expenses
        $expenseQuery = Expense::where('parent_id', $this->sparepartId);
        if ($this->fromDate && $this->toDate) {
            $expenseQuery->whereBetween(DB::raw('DATE(date)'), [$this->fromDate, $this->toDate]);
        }
        $expensesAmount = (float) (clone $expenseQuery)->sum('total_amount');
        $expensesCount = (clone $expenseQuery)->count();

        // Total Cost & Deductions (2)
        $totalExpenses = $totalPurchases + $platformCharges + $expensesAmount;

        // Profit
        $netProfit = $totalSales - $totalExpenses;
        $marginPercentage = $totalSales > 0 ? ($netProfit / $totalSales) * 100 : 0.0;

        return [
            // Revenue / Sales (1)
            'counterSale' => round($counterSaleAmount, 2),
            'counterSaleCount' => $counterSaleCount,
            'onlineSale' => round($onlineSaleAmount, 2),
            'onlineOrdersCount' => $onlineOrdersCount,
            'totalSales' => round($totalSales, 2),

            // Cost & Deductions (2)
            'partsPurchase' => round($partsPurchase, 2),
            'lubesPurchase' => round($lubesPurchase, 2),
            'accessoryPurchase' => round($accessoryPurchase, 2),
            'toolsPurchase' => round($toolsPurchase, 2),
            'totalPurchases' => round($totalPurchases, 2),
            'poCount' => $poCount,
            'platformCharges' => round($platformCharges, 2),
            'expenses' => round($expensesAmount, 2),
            'expensesCount' => $expensesCount,
            'totalExpenses' => round($totalExpenses, 2),

            // Result
            'netProfit' => round($netProfit, 2),
            'marginPercentage' => round($marginPercentage, 1),
            'isProfitable' => $netProfit >= 0,
        ];
    }

    public function downloadPDF()
    {
        $financials = $this->getFinancials();
        $vendor = Auth::guard('sparepart')->user();

        $pdf = Pdf::loadView('livewire.sparepart.report.pdf.profit-report', [
            'f' => $financials,
            'vendor' => $vendor,
            'filterType' => $this->filterType,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
        ])->setPaper('a4', 'portrait');

        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        $fileName = 'Profit_Loss_Report_' . ($this->filterType ?? 'custom') . '_' . date('Ymd_His') . '.pdf';
        return response()->streamDownload(
            fn() => print($pdf->output()),
            $fileName
        );
    }

    public function render()
    {
        $financials = $this->getFinancials();

        return view('livewire.sparepart.report.profit-report', [
            'f' => $financials,
        ]);
    }
}

