<?php

    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class AccountRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
					'code_account'     => 'required|string|max:255', 
					'name_account'     => 'required|string|max:255', 
					'level'     => 'required|string|max:255', 
					'normal_pos'     => 'required|string|max:255', 
            ];
        }
    }