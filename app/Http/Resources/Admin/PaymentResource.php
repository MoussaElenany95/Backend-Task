<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'transaction_id'    => (int) $this?->transaction_id,
            'paid_on'           => (string) $this?->paid_on,
            'details'           => (string) $this?->details,
        ];
    }
}
