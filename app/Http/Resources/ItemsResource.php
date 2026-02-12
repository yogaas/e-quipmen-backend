<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id, 
            'owner_id'                => $this->owner_id, 
            'section_id'                => $this->section_id, 
            'name'                => $this->name, 
            'unit_purchase'                => $this->unit_purchase, 
            'unit_sale'                => $this->unit_sale, 
            'price_purchase'                => $this->price_purchase, 
            'price_sale'                => $this->price_sale, 
            'minimum_stock'                => $this->minimum_stock, 
            'img_items'                => $this->img_items, 
            'active'                => $this->active, 
            
        ];
    }
}