<?php
use App\Livewire\Admin\{CustomerController, SparePartVendorController, ResetPasswordController, WorkShopVendorController, SubAdminController, PaymentController, SparePartLabelController, SparePartUnitController, SparePartCategoryController, ExpenseCategoryController, JobCardController, PlanController, VehicleController, VehicleTypeController, VehicleBrandController, VehicleColorController, VehicleModelController, WithdrawController,VehicleFuelController,MakersTypeController,MakerController,ModelsController,ModelYearController,ModificationController,ManageAdminPermissions, ManageAdminRoles,OrderController,ProfileController};
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Dashboard; 
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/', Login::class);
        Route::get('login', Login::class)->name('login');
    });

    Route::middleware(['auth.guard:admin','admin'])->group(function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('logout', [Login::class, 'logout'])->name('logout');
        Route::get('spare-part-vendor', SparePartVendorController::class)->name('spare.part.vendor');
        Route::get('work-shop-vendor', WorkShopVendorController::class)->name('work.shop.vendor');
        Route::get('sub-admin', SubAdminController::class)->name('sub.admin');
        Route::get('reset-password', ResetPasswordController::class)->name('resetpassword');
        Route::get('payment', PaymentController::class)->name('payment');
        Route::get('withdraw', WithdrawController::class)->name('withdraw');
        Route::get('spare-part-label', SparePartLabelController::class)->name('spare.part.label');
        Route::get('spare-part-unit', SparePartUnitController::class)->name('spare.part.unit');
        Route::get('spare-part-category', SparePartCategoryController::class)->name('spare.part.category');
        Route::get('expense-category', ExpenseCategoryController::class)->name('expense.category');
        Route::get('customer', CustomerController::class)->name('customer');
        Route::get('job-card', JobCardController::class)->name('job.card');
        Route::get('vehicle', VehicleController::class)->name('vehicle');
        Route::get('vehicle-type', VehicleTypeController::class)->name('vehicle.type');
        Route::get('vehicle-brand', VehicleBrandController::class)->name('vehicle.brand');
        Route::get('vehicle-model', VehicleModelController::class)->name('vehicle.model');
        Route::get('vehicle-color', VehicleColorController::class)->name('vehicle.color');
        Route::get('vehicle-color', VehicleFuelController::class)->name('vehicle.color');
        Route::get('plan', PlanController::class)->name('plan');   
        
        Route::get('brand', MakersTypeController::class)->name('makers_type');
        Route::get('variant', MakerController::class)->name('maker');
        Route::get('models', ModelsController::class)->name('models');
        Route::get('model-year', ModelYearController::class)->name('model_year');
        Route::get('modification', ModificationController::class)->name('modification');

        Route::get('manage-admin-permission', ManageAdminPermissions::class)->name('manageadminpermission');
        Route::get('manage-admin-role', ManageAdminRoles::class)->name('manageadminrole');
        Route::get('order-list', OrderController::class)->name('order-list');    

        // Reports
        Route::get('report/workshops', \App\Livewire\Admin\WorkshopsReportController::class)->name('report.workshops');
        Route::get('report/customers', \App\Livewire\Admin\CustomersReportController::class)->name('report.customers');
        Route::get('report/jobcards', \App\Livewire\Admin\JobCardsReportController::class)->name('report.jobcards');
        Route::get('report/orders', \App\Livewire\Admin\OrdersReportController::class)->name('report.orders');
        Route::get('report/payments', \App\Livewire\Admin\PaymentsReportController::class)->name('report.payments');
        
        Route::get('profile', ProfileController::class)->name('profile')->withoutMiddleware('admin'); 
    });
});