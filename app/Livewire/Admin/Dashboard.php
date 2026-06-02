<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Models\SparePartVendor;
use App\Models\WorkShopVendor;
use App\Models\Admin;
use App\Models\JobCard;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin-app')]
class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $subadmin = 0, $workshop = 0, $sparepart = 0, $totalOrders = 0, $totalJobCards = 0;
    public $totalCustomers = 0, $totalVehicles = 0, $totalUsers = 0;
    public $totalPayments = 0, $totalPaymentAmount = 0;
    public $recentJobCards = [], $orderStats = [], $recentOrders = [];

    public function mount()
    {
        $userId = Auth::guard('admin')->user()->id;
        
        // Basic counts
        $this->subadmin = Admin::where('type', 1)->where('parent_id', $userId)->count();
        $this->workshop = WorkShopVendor::where('type', 0)->count();
        $this->sparepart = SparePartVendor::count();
        $this->totalOrders = Order::count();
        $this->totalJobCards = JobCard::count();
        $this->totalCustomers = Customer::count();
        $this->totalVehicles = Vehicle::count();
        $this->totalUsers = User::where('role', 'Customer')->count();
        
        // Payment stats
        $this->totalPayments = Payment::count();
        $this->totalPaymentAmount = Payment::sum('amount');
        
        // Order stats
        $this->orderStats = [
            'pending' => Order::where('is_confim', 0)->count(),
            'confirmed' => Order::where('is_confim', 1)->count(),
            'total' => Order::count(),
        ];

        // Recent job cards
        $this->recentJobCards = JobCard::with(['customer', 'vehicle'])
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
