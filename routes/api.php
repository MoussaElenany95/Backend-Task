<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// login route
Route::post('login',LoginController::class);

// transactions route
Route::apiResource('transactions', TransactionController::class)->middleware('auth:sanctum');
// payments route
Route::apiResource('payments', PaymentController::class)->middleware('auth:sanctum');