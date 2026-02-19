<?php

namespace App\DTOs;

class SectionDTO
{
    public function __construct(
        public int $owner_id = 0, 
        public readonly int $account_id, 
        public readonly string $name, 
        public readonly string $tag, 
        public readonly int $active, 
        
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['owner_id'] ?? 0,
            $data['account_id'],
            $data['name'],
            $data['tag'],
            $data['active'],
            
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'owner_id'     => $this->owner_id ?? 0,
            'account_id'     => $this->account_id,
            'name'     => $this->name,
            'tag'     => $this->tag,
            'active'     => $this->active,
            
        ]);
    }
}