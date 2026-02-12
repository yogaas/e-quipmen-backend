<?php

namespace App\DTOs;

class SectionDTO
{
    public function __construct(
        public readonly int $id, 
        public readonly int $owner_id, 
        public readonly int $account_id, 
        public readonly string $name, 
        public readonly string $tag, 
        public readonly int $active, 
        
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
                $data['id'],
            $data['owner_id'],
            $data['account_id'],
            $data['name'],
            $data['tag'],
            $data['active'],
            
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id'     => $this->id,
            'owner_id'     => $this->owner_id,
            'account_id'     => $this->account_id,
            'name'     => $this->name,
            'tag'     => $this->tag,
            'active'     => $this->active,
            
        ]);
    }
}