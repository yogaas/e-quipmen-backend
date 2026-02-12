<?php

    namespace App\DTOs;
    
    class ItemsDTO
    {
        public function __construct(
            public readonly int $id, 
			public readonly int $owner_id, 
			public readonly int $section_id, 
			public readonly string $name, 
			public readonly string $unit_purchase, 
			public readonly string $unit_sale, 
			public readonly float $price_purchase, 
			public readonly float $price_sale, 
			public readonly int $minimum_stock, 
			public readonly string $img_items, 
			public readonly int $active, 
			
        ) {}
    
        public static function fromArray(array $data): self
        {
            return new self(
                 $data['id'],
				$data['owner_id'],
				$data['section_id'],
				$data['name'],
				$data['unit_purchase'],
				$data['unit_sale'],
				$data['price_purchase'],
				$data['price_sale'],
				$data['minimum_stock'],
				$data['img_items'],
				$data['active'],
				
            );
        }
    
        public function toArray(): array
        {
            return array_filter([
                'id'     => $this->id,
				'owner_id'     => $this->owner_id,
				'section_id'     => $this->section_id,
				'name'     => $this->name,
				'unit_purchase'     => $this->unit_purchase,
				'unit_sale'     => $this->unit_sale,
				'price_purchase'     => $this->price_purchase,
				'price_sale'     => $this->price_sale,
				'minimum_stock'     => $this->minimum_stock,
				'img_items'     => $this->img_items,
				'active'     => $this->active,
				
            ]);
        }
    }