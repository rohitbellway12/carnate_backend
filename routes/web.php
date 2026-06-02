<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use App\Livewire\Auth\{Login, Register};
use App\Livewire\User\Dashboard;
use App\Livewire\IncrementCount;


Route::get('/optimize', function () {
    try{
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:cache');
    Artisan::call('optimize:clear');
    }catch(\Exception $e){
    }
    return 'Application cache has been cleared';
});

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/increment-count', IncrementCount::class);

Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('user.dashboard');
    Route::get('logout',[Login::class,'logout'])->name('logout');
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('job-card/estimate/accept/{status}/{id}/{userId}',  [App\Http\Controllers\JobCard\JobCardController::class, 'estimateConfirmReject'])->name('estimate.accept');
Route::get('job-card/estimate/decline/{status}/{id}/{userId}',  [App\Http\Controllers\JobCard\JobCardController::class, 'estimateConfirmReject'])->name('estimate.decline');


Route::post('/jobcard-status/change',  [App\Http\Controllers\JobCard\JobCardController::class, 'changeStatus'])->name('jobcard.status');

Route::get('/download-mechanic-sheet/{id}/{type}', [App\Http\Controllers\JobCard\JobCardController::class, 'downloadMechanicSheet'])->name('download.mechanic.sheet');
Route::get('/download-estimate-invoice/{id}/{type}', [App\Http\Controllers\JobCard\JobCardController::class, 'downloadEstimateInvoice'])->name('download.estimate.invoice');
Route::get('/download-invoice/{id}/{type}', [App\Http\Controllers\JobCard\JobCardController::class, 'downloadInvoice'])->name('download.invoice');
Route::get('/workshop/customers', [App\Http\Controllers\JobCard\JobCardController::class, 'getCustomerVehicles'])->name('getCustomerVehicles');
Route::get('/workshop/customers-voice', [App\Http\Controllers\JobCard\JobCardController::class, 'getCustomerVoice'])->name('getCustomerVoice');
Route::get('/workshop/accessory', [App\Http\Controllers\JobCard\JobCardController::class, 'getCustomerAccessory'])->name('getCustomerAccessory');
Route::get('/workshop/vehicle', [App\Http\Controllers\JobCard\JobCardController::class, 'getCustomerVehicle'])->name('getCustomerVehicle');
Route::get('/workshop/worknotes', [App\Http\Controllers\JobCard\JobCardController::class, 'getCustomerWorkNotes'])->name('getCustomerWorkNotes');

Route::view('/download-estimate/{id}/{type}','customer-estimate')->name('customer.estimate.download');


Route::get('/sparepart/vehicle', [App\Http\Controllers\JobCard\JobCardController::class, 'getSpareVehicle'])->name('getSpareVehicle');


Route::get('/workshop/countercustomers', [App\Http\Controllers\JobCard\JobCardController::class, 'getCustomerCounters'])->name('getCustomerCounters');

// COUNTER SALES
Route::get('/sparepart/countersale-invoice/{id}/{type}', [App\Http\Controllers\JobCard\JobCardController::class, 'getCounterSalesInvoicePDF'])->name('getCountersalesinvoPdf');
// workshop COUNTER SALES
Route::get('/workshop/countersale-invoice/{id}/{type}', [App\Http\Controllers\JobCard\JobCardController::class, 'getWorkshopeCounterSalesInvoicePDF'])->name('getworkshopCountersalesinvoPdf');


// order-invoice
Route::get('workshop-invoice/{id}/{view}', [App\Http\Controllers\JobCard\JobCardController::class, 'getWorkshopkOrderInvoice'])->name('getWorkshopinvoPdf');

Route::get('spare-part-invoice/{id}/{type}/{orderid}/{view}', [App\Http\Controllers\JobCard\JobCardController::class, 'getSparePartOrderInvoice'])->name('getSparePartinvoPdf');

Route::view('thankyou', 'new_jobcard.estimate.thankyou')->name('thankyou');

Route::get('/view-pdf', function () {
    return view('pdf_view');
})->name('pdf.view');


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
   // routes/web.php


require __DIR__.'/admin.php';
require __DIR__.'/unified.php';
require __DIR__.'/workshop.php';
require __DIR__.'/sparepart.php';
require __DIR__.'/api.php';

Route::get('/test-api', function () {
    $response = Http::withHeaders([
        'x-rapidapi-host' => env('RAPIDAPI_HOST'),
        'x-rapidapi-key' => env('RAPIDAPI_KEY'),
    ])->get('https://auto-parts-catalog.p.rapidapi.com/category/category-products-groups-variant-2/19942/manufacturer-id/184/lang-id/4/country-filter-id/62/type-id/1');

    return $response->json();
});
