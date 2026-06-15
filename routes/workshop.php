<?php
use App\Livewire\Workshop\{AddTocardController, ApiPartDetailsController, AppointmentController, AuthController, CustomerController, ResetPasswordController, EmployeeController, ExpensesController, StaffController,JobCardController,
    JobCardAddController,JobCardEditController, PlanController,Select2Search,ManageRoles,ManagePermissions, PurchaseCartController,OrderController, PaidOrderController, VehicleSearchController,CounterSaleAddController,CounterSaleController,CounterSaleEditController,LabourChargeController, SalaryReportController, CustomersReportController, JobCardsReportController, StaffReportController, ExpensesReportController, InventoryReportController, NotificationController, ExpenseCategoryController, ExpenseSupplierController};
use App\Livewire\Workshop\Distributor\{AddDistributorController, DistributorController};
use App\Livewire\Workshop\Auth\Login;
use App\Livewire\Workshop\Dashboard;
use App\Livewire\Workshop\ProductStockController;
use App\Livewire\Workshop\ProfileController;
use App\Livewire\Workshop\PurchaseOrderController;
use App\Livewire\Workshop\Inventory\Supplier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// Route::prefix('portal')->name('portal')->group(function () {
Route::prefix('workshop')->name('workshop.')->group(function () {

    Route::middleware('guest:workshop')->group(function () {
        Route::get('/', Login::class);
        Route::get('login', Login::class)->name('login');
    });

    Route::middleware(['auth.guard:workshop','workshop'])->group(function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('logout', [Login::class, 'logout'])->name('logout')->withoutMiddleware('workshop');
        Route::get('employee', EmployeeController::class)->name('employee');
        Route::get('staff', StaffController::class)->name('staff');
        Route::get('jobcard', JobCardController::class)->name('jobcard');
        Route::get('jobcardadd', JobCardAddController::class)->name('jobcardadd');
        Route::get('jobcardedit/{id}', JobCardEditController::class)->name('jobcardedit');

        Route::get('reset-password', ResetPasswordController::class)->name('resetpassword');
        Route::get('customer', CustomerController::class)->name('customer');
        Route::get('plan', PlanController::class)->name('plan');
        Route::get('profile', ProfileController::class)->name('profile')->withoutMiddleware('workshop');
        Route::get('purchaseorder', PurchaseOrderController::class)->name('purchaseorder');
        Route::get('stocks', ProductStockController::class)->name('productstock');
        Route::get('expenses', ExpensesController::class)->name('expenses');
        Route::get('expense-category', ExpenseCategoryController::class)->name('expense.category');
        Route::get('expense-supplier', ExpenseSupplierController::class)->name('expense.supplier');
        Route::get('manage-role', ManageRoles::class)->name('managerole');
        Route::get('manage-permission', ManagePermissions::class)->name('managepermission');
        Route::get('purchase-parts', VehicleSearchController::class)->name('vehicle_search');
        Route::get('addtocard/{id}', AddTocardController::class)->name('addtocard');
        Route::get('api-part-details/{number}', ApiPartDetailsController::class)->name('api_part_details');
        Route::get('cart/{id}', PurchaseCartController::class)->name('cart');

        Route::get('order-list', OrderController::class)->name('orders');
        Route::get('paid-order-list', PaidOrderController::class)->name('paid-orders');
        // Reports
        Route::get('report/salary', SalaryReportController::class)->name('report.salary');
        Route::get('report/customers', CustomersReportController::class)->name('report.customers');
        Route::get('report/jobcards', JobCardsReportController::class)->name('report.jobcards');
        Route::get('report/staff', StaffReportController::class)->name('report.staff');
        Route::get('report/expenses', ExpensesReportController::class)->name('report.expenses');
        Route::get('report/inventory', InventoryReportController::class)->name('report.inventory');


  //counter sales
        Route::get('counter-sale', CounterSaleController::class)->middleware('permission:counter-sale-show,workshop')->name('counter_sale');
        Route::get('add-counter-sale', CounterSaleAddController::class)->middleware('permission:counter-sale-add,workshop')->name('addcountersale');
        Route::get('edit-countersale/{id}', CounterSaleEditController::class)->middleware('permission:counter-sale-edit,workshop')->name('editcountersalee');

        // Appointments
        Route::get('appointments', AppointmentController::class)->name('appointments');


         // labour
        Route::get('labour-charge', LabourChargeController::class)->name('labourchare');

        // for supplier
        Route::get('suppliers', Supplier::class)->name('suppliers');

        Route::get('notifications', NotificationController::class)->name('notifications');
        Route::get('get-notifications', [HomeController::class, 'getWorkshopNotifications'])->name('get-notifications');
        Route::post('notifications/{id}/read', [HomeController::class, 'markNotificationAsRead'])->name('notifications.read');

    });

});
// });
