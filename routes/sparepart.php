<?php
use App\Livewire\Sparepart\{ResetPasswordController,AccessoryController, CategoryController, CounterSaleController, CounterSaleEditController, PartsController, ToolsController,LubricantController, OrderController, UnitController, WithdrawController,ManageSparePartPermissions,ManageSparePartRoles,StaffSparePartController,PaidOrderController,Profile};

use App\Livewire\Sparepart\Auth\Login;
use App\Livewire\Sparepart\CounterSaleAddController;
use App\Livewire\Sparepart\Dashboard;
use App\Livewire\Sparepart\Inventory\PurchaseOrder;
use App\Livewire\Sparepart\Inventory\Supplier;
use Illuminate\Support\Facades\Route;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Livewire\Sparepart\Inventory\StockList;

Route::prefix('sparepart')->name('sparepart.')->group(function () {

    Route::middleware('guest:sparepart')->group(function () {
        Route::get('/', Login::class);
        Route::get('login', Login::class)->name('login');
    });

    Route::middleware(['auth.guard:sparepart','profileCheck'])->group(function () {  
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('logout', [Login::class, 'logout'])->name('logout');       
        Route::get('accessory', AccessoryController::class)->name('accessory');
        Route::get('parts', PartsController::class)->name('parts');
        Route::get('tools', ToolsController::class)->name('tools');
        Route::get('lubricants', LubricantController::class)->name('lubricants');
        Route::get('unit', UnitController::class)->name('unit');
        Route::get('category', CategoryController::class)->name('category');
        Route::get('reset-password', ResetPasswordController::class)->name('resetpassword');
        Route::get('withdrawal', WithdrawController::class)->name('withdrawal');
        Route::get('order', OrderController::class)->name('order');
        Route::get('countersale', CounterSaleController::class)->name('countersale');
        Route::get('countersaleadd', CounterSaleAddController::class)->name('countersaleadd');
        Route::get('countersaleedit/{id}', CounterSaleEditController::class)->name('countersaleedit');
        Route::post('/update-order-check', function (Request $request) {
            Order::where('workshop_id', Auth::guard('sparepart')->user()->id)->where('is_check', 0)->update(['is_check' => 1]);
            return back(); // Redirect back after updating
        })->name('update-order-check');
        
        Route::get('profile', Profile::class)->name('profile'); 

        Route::get('sparepart-staff', StaffSparePartController::class)->name('sparepartstaff'); 
        Route::get('manage-sparepart-permission', ManageSparePartPermissions::class)->name('manageadminpermission');
        Route::get('manage-sparepart-role', ManageSparePartRoles::class)->name('manageadminrole'); 
        Route::get('paid-order', PaidOrderController::class)->name('paid-order');
        
        // Inventory - Suppliers
        Route::get('suppliers', Supplier::class)->name('suppliers');
        // Inventory - Purchase Order
        Route::get('purchase-order', PurchaseOrder::class)->name('purchaseorder');
        // Route::get('purchase-order/create', [PurchaseOrder::class, 'create'])->name('purchaseorder.create');

        Route::get('pdf/{id}', [PurchaseOrder::class, 'show'])->name('purchase.order.show');
        Route::get('stock-list', StockList::class)->name('stock.list');

        // Reports routes
        Route::get('report/orders', \App\Livewire\Sparepart\Report\OrdersReportController::class)->name('report.orders');
        Route::get('report/countersale', \App\Livewire\Sparepart\Report\CounterSalesReportController::class)->name('report.countersale');
        Route::get('report/payments', \App\Livewire\Sparepart\Report\PaymentsReportController::class)->name('report.payments');
        Route::get('report/stock', \App\Livewire\Sparepart\Report\StockReportController::class)->name('report.stock');
        Route::get('report/commission', \App\Livewire\Sparepart\Report\CommissionReportController::class)->name('report.commission');
        Route::get('report/salary', \App\Livewire\Sparepart\Report\SalaryReportController::class)->name('report.salary');
    });
});