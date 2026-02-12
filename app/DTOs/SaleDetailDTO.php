<?php

namespace App\DTOs;
    
class SaleDetailDTO
{
    public function __construct(
        public readonly int $id, 
        public string $unique_code, 
        public int $owner_id, 
        public readonly int $item_id, 
        public readonly string $unit, 
        public readonly float $price, 
        public readonly int $qty, 
        public readonly float $amount, 
        
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
           $data['id'] ?? 0,
           $data['unique_code'] ?? "",
           $data['owner_id'] ?? 0,
           $data['item_id'] ?? 0,
           $data['unit'],
           $data['price'],
           $data['qty'],
           $data['amount'],
        );
    }

    public function toArray(): array
    {
        return ([
            'unique_code'     => $this->unique_code ?? "",
            'owner_id'     => $this->owner_id,
            'item_id'     => $this->item_id,
            'unit'     => $this->unit,
            'price'     => $this->price,
            'qty'     => $this->qty,
            'amount'     => $this->amount,
        ]);
    }
}