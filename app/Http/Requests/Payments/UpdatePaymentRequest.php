<?php

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->payment);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount'            => ['numeric', 'min:1'],
            'transaction_id'    => ['exists:transactions,id'],
            'paid_on'           => ['date','date_format:Y-m-d','before_or_equal:today'],
            'details'           => ['nullable','string','max:255'],
        ];
    }
}
