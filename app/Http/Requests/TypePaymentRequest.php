<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypePaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
                'paymen'     => 'required|string|max:255', 
                'type_transaction'     => 'required|string|max:255', 
                'account_id'     => 'required|string|max:255', 
        ];
    }
}