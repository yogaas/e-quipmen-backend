<?php

    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class ItemCategoryRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
                'id'     => 'required|string|max:255', 
					'owner_id'     => 'required|string|max:255', 
					'category'     => 'required|string|max:255', 
					
            ];
        }
    }