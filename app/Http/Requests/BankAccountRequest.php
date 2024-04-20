<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class BankAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'account_number' => 'required|integer',
            'sort_code' => 'required|string',
            'bank_id' => 'required|integer',
            'card_type_id' => 'required|integer',
            'user_ids' => 'required|array',
            'id' => ['nullable', 'integer'],
        ];
    }
}
