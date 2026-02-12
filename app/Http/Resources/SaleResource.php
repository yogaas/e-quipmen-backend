<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    protected bool $withDetail = false;

    public function __construct($resource, bool $withDetail = false)
    {
        parent::__construct($resource);
        $this->withDetail = $withDetail;
    }

    public function toArray(Request $request): array
    {
        $data = [
            'unique_code'                => $this->unique_code, 
            'owner_id'                => $this->owner_id, 
            'section_id'                => $this->section_id, 
            'customer_id'                => $this->customer_id, 
            'date_created'                => $this->date_created, 
            'time_created'                => $this->time_created, 
            'sub_total'                => $this->sub_total, 
            'percen_ppn'                => $this->percen_ppn, 
            'percen_discount'                => $this->percen_discount, 
            'price_ppn'                => $this->price_ppn, 
            'price_discount'                => $this->price_discount, 
            'total_price'                => $this->total_price, 
            'status_paymen'                => $this->status_paymen, 
            'status_cancel'                => $this->status_cancel, 
            'status_jurnal'                => $this->status_jurnal, 
            'status_closebook'                => $this->status_closebook, 
            'user_create'                => $this->user_create, 
        ];

        if ($this->withDetail) {
            $data['details'] = $this->details;
        }

        return $data;
    }
}