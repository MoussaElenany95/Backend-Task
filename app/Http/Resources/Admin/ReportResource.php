<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'month'             => (int) $this?->month,
            'year'              => (int) $this?->year,
            'paid'              => (float) $this?->paid,
            'outstanding'       => (float) $this?->outstanding,
            'overdue'           => (float) $this?->overdue,
        ];
    }
}
