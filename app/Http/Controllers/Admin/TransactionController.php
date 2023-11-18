<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\StoreTransactionRequest;
use App\Http\Requests\Transactions\UpdateTransactionRequest;
use App\Http\Resources\Admin\TransactionResource;
use App\Models\Transaction;
use App\Support\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the transactions.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Transaction::class);

        $transactions = Transaction::with('payments')->paginate(10);

        return $this->success('Transaction list',TransactionResource::collection($transactions));
    }

    /**
     * Store a newly created transaction in storage.
     * @param StoreTransactionRequest $request
     * @return JsonResponse
     */
    public function store(StoreTransactionRequest $request): JsonResponse
    {

        $transaction = Transaction::create($request->validated());

        return $this->success('Transaction created', new TransactionResource($transaction),Response::HTTP_CREATED);

    }

    /**
     * Display the specified transaction.
     * @param Transaction $transaction
     * @return JsonResponse
     */
    public function show(Transaction $transaction): JsonResponse
    {
        $this->authorize('view', $transaction);

        return $this->success('Transaction detail', new TransactionResource($transaction));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateTransactionRequest $request
     * @param Transaction $transaction
     * @return JsonResponse
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction): JsonResponse
    {
        $transaction->update($request->validated());

        return $this->success('Transaction updated', new TransactionResource($transaction));
    }

    /**
     * Remove the specified resource from storage.
     * @param Transaction $transaction
     * @return JsonResponse
     */
    public function destroy(Transaction $transaction): JsonResponse
    {
        $this->authorize('delete', $transaction);

        $transaction->delete();

        return $this->success('Transaction deleted');
    }
}
