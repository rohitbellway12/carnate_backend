<?php

namespace App\Livewire\Sparepart;

use App\Models\Accessory;
use App\Models\Category;
use App\Models\CounterSale;
use App\Models\CounterSaleSparePart;
use App\Models\Expense;
use App\Models\Lubricant;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Part;
use App\Models\ProductStock;
use App\Models\PurchaseOrder;
use App\Models\SparePartProductStock;
use App\Models\Tools;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

#[Layout('components.layouts.spare-part-app')]
class Dashboard extends Component
{
    use WithPagination;

    public $sparepartId;

    // Financial Metrics (Matching Profit & Loss Report)
    public $monthlyRevenue = 0; // Total Sales (1) = Counter Sale + Online Sale
    public $counterSaleRevenue = 0;
    public $onlineSaleRevenue = 0;
    public $monthlyPurchases = 0; // Cost of goods sold
    public $platformCharges = 0;
    public $monthlyGrossProfit = 0;
    public $monthlyExpenses = 0;
    public $monthlyNetProfit = 0;
    public $profitMargin = 0;
    public $lastMonthRevenue = 0;
    public $revenueGrowthPercent = 0;
    public $pendingOrdersAmount = 0;

    // Inventory & Orders
    public $totalStockQuantity = 0;
    public $totalCatalogParts = 0;
    public $totalPurchaseOrders = 0;
    public $lowStockCount = 0;

    public $orderStats = [
        'pending' => 0,
        'accepted' => 0,
        'delivered' => 0,
        'total' => 0,
    ];

    // Catalog by Category
    public $accessoryCount = 0;
    public $partsCount = 0;
    public $toolsCount = 0;
    public $lubricantCount = 0;
    public $categoryCount = 0;

    // Charts Data
    public $trendMonths = [];
    public $trendRevenues = [];
    public $trendOrders = [];
    public $categoryLabels = [];
    public $categorySeries = [];

    // Operational Lists
    public $recentOrders = [];
    public $lowStockItems = [];
    public $topSellingProducts = [];

