<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
                'section_id'     => 'required|string|max:255', 
                'name'     => 'required|string|max:255', 
                'unit_purchase'     => 'required|string|max:255', 
                'unit_sale'     => 'required|string|max:255', 
                'price_purchase'     => 'required|string|max:255', 
                'price_sale'     => 'required|string|max:255', 
                'minimum_stock'     => 'required|string|max:255', 
                
                'details.*.item_id' => 'required|integer',
                'details.*.qty'        => 'required|integer|min:1',
                'details.*.price'      => 'required|numeric',
                'details.*.subtotal'   => 'required|numeric',
        ];
    }
}