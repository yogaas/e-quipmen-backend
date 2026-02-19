<?php

    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class AccountRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
					'id_parent'     => 'int|max:255', 
					'code_account'     => 'required|string|max:255', 
					'name_account'     => 'required|string|max:255', 
					'level'     => 'required|string|max:255', 
					'header'     => 'required', 
					'grouper'     => 'required', 
					'normal_pos'     => 'required|string|max:255', 
            ];
        }
    }