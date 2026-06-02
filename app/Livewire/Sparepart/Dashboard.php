<?php

namespace App\Livewire\Sparepart;

use App\Models\Accessory;
use App\Models\Category;
use App\Models\Lubricant;
use Livewire\Component;
use App\Models\Order;
use App\Models\Part;
use App\Models\Tools;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.spare-part-app')]   
class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $accessory = 0, $parts = 0, $tools = 0, $lubricant = 0, $unit = 0, $category = 0, $sparepartId, $stocks, $purchesorders;
    public $lowStockItems = [], $topSellingProducts = [], $orderStats = [];
    public $totalStockQuantity = 0, $totalRevenue = 0;

    public function mount()
    {
        $this->sparepartId = Auth::guard('sparepart')->user()->id;
        
        // Basic Counts
        $this->accessory = Accessory::where('spare_part_type', 1)->where('user_id', $this->sparepartId)->count();
        $this->parts = Part::where('spare_part_type', 2)->where('user_id', $this->sparepartId)->count();
        $this->tools = Tools::where('spare_part_type', 3)->where('user_id', $this->sparepartId)->count();
        $this->lubricant = Lubricant::where('spare_part_type', 4)->where('user_id', $this->sparepartId)->count();
        $this->unit = Unit::count();
        $this->category = Category::count();
        
        $this->stocks = \App\Models\SparePartProductStock::where('user_id', $this->sparepartId)->count();
        $this->purchesorders = \App\Models\PurchaseOrder::where('user_id', $this->sparepartId)->count();

        // 1. Real-time Stock Quantity & Revenue
        $this->totalStockQuantity = \App\Models\SparePartProductStock::where('user_id', $this->sparepartId)->sum('quantity');
        
        $items = \App\Models\OrderItem::where('user_id', $this->sparepartId)->get();
        $this->totalRevenue = $items->sum(function($item) {
            return (float)$item->price * (int)$item->quantity;
        });

        // 2. Low Stock Alerts (Threshold < 10 for demonstration)
        $this->lowStockItems = \App\Models\SparePartProductStock::where('user_id', $this->sparepartId)
            ->where('quantity', '<', 10)
            ->orderBy('quantity', 'ASC')
            ->limit(5)
            ->get();

        // 3. Order Stats
        $this->orderStats = [
            'pending' => \App\Models\OrderItem::where('user_id', $this->sparepartId)->where('status', 0)->count(),
            'accepted' => \App\Models\OrderItem::where('user_id', $this->sparepartId)->where('status', 1)->count(),
            'delivered' => \App\Models\OrderItem::where('user_id', $this->sparepartId)->where('status', 2)->count(),
            'total' => \App\Models\OrderItem::where('user_id', $this->sparepartId)->count(),
        ];

        // 4. Insights: Top Selling Products
        $this->topSellingProducts = \App\Models\OrderItem::where('user_id', $this->sparepartId)
            ->select('spare_part_id', \Illuminate\Support\Facades\DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('spare_part_id')
            ->orderBy('total_sold', 'DESC')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.sparepart.dashboard');
    }
}
