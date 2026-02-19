<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id, 
            'account_id'                => $this->account_id, 
            'name'                => $this->name, 
            'tag'                => $this->tag, 
            'active'                => $this->active, 
        ];
    }
}