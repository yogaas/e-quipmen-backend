<?php

    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class RoleRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
                'role'     => 'required|string|max:255', 
                'menus'    => 'required|array',
                'menus.*.menus'  => 'required|string|max:255',
                'menus.*.view'  => 'required|boolean',
                'menus.*.create'  => 'required|boolean',
                'menus.*.update'  => 'required|boolean',
                'menus.*.delete'  => 'required|boolean',
            ];
        }
    }