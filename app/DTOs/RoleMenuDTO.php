<?php

    namespace App\DTOs;
    
    class RoleMenuDTO
    {
        public function __construct(
            public readonly string $menus, 
			public bool $view, 
			public bool $create, 
			public bool $update, 
			public bool $delete,

        ) {}
    
        public static function fromArray(array $data): self
        {
            return new self(
                $data['menus'],
				$data['view'] ?? false,
				$data['create'] ?? false,
				$data['update'] ?? false,
				$data['delete'] ?? false
            );
        }
    
        public function toArray(): array
        {
            return array_filter([
                'menus'           => $this->menus,
				'view'     => $this->view ?? false,
				'create'     => $this->create ?? false,
				'update'     => $this->update ?? false,
				'delete'     => $this->delete ?? false,
            ]);
        }
    }