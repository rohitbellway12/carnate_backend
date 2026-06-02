<?php

use App\Http\Controllers\Api\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Common\CommonController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\JobCardController;
use App\Http\Controllers\Api\Staff\StaffController;
use App\Http\Controllers\Api\NotificationController;     
use App\Http\Controllers\Api\WorkshopSupplierController;
use App\Http\Controllers\Api\WorkshopVehicleSearchApiController;
use App\Http\Controllers\Api\VehicleApiController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::controller(UserAuthController::class)->group(function(){
    Route::post('user/signup', 'signup');
    Route::post('user/verify-otp', 'verifyOtp');
    Route::post('user/login-otp', 'login');
    
    Route::post('staff/login', 'staffLogin');
    
    
    Route::post('user/login', 'resendOtp');
    Route::get('user/countries', 'countries');
    Route::post('user/state', 'state');
    Route::post('user/cities', 'cities');

});



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-info', [AuthController::class, 'userinfo']);
    Route::post('/user-profile/update/{id}', [UserAuthController::class, 'updateProfile']);
    Route::post('/search-vehicle', [JobCardController::class, 'searchVehicle']);
    Route::post('/add-customer', [JobCardController::class, 'addCustomer']);
    Route::get('/vehicle-type', [JobCardController::class, 'vehicleType']);
    Route::get('/vehicle-brand', [JobCardController::class, 'vehicleBrand']);
    Route::post('/vehicle-model', [JobCardController::class, 'vehicleModel']);
    Route::get('/vehicle-fuel-type', [JobCardController::class, 'vehicleFuelType']);
    
    // RapidAPI Vehicle Endpoints
    Route::controller(VehicleApiController::class)->group(function() {
        Route::get('/rapid-vehicle-brands', 'getBrands');
        Route::post('/rapid-vehicle-models', 'getModels');
        Route::post('/rapid-vehicle-engines', 'getEngines');
        Route::post('/rapid-vehicle-details', 'getVehicleDetails');
    });
    Route::post('/search-accessories', [JobCardController::class, 'searchaccessories']);
    Route::post('/add-accessories', [JobCardController::class, 'addaccessories']);
    Route::post('/search-customer-voice', [JobCardController::class, 'searchCustomerVoice']);
    Route::post('/add-customer-voice', [JobCardController::class, 'addCustomerVoice']);
    Route::post('/search-work-notes', [JobCardController::class, 'searchWorkNotes']);
    Route::post('/add-work-notes', [JobCardController::class, 'addWorkNotes']);
    Route::post('/store-jobcard', [JobCardController::class, 'storeJobCard']);


    Route::post('/den-mark-image', [JobCardController::class, 'dentImage']);
    Route::get('/get-jobcardnumber', [JobCardController::class, 'genreateJobCardNumber']);


 // Category 
    Route::get('/get-category', [CommonController::class, 'getCategory']);
    Route::get('/get-brands', [CommonController::class, 'getBrands']);
    Route::post('/spare-filter', [CommonController::class, 'spareFilter']);
    Route::post('/car-filter', [CommonController::class, 'searchByCar']);


    Route::get('/makertype', [CommonController::class, 'makerType']);
    Route::post('/model-maker', [CommonController::class, 'modelMaker']);
    Route::post('/get-model', [CommonController::class, 'getModel']);
    Route::post('/get-year', [CommonController::class, 'getYear']);
    Route::post('/get-modification', [CommonController::class, 'getModification']);
    Route::post('/get-by-categorey', [CommonController::class, 'getByCategorey']);

    Route::post('staff/get-order', [StaffController::class, 'getOrders']);
    Route::post('staff/get-order-detail', [StaffController::class, 'getOrderDetail']);
    Route::post('/get-cart-order', [StaffController::class, 'getCartOrder']);

    // Job Card 
    Route::get('staff/get-jobcard-count', [StaffController::class, 'getJobCardCount']);
    Route::post('staff/get-jobcard', [StaffController::class, 'getJobCard']);


    // Admin 
    Route::post('admin/get-order', [AdminController::class, 'getOrders']);
    Route::post('admin/get-order-detail', [AdminController::class, 'getOrderDetail']);
    Route::post('admin/create-expense', [AdminController::class, 'createExpense']);
    Route::get('admin/staff-type-list', [AdminController::class, 'staffTypes']);
    Route::post('admin/staff-add', [AdminController::class, 'createStaff']);
    Route::get('admin/expense-categorey-get', [AdminController::class, 'getExpenseCat']);
    //14/06/25
    Route::post('/update-expense', [AdminController::class, 'updateExpense']);

    // Job Card 
    Route::get('admin/get-jobcard-count', [AdminController::class, 'getJobCardCount']);
    Route::post('admin/get-jobcard', [AdminController::class, 'getJobCard']);
    Route::post('admin/staff-list', [AdminController::class, 'staffList']);
    Route::post('admin/expense', [AdminController::class, 'Expense']);
    Route::post('admin/revenue', [AdminController::class, 'Revenue']);
    //14/06/20-03-25
     Route::post('/delete-expense', [AdminController::class, 'deleteExpense']);
    
    
    // New 12-03-25 
    Route::post('vehicle-analytics', [AdminController::class, 'vechileAnalytics']);
    // Today Service Due 
    Route::post('get-today-service', [AdminController::class, 'todayServiceDue']);
    // Genreal 
    Route::post('get-mechanic', [AdminController::class, 'getMechanics']);
    Route::post('mechanic-jobcard', [AdminController::class, 'getMechanicJobCard']);
    // Purchase order
    Route::post('purchase-order', [AdminController::class, 'purchaseOrder']);
    // Add Stock 
    // Route::post('add-stock', [AdminController::class, 'addStock']);
    
    // Counter Salse 
    Route::post('get-counter-salse', [AdminController::class, 'getCounterSales']);
    Route::post('view-counter-salse', [AdminController::class, 'viewCounterSales']);
    // Anyalitics 
    Route::post('view-salse', [AdminController::class, 'viewSalse']);
    // Reports 
    Route::post('get-report', [AdminController::class, 'stockJobReport']);
    Route::post('get-counter-salse', [AdminController::class, 'counterSalse']);
    
    Route::post('update-staff', [AdminController::class, 'editStaff']);
    
    Route::post('delete-staff', [AdminController::class, 'deleteStaff']);


    
    // NEW 20-03-25 
     Route::get('get-spare-names', [AdminController::class, 'getSapreNames']);
     Route::post('add-spare-names', [AdminController::class, 'createSapreNames']);
     Route::get('get-units', [AdminController::class, 'getUnits']);
     Route::get('get-categorey', [AdminController::class, 'getCategorey']);
     
    //  Cart 
     Route::post('add-to-cart', [AdminController::class, 'addToCart']);
     Route::post('get-cart', [AdminController::class, 'getCartData']);
     Route::post('delete-cart-item', [AdminController::class, 'DeleteCartItem']);
     Route::post('confirm-order', [AdminController::class, 'confirmOrder']);
      
    //   Counter Salse 
     Route::get('get-counter-customers', [AdminController::class, 'getCounterCustomers']);
     Route::post('add-counter-customer', [AdminController::class, 'storeCounterCustomer']);
      
     Route::post('create-counter-salse', [AdminController::class, 'createCounterSale']);
     Route::get('get-spareparts', [AdminController::class, 'getSpareParts']);
    
     
     // New 22-03-25
      Route::get('get-counter-salse-number', [AdminController::class, 'genrateConterSalseNumber']);
     Route::post('counter-salse-detail', [AdminController::class, 'counterSalseDetail']);
     Route::post('counter-salse-update', [AdminController::class, 'updateCounterSale']);
     Route::post('counter-salse-delete', [AdminController::class, 'deleteCounterSale']);
     
    //  New 24-03-35
     Route::post('update-stock', [AdminController::class, 'updateStock']);
     Route::get('get-main-categorey', [AdminController::class, 'getStockCategorey']);
     Route::post('get-stocks', [AdminController::class, 'getStocks']);
     
     //  New 25-03-35
     Route::post('vechile-search-customer', [JobCardController::class, 'vechileSearchCutomer']);
     
     //  New 25-03-35
     Route::post('create-jobcard', [JobCardController::class, 'createJobCard']);
     Route::post('get-customers', [JobCardController::class, 'getCustomerVehicles']);
     Route::get('get-supervisor', [JobCardController::class, 'getSupervisor']);
     
      //  New 26-03-35
     Route::post('serach-customer-voice-new', [JobCardController::class, 'fetchCustomerVoicesData']);
     Route::post('search-work-notes-new', [JobCardController::class, 'fetchWorkNoteVoicesData']);
     Route::post('search-accessories-new', [JobCardController::class, 'fetchAccessoryData']);
     
      Route::post('remove-voice', [JobCardController::class, 'removeCustomerVoice']);
      Route::post('remove-dent-image', [JobCardController::class, 'removeDentImage']);
      
      Route::post('upload-car-image', [JobCardController::class, 'uploadCarImage']);
      
    //   Labour Charge 
    
    Route::post('add-labour-charge', [AdminController::class, 'addLabourCharges']);
    Route::post('update-labour-charge', [AdminController::class, 'updateLabourCharges']);
    Route::post('delete-labour-charge', [AdminController::class, 'deleteLabourCharges']);
    Route::post('get-labour-charge', [AdminController::class, 'getLabourCharges']);
    
    // Roles 
    
    Route::post('add-role', [AdminController::class, 'addRole']);
    Route::post('update-role', [AdminController::class, 'updateRole']);
    Route::post('delete-role', [AdminController::class, 'deleteRole']);
    Route::post('get-role', [AdminController::class, 'getRoles']);
    Route::get('get-permission', [AdminController::class, 'getPermission']);
    

     Route::get('get-mechanic', [JobCardController::class, 'getMechaniecs']);
      Route::post('get-spare', [JobCardController::class, 'getSpareParts']);
      
       //  New 27-03-35
     Route::post('job-card-detail', [JobCardController::class, 'getJobCardDetail']);
     
    // Job Card Edit 
    Route::post('update-jobcard', [JobCardController::class, 'updateJobCard']);
    Route::post('confirm-jobcard', [JobCardController::class, 'confirmJobCard']);
    Route::post('update-note', [JobCardController::class, 'noteUpdate']);
    Route::post('send-invoice-mail', [JobCardController::class, 'sendInvoiceMail']);
    
    Route::post('add-stock', [JobCardController::class, 'storeStock']);
    Route::post('add-online-stock', [JobCardController::class, 'storePurchase']);
    
    
    //  New 10-04-25
     Route::post('role-detail', [AdminController::class, 'detailRole']);
     
     Route::post('add-user-staff', [AdminController::class, 'staffAddUser']);
     
     //new 09-06-2025
     Route::post('vendor-login-status', [AdminController::class, 'setVendorLoginStatus']);
     //old add stock was not working
     Route::post('add-stock-new', [AdminController::class, 'addStock1']);
     
     Route::post('/add-user-staff', [AdminController::class, 'staffAddUser']);
     Route::get('/admin/expense-suppliers', [AdminController::class, 'getExpenseSupplierNames']);
     Route::delete('/delete-stock', [AdminController::class, 'deleteStock']);
     Route::get('/generate-counter-sale-number', [AdminController::class, 'generateCounterSaleNumber']);
     
      Route::post('/send-notification', [NotificationController::class, 'sendNotification']);
     Route::get('/notifications/{userId}', [NotificationController::class, 'getNotifications']);
     Route::put('/notifications/read/{id}', [NotificationController::class, 'markAsRead']);
});



// Add individual routes for CRUD
Route::post('workshop-suppliers', [WorkshopSupplierController::class, 'store']);
Route::get('workshop-suppliers', [WorkshopSupplierController::class, 'index']);
Route::get('workshop-suppliers/{id}', [WorkshopSupplierController::class, 'show']);
Route::put('workshop-suppliers/{id}', [WorkshopSupplierController::class, 'update']);
Route::delete('workshop-suppliers/{id}', [WorkshopSupplierController::class, 'destroy']);

// Add this route for vehicle search via API (POST)
Route::post('workshop/vehicle-search', [WorkshopVehicleSearchApiController::class, 'search']);

// Vehicle search dropdown APIs
Route::get('workshop/vehicle-brands', [WorkshopVehicleSearchApiController::class, 'getBrands']);
Route::post('workshop/vehicle-variants', [WorkshopVehicleSearchApiController::class, 'getVariants']);
Route::post('workshop/vehicle-years', [WorkshopVehicleSearchApiController::class, 'getYears']);
Route::post('workshop/vehicle-dropdown-data', [WorkshopVehicleSearchApiController::class, 'getDropdownData']);
