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
        // delete token
        $request->user()->currentAccessToken()->delete();

       // logout from session if it exists
        if ($request->hasSession()) {
            Auth::logout();
            $request->session()->invalidate();
        }
        return $this->success('Logout success');
    }
}
