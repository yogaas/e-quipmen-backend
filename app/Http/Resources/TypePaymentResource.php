<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TypePaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id, 
            'owner_id'                => $this->owner_id, 
            'paymen'                => $this->paymen, 
            'type_transaction'                => $this->type_transaction, 
            'account_id'                => $this->account_id, 
            
        ];
    }
}