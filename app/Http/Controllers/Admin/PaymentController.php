<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\StorePaymentRequest;
use App\Http\Requests\Payments\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Models\Transaction;
use App\Support\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the payments.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Payment::class);

        $payments = Payment::paginate(10);

        return $this->success('Payment list',PaymentResource::collection($payments));

    }

    /**
     * Store a newly created payment in storage.
     * @param StorePaymentRequest $request
     * @return JsonResponse
     * 
     */
    public function store(StorePaymentRequest $request): JsonResponse
    {

        $payment = Payment::create($request->validated());

        return $this->success('Payment created', new PaymentResource($payment),Response::HTTP_CREATED);

    }

    /**
     * Display the specified payment.
     * @param Payment $payment
     */
    public function show(Payment $payment)
    {
        $this->authorize('view', $payment);

        return $this->success('Payment detail', new PaymentResource($payment));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePaymentRequest $request
     * @param Payment $payment
     * 
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {

        $payment->update($request->validated());

        return $this->success('Payment updated', new PaymentResource($payment));

    }

    /**
     * Remove the specified resource from storage.
     * @param Payment $payment
     */
    public function destroy(Payment $payment)
    {
        $this->authorize('delete', $payment);

        $payment->delete();

        return $this->success('Payment deleted');
    }
}
