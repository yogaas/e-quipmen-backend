<?php

namespace App\DTOs;

class AccountDTO
{
    public function __construct(
        public int $owner_id = 0, 
        public readonly int $id_parent = 0, 
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
            $data['owner_id'] ?? 0,
            $data['id_parent'] ?? 0,
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
        return ([
            'owner_id'     => $this->owner_id ?? 0,
            'id_parent'     => $this->id_parent ?? 0,
            'code_account'     => $this->code_account,
            'name_account'     => $this->name_account,
            'level'     => $this->level,
            'header'     => $this->header,
            'normal_pos'     => $this->normal_pos,
            'grouper'     => $this->grouper,
        ]);
    }
}