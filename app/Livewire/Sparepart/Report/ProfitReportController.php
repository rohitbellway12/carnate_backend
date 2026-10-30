<?php

namespace App\Livewire\Sparepart\Report;

use App\Models\CounterSale;
use App\Models\CounterSaleSparePart;
use App\Models\Expense;
use App\Models\OrderItem;
use App\Models\ProductStock;
use App\Models\SparePart;
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
     * Helper to apply date filters to queries
     */
    private function applyDateFilter($query, string $dateColumn): void
    {
        if ($this->fromDate && $this->toDate) {
            $query->whereBetween(DB::raw("DATE($dateColumn)"), [$this->fromDate, $this->toDate]);
        } elseif ($this->fromDate) {
            $query->where(DB::raw("DATE($dateColumn)"), '>=', $this->fromDate);
        } elseif ($this->toDate) {
            $query->where(DB::raw("DATE($dateColumn)"), '<=', $this->toDate);
        }
    }

    /**
     * Compute financial figures according to user formula:
     * 1) Counter sale + Online sale = Total (1)
     * Less
     * 2) Parts purchase(only when sold online or offline) + lubes purchase(only when sold online or offline) + 
     *    accessory purchase(only when sold online or offline) + tools purchase(only when sold online or offline) + 
     *    Platform charges(Commission) = Total (2)
     * 
     * 1 Total - 2 Total = Profit (Gross)
     * Profit - Expenses = Net Profit
     */
    public function getFinancials(): array
    {
        // 1. Counter Sales (Offline sales by this sparepart vendor)
        $counterQuery = CounterSale::where('sparepart_id', $this->sparepartId);
        if ($this->fromDate && $this->toDate) {
            $counterQuery->where(function($q) {
                $q->whereBetween(DB::raw('DATE(date)'), [$this->fromDate, $this->toDate])
                  ->orWhere(function($sub) {
                      $sub->whereNull('date')
                          ->whereBetween(DB::raw('DATE(created_at)'), [$this->fromDate, $this->toDate]);
                  });
            });
        } elseif ($this->fromDate) {
            $counterQuery->where(function($q) {
                $q->where(DB::raw('DATE(date)'), '>=', $this->fromDate)
                  ->orWhere(function($sub) {
                      $sub->whereNull('date')
                          ->where(DB::raw('DATE(created_at)'), '>=', $this->fromDate);
                  });
            });
        } elseif ($this->toDate) {
            $counterQuery->where(function($q) {
                $q->where(DB::raw('DATE(date)'), '<=', $this->toDate)
                  ->orWhere(function($sub) {
                      $sub->whereNull('date')
                          ->where(DB::raw('DATE(created_at)'), '<=', $this->toDate);
                  });
            });
        }

        $counterSaleIds = (clone $counterQuery)->pluck('id')->toArray();
        $counterSalesList = (clone $counterQuery)->get();
        $counterSaleAmount = (float) $counterSalesList->sum('total');
        $counterSaleCount = count($counterSaleIds);

        // 2. Online Sales (Confirmed / Dispatched / Delivered orders fulfilled by this sparepart vendor)
        $orderItemQuery = OrderItem::query()
            ->with(['order', 'SpareParts'])
            ->where('user_id', $this->sparepartId)
            ->whereIn('status', [1, 3, 4]);

        $this->applyDateFilter($orderItemQuery, 'created_at');

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

        // 4. Purchases (ONLY WHEN SOLD ONLINE OR OFFLINE)
        // Category types: 1 => Accessory, 2 => Parts, 3 => Tools, 4 => Lubes
        $partsPurchase = 0.0;
        $lubesPurchase = 0.0;
        $accessoryPurchase = 0.0;
        $toolsPurchase = 0.0;

        // A. Online Sold Items Purchase Cost
        foreach ($onlineItems as $item) {
            $type = (int) ($item->category ?? $item->SpareParts?->spare_part_type ?? 2);
            $qty = (float) ($item->quantity ?: 1);
            $unitBuyPrice = (float) ($item->SpareParts?->purchase_price ?? 0);

            // Fallback to stocks buy_price if purchase_price is 0
            if ($unitBuyPrice <= 0 && $item->SpareParts?->label_id) {
                $stockBuy = ProductStock::where('label_id', $item->SpareParts->label_id)
                    ->where('user_id', $this->sparepartId)
                    ->value('buy_price');
                if ($stockBuy) {
                    $unitBuyPrice = (float) $stockBuy;
                }
            }

            $itemCost = $qty * $unitBuyPrice;

            if ($type == 1) {
                $accessoryPurchase += $itemCost;
            } elseif ($type == 4) {
                $lubesPurchase += $itemCost;
            } elseif ($type == 3) {
                $toolsPurchase += $itemCost;
            } else {
                $partsPurchase += $itemCost;
            }
        }

        // B. Offline (Counter Sale) Sold Items Purchase Cost
        if (!empty($counterSaleIds)) {
            $counterParts = CounterSaleSparePart::whereIn('countersale_id', $counterSaleIds)
                ->leftJoin('stocks', 'stocks.id', '=', 'counter_sale_spare_parts.product_id')
                ->leftJoin('spare_parts', 'spare_parts.id', '=', 'counter_sale_spare_parts.product_id')
                ->leftJoin('spare_part_labels', 'spare_part_labels.id', '=', 'counter_sale_spare_parts.stock_label_id')
                ->select(
                    'counter_sale_spare_parts.*',
                    DB::raw('COALESCE(stocks.buy_price, spare_parts.purchase_price, 0) as unit_buy_price'),
                    DB::raw('COALESCE(stocks.category_id, spare_parts.spare_part_type, spare_part_labels.spare_part_type, 2) as final_part_type')
                )
                ->get();

            foreach ($counterParts as $cp) {
                $type = (int) $cp->final_part_type;
                $qty = (float) ($cp->quantity ?: 1);
                $unitBuy = (float) $cp->unit_buy_price;
                $itemCost = $qty * $unitBuy;

                if ($type == 1) {
                    $accessoryPurchase += $itemCost;
                } elseif ($type == 4) {
                    $lubesPurchase += $itemCost;
                } elseif ($type == 3) {
                    $toolsPurchase += $itemCost;
                } else {
                    $partsPurchase += $itemCost;
                }
            }
        }

        // Direct purchases total of goods sold
        $totalPurchases = $partsPurchase + $lubesPurchase + $accessoryPurchase + $toolsPurchase;

        // Total 2 = Direct Purchases (sold items) + Platform charges (commission)
        $totalDeductions = $totalPurchases + $platformCharges;

        // Gross Profit = 1 Total - 2 Total
        $grossProfit = $totalSales - $totalDeductions;

        // 5. General Expenses (Shop rent, electricity, staff, chai/petty cash)
        $expenseQuery = Expense::where('parent_id', $this->sparepartId);
        $this->applyDateFilter($expenseQuery, 'date');

        $expensesAmount = (float) (clone $expenseQuery)->sum('total_amount');
        $expensesCount = (clone $expenseQuery)->count();

        // Net Profit = Gross Profit - Expenses
        $netProfit = $grossProfit - $expensesAmount;
        $marginPercentage = $totalSales > 0 ? ($netProfit / $totalSales) * 100 : 0.0;
        $grossMarginPercentage = $totalSales > 0 ? ($grossProfit / $totalSales) * 100 : 0.0;

        return [
            // Revenue / Sales (1)
            'counterSale' => round($counterSaleAmount, 2),
            'counterSaleCount' => $counterSaleCount,
            'onlineSale' => round($onlineSaleAmount, 2),
            'onlineOrdersCount' => $onlineOrdersCount,
            'totalSales' => round($totalSales, 2),

            // Cost of Goods Sold & Commission (2)
            'partsPurchase' => round($partsPurchase, 2),
            'lubesPurchase' => round($lubesPurchase, 2),
            'accessoryPurchase' => round($accessoryPurchase, 2),
            'toolsPurchase' => round($toolsPurchase, 2),
            'totalPurchases' => round($totalPurchases, 2),
            'platformCharges' => round($platformCharges, 2),
            'totalCosts' => round($totalDeductions, 2), // Total (2) = Purchases + Commission

            // Profit & Expenses
            'grossProfit' => round($grossProfit, 2),
            'grossMarginPercentage' => round($grossMarginPercentage, 1),
            'expenses' => round($expensesAmount, 2),
            'expensesCount' => $expensesCount,
            'totalExpenses' => round($totalDeductions + $expensesAmount, 2),

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