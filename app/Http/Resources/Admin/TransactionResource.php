<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => (int) $this?->id,
            'amount'            => (float) $this?->amount,
            'payer'             => new UserResource($this?->user),
            'due_on'            => (string) $this?->due_on,
            'vat'               => (float) $this?->vat,
            'is_vat_inclusive'  => (bool) $this?->is_vat_inclusive,
            'status'            => (string) $this?->status,
            'total'             => (float) $this?->total,
            'payments'          => PaymentResource::collection($this?->payments),
        ];
    }
}
