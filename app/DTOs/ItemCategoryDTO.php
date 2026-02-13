<?php

    namespace App\DTOs;
    
    class ItemCategoryDTO
    {
        public function __construct(
            public readonly int $id, 
			public readonly int $owner_id, 
			public readonly string $category, 
			
        ) {}
    
        public static function fromArray(array $data): self
        {
            return new self(
                 $data['id'],
				$data['owner_id'],
				$data['category'],
				
            );
        }
    
        public function toArray(): array
        {
            return array_filter([
                'id'     => $this->id,
				'owner_id'     => $this->owner_id,
				'category'     => $this->category,
				
            ]);
        }
    }
