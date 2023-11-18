<?php

// transactions route

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportContoller;
use App\Http\Controllers\Admin\TransactionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function () {
    // transactions route
    Route::apiResource('transactions', TransactionController::class)->names('admin.transactions');
    // payments route
    Route::apiResource('payments', PaymentController::class)->names('admin.payments');
    // report route
    Route::get('report',ReportContoller::class)->name('admin.report');
});
