<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    use ApiResponse;

    /**
     * Logout user
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        
        $user = auth()->user();

        if($request->expectsJson()){
            $user->currentAccessToken()->delete();
        }else{
            Auth::guard('web')->logout();
        }

        return $this->success('Logout success');
    }
}
