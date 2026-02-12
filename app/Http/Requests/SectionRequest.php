<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
                'account_id'     => 'required|string|max:255', 
                'name'     => 'required|string|max:255', 
                'tag'     => 'required|string|max:255', 
                'active'     => 'required|string|max:255', 
        ];
    }
}