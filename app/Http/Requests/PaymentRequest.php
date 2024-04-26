<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment_category_id' => 'required|integer',
            'bank_account_id' => 'required|integer',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'date' => 'required|string',
        ];
    }
}
