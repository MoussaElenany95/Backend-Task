<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;

// login route
Route::post('login',LoginController::class)->name('login');

Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::get('logout',LogoutController::class)->name('logout');


});

