<?php

    namespace App\DTOs;
    
    class SupplierDTO
    {
        public function __construct(
			public int $owner_id = 0, 
			public readonly string $name, 
			public readonly string $company, 
			public readonly string $phone, 
			public readonly string $email, 
			public readonly string $address, 
			
        ) {}
    
        public static function fromArray(array $data): self
        {
            return new self(
				$data['owner_id'] ?? 0,
				$data['name'],
				$data['company'],
				$data['phone'],
				$data['email'],
				$data['address'],
				
            );
        }
    
        public function toArray(): array
        {
            return array_filter([
				'owner_id'     => $this->owner_id ?? 0,
				'name'     => $this->name,
				'company'     => $this->company,
				'phone'     => $this->phone,
				'email'     => $this->email,
				'address'     => $this->address,
				
            ]);
        }
    }