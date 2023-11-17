<?php

namespace App\Http\Requests\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->transaction);
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
            'payer'             => ['exists:users,id'],
            'due_on'            => ['date','date_format:Y-m-d'],
            'vat'               => ['numeric', 'min:0', 'max:100'],
            'is_vat_inclusive'  => ['boolean'],
        ];
    }
}
