<?php

namespace App\Http\Requests\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Transaction::class);
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
            'payer'             => ['required', 'exists:users,id'],
            'due_on'            => ['required', 'date','date_format:Y-m-d'],
            'vat'               => ['required', 'numeric', 'min:0', 'max:100'],
            'is_vat_inclusive'  => ['required', 'boolean'],
        ];
    }
}
