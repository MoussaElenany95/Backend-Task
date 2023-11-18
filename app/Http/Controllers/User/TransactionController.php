<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\TransactionResource;
use App\Support\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use ApiResponse;
    /**
     * get all transactions
     * @param Request $request
     */
    public function index(Request $request): JsonResponse
    {

        $user = $request->user();
        // get transactions
        $transactions = $user->transactions()->with('payments')->paginate(10);

        // return response
        return $this->success('Transaction list', TransactionResource::collection($transactions));
    }
}
