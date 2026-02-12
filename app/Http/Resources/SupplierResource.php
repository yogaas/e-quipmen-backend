<?php

namespace App\Http\Resources;
    
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id, 
            'owner_id'                => $this->owner_id, 
            'section_id'                => $this->section_id, 
            'name'                => $this->name, 
            'company'                => $this->company, 
            'phone'                => $this->phone, 
            'email'                => $this->email, 
            'address'                => $this->address, 
            
        ];
    }
}
