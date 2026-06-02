<?php
use App\Livewire\UnifiedAuth\Login;
use App\Http\Controllers\UnifiedAuth\PasswordResetController;
use Illuminate\Support\Facades\Route;

Route::prefix('vendor')->name('unified.')->group(function () {

    Route::middleware('unified.guest')->group(function () {
        Route::get('/', Login::class);
        Route::get('login', Login::class)->name('login');

        // Password reset (unified for workshop & sparepart vendors)
        Route::get('forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
        Route::post('forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
        Route::get('reset-password', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
        Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
    });

    Route::get('logout', [Login::class, 'logout'])->name('logout');

}); 