<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'section_id'     => 'required|integer', 
            'customer_id'     => 'required|integer', 
            'date_created'     => 'required|date', 
            'time_created'     => 'required|required|date_format:Y-m-d H:i', 
            'sub_total'     => 'required|numeric', 
            'percen_ppn'     => 'required|integer|max:100', 
            'percen_discount'     => 'required|integer|max:100', 
            'price_ppn'     => 'required|numeric', 
            'price_discount'     => 'required|numeric', 
            'total_price'     => 'required|numeric', 
                
            'details.*.item_id' => 'required|integer',
            'details.*.unit' => 'required|string',
            'details.*.qty'        => 'required|integer|min:1',
            'details.*.price'      => 'required|numeric',
            'details.*.amount'   => 'required|numeric',
        ];
    }
}