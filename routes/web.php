<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;

Route::redirect('/', '/dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class,'index'])
        ->name('dashboard');

    Route::resource('customers', CustomerController::class);

    Route::resource('orders', App\Http\Controllers\OrderController::class);

    Route::resource('payments', App\Http\Controllers\PaymentController::class);
});

require __DIR__.'/auth.php';