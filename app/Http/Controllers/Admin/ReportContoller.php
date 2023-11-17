<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportContoller extends Controller
{
    use ApiResponse;
    /**
     * Generate report  
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        
    }
}
