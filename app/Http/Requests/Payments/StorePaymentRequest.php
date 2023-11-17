<?php

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Payment::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount'            => ['required', 'numeric', 'min:1'],
            'transaction_id'    => ['required', 'exists:transactions,id'],
            'paid_on'           => ['required', 'date','date_format:Y-m-d','before_or_equal:today'],
            'details'           => ['nullable','string','max:255'],
        ];
    }
}
