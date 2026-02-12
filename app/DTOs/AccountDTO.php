<?php

namespace App\DTOs;

class AccountDTO
{
    public function __construct(
        public readonly int $id, 
        public readonly int $owner_id, 
        public readonly int $id_parent, 
        public readonly string $code_account, 
        public readonly string $name_account, 
        public readonly int $level, 
        public readonly int $header, 
        public readonly string $normal_pos, 
        public readonly string $grouper, 
        
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
             $data['id'],
            $data['owner_id'],
            $data['id_parent'],
            $data['code_account'],
            $data['name_account'],
            $data['level'],
            $data['header'],
            $data['normal_pos'],
            $data['grouper'],
            
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id'     => $this->id,
            'owner_id'     => $this->owner_id,
            'id_parent'     => $this->id_parent,
            'code_account'     => $this->code_account,
            'name_account'     => $this->name_account,
            'level'     => $this->level,
            'header'     => $this->header,
            'normal_pos'     => $this->normal_pos,
            'grouper'     => $this->grouper,
            
        ]);
    }
}