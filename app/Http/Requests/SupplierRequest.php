<?php

    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class SupplierRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
					'name'     => 'required|string|max:255', 
					'company'     => 'required|string|max:255', 
					'phone'     => 'required|string|max:255', 
					'email'     => 'required|string|max:255', 
					'address'     => 'required|string|max:255', 
            ];
        }
    }