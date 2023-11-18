<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportContoller;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// auth routes
require __DIR__.'/Auth/api.php';

// admin routes
require __DIR__.'/Admin/api.php';

// user routes
require __DIR__.'/User/api.php';
