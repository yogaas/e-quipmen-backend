<?php

    namespace App\DTOs;
    
    class RoleDTO
    {
        public function __construct(
            public readonly string $role, 
			public int $owner_id, 
			
        ) {}
    
        public static function fromArray(array $data): self
        {
            return new self(
                $data['role'],
				$data['owner_id'] ?? 0,
                array_map(
                fn ($item) => RoleMenuDTO::fromArray($item),
                $data['menus'] ?? []
            )
            );
        }
    
        public function toArray(): array
        {
            return array_filter([
                'role'           => $this->role,
				'owner_id'     => $this->owner_id ?? 0,
                'menus' => array_map(
                    fn ($item) => $item->toArray(),
                    $this->menus ?? []
                )
            ]);
        }
    }