    public function mount()
    {
        $user = Auth::guard('sparepart')->user();
        if (!$user) {
            return;
        }

        $this->sparepartId = $user->id;

        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $startOfLastMonth = now()->subMonth()->startOfMonth();
        $endOfLastMonth = now()->subMonth()->endOfMonth();

        // 1. Calculate Monthly Financials (100% Matching Profit & Loss Report)
        $thisMonthFinancials = $this->calculateFinancials($startOfMonth, $endOfMonth);
        $this->monthlyRevenue = $thisMonthFinancials['totalSales'];
        $this->counterSaleRevenue = $thisMonthFinancials['counterSale'];
        $this->onlineSaleRevenue = $thisMonthFinancials['onlineSale'];
        $this->monthlyPurchases = $thisMonthFinancials['totalPurchases'];
        $this->platformCharges = $thisMonthFinancials['platformCharges'];
        $this->monthlyGrossProfit = $thisMonthFinancials['grossProfit'];
        $this->monthlyExpenses = $thisMonthFinancials['expenses'];
        $this->monthlyNetProfit = $thisMonthFinancials['netProfit'];
        $this->profitMargin = $thisMonthFinancials['marginPercentage'];

        // Last Month Revenue for growth comparison
        $lastMonthFinancials = $this->calculateFinancials($startOfLastMonth, $endOfLastMonth);
        $this->lastMonthRevenue = $lastMonthFinancials['totalSales'];

        if ($this->lastMonthRevenue > 0) {
            $this->revenueGrowthPercent = round((($this->monthlyRevenue - $this->lastMonthRevenue) / $this->lastMonthRevenue) * 100, 1);
        } else {
            $this->revenueGrowthPercent = $this->monthlyRevenue > 0 ? 100 : 0;
        }

        // Pending Orders in Queue (Waiting for acceptance)
        $this->pendingOrdersAmount = (float) OrderItem::where('user_id', $this->sparepartId)
            ->where('status', 0)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_amount');

        // 2. Order Stats
        $this->orderStats = [
            'pending' => OrderItem::where('user_id', $this->sparepartId)->where('status', 0)->count(),
            'accepted' => OrderItem::where('user_id', $this->sparepartId)->where('status', 1)->count(),
            'delivered' => OrderItem::where('user_id', $this->sparepartId)->whereIn('status', [2, 3, 4])->count(),
            'total' => OrderItem::where('user_id', $this->sparepartId)->count(),
        ];

        // 3. Inventory & Stocks
        $this->totalStockQuantity = (int) SparePartProductStock::where('user_id', $this->sparepartId)->sum('quantity');
        $this->totalCatalogParts = SparePartProductStock::where('user_id', $this->sparepartId)->count();
        $this->totalPurchaseOrders = PurchaseOrder::where('user_id', $this->sparepartId)->count();
        $this->lowStockCount = SparePartProductStock::where('user_id', $this->sparepartId)
            ->where('quantity', '<=', 10)
            ->count();

        // 4. Category breakdown
        $this->accessoryCount = Accessory::where('user_id', $this->sparepartId)->count();
        $this->partsCount = Part::where('user_id', $this->sparepartId)->count();
        $this->toolsCount = Tools::where('user_id', $this->sparepartId)->count();
        $this->lubricantCount = Lubricant::where('user_id', $this->sparepartId)->count();
        $this->categoryCount = Category::count();

        $this->categoryLabels = ['Spare Parts', 'Accessories', 'Lubricants', 'Tools'];
        $this->categorySeries = [
            $this->partsCount ?: 1,
            $this->accessoryCount ?: 1,
            $this->lubricantCount ?: 1,
            $this->toolsCount ?: 1,
        ];

        // 5. Last 6 Months Trend (Matching Profit & Loss Sales logic)
        $months = [];
        $revs = [];
        $ordersCount = [];
        for ($i = 5; $i >= 0; $i--) {
            $dt = now()->subMonths($i);
            $mStart = $dt->copy()->startOfMonth();
            $mEnd = $dt->copy()->endOfMonth();

            $f = $this->calculateFinancials($mStart, $mEnd);
            $months[] = $dt->format('M Y');
            $revs[] = round($f['totalSales']);
            $ordersCount[] = $f['onlineOrdersCount'] + $f['counterSaleCount'];
        }

        $this->trendMonths = $months;
        $this->trendRevenues = $revs;
        $this->trendOrders = $ordersCount;

        // 6. Recent Orders for this Vendor
        $recentOrderIds = OrderItem::where('user_id', $this->sparepartId)
            ->latest('id')
            ->limit(20)
            ->pluck('order_id')
            ->unique();

        $this->recentOrders = Order::with(['workShopVendor', 'orderItem'])
            ->whereIn('id', $recentOrderIds)
            ->latest('id')
            ->take(6)
            ->get();

        // 7. Low Stock Alerts (Lowest quantity first)
        $this->lowStockItems = SparePartProductStock::where('user_id', $this->sparepartId)
            ->where('quantity', '<=', 10)
            ->orderBy('quantity', 'ASC')
            ->take(5)
            ->get();

        // 8. Top Selling Products
        $this->topSellingProducts = OrderItem::with('SpareParts')
            ->where('user_id', $this->sparepartId)
            ->whereIn('status', [1, 3, 4])
            ->select('spare_part_id', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(total_amount) as total_rev'))
            ->groupBy('spare_part_id')
            ->orderBy('total_sold', 'DESC')
            ->take(5)
            ->get();
    }

    /**
     * Compute financial figures matching Profit & Loss Report formula:
     * 1) Counter sale + Online sale (status in [1, 3, 4]) = Total Sales
     * Less
     * 2) Parts purchase (only when sold) + Commission = Total Deductions
     * 1 Total - 2 Total = Gross Profit
     * Gross Profit - Expenses = Net Profit
     */
    private function calculateFinancials($startDate, $endDate): array
    {
        $fromDate = $startDate->toDateString();
        $toDate = $endDate->toDateString();

        // 1. Counter Sales
        $counterQuery = CounterSale::where('sparepart_id', $this->sparepartId)
            ->where(function ($q) use ($fromDate, $toDate) {
                $q->whereBetween(DB::raw('DATE(date)'), [$fromDate, $toDate])
                    ->orWhere(function ($sub) use ($fromDate, $toDate) {
                        $sub->whereNull('date')
                            ->whereBetween(DB::raw('DATE(created_at)'), [$fromDate, $toDate]);
                    });
            });

        $counterSaleIds = (clone $counterQuery)->pluck('id')->toArray();
        $counterSaleAmount = (float) (clone $counterQuery)->sum('total');
        $counterSaleCount = count($counterSaleIds);

        // 2. Online Sales (Confirmed / Dispatched / Delivered orders fulfilled by this sparepart vendor)
        $onlineItems = OrderItem::query()
            ->with(['order', 'SpareParts'])
            ->where('user_id', $this->sparepartId)
            ->whereIn('status', [1, 3, 4])
            ->whereBetween(DB::raw('DATE(created_at)'), [$fromDate, $toDate])
            ->get();

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
        $partsPurchase = 0.0;
        $lubesPurchase = 0.0;
        $accessoryPurchase = 0.0;
        $toolsPurchase = 0.0;

        foreach ($onlineItems as $item) {
            $type = (int) ($item->category ?? $item->SpareParts?->spare_part_type ?? 2);
            $qty = (float) ($item->quantity ?: 1);
            $unitBuyPrice = (float) ($item->SpareParts?->purchase_price ?? 0);

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

        $totalPurchases = $partsPurchase + $lubesPurchase + $accessoryPurchase + $toolsPurchase;
        $totalDeductions = $totalPurchases + $platformCharges;
        $grossProfit = $totalSales - $totalDeductions;

        // 5. Overhead Expenses
        $expensesAmount = (float) Expense::where('parent_id', $this->sparepartId)
            ->whereBetween(DB::raw('DATE(date)'), [$fromDate, $toDate])
            ->sum('total_amount');

        $netProfit = $grossProfit - $expensesAmount;
        $marginPercentage = $totalSales > 0 ? round(($netProfit / $totalSales) * 100, 1) : 0.0;

        return [
            'counterSale' => round($counterSaleAmount, 2),
            'counterSaleCount' => $counterSaleCount,
            'onlineSale' => round($onlineSaleAmount, 2),
            'onlineOrdersCount' => $onlineOrdersCount,
            'totalSales' => round($totalSales, 2),
            'totalPurchases' => round($totalPurchases, 2),
            'platformCharges' => round($platformCharges, 2),
            'totalCosts' => round($totalDeductions, 2),
            'grossProfit' => round($grossProfit, 2),
            'expenses' => round($expensesAmount, 2),
            'netProfit' => round($netProfit, 2),
            'marginPercentage' => $marginPercentage,
        ];
    }

    public function render()
    {
        return view('livewire.sparepart.dashboard', [
            'monthlyRevenue' => $this->monthlyRevenue,
            'counterSaleRevenue' => $this->counterSaleRevenue,
            'onlineSaleRevenue' => $this->onlineSaleRevenue,
            'monthlyPurchases' => $this->monthlyPurchases,
            'platformCharges' => $this->platformCharges,
            'monthlyGrossProfit' => $this->monthlyGrossProfit,
            'monthlyExpenses' => $this->monthlyExpenses,
            'monthlyNetProfit' => $this->monthlyNetProfit,
            'profitMargin' => $this->profitMargin,
            'revenueGrowthPercent' => $this->revenueGrowthPercent,
            'pendingOrdersAmount' => $this->pendingOrdersAmount,
            'totalStockQuantity' => $this->totalStockQuantity,
            'totalCatalogParts' => $this->totalCatalogParts,
            'totalPurchaseOrders' => $this->totalPurchaseOrders,
            'lowStockCount' => $this->lowStockCount,
            'orderStats' => $this->orderStats,
            'accessoryCount' => $this->accessoryCount,
            'partsCount' => $this->partsCount,
            'toolsCount' => $this->toolsCount,
            'lubricantCount' => $this->lubricantCount,
            'categoryCount' => $this->categoryCount,
            'trendMonths' => $this->trendMonths,
            'trendRevenues' => $this->trendRevenues,
            'trendOrders' => $this->trendOrders,
            'categoryLabels' => $this->categoryLabels,
            'categorySeries' => $this->categorySeries,
            'recentOrders' => $this->recentOrders,
            'lowStockItems' => $this->lowStockItems,
            'topSellingProducts' => $this->topSellingProducts,
        ]);
    }
}
