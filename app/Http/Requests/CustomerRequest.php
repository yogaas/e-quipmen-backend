<?php

    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class CustomerRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
                'owner_id'     => 'required|string|max:255', 
                'name'     => 'required|string|max:255', 
                'company'     => 'required|string|max:255', 
                'phone'     => 'required|string|max:255', 
                'email'     => 'required|string|max:255', 
                'address'     => 'required|string|max:255', 
            ];
        }
    }