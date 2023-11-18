<?php

use App\Http\Controllers\User\TransactionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::apiResource('transactions',TransactionController::class)->only(['index'])->names('user.transactions');

});