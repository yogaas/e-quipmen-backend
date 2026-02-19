<?php

    namespace App\DTOs;
    
    class CustomerDTO
    {
        public function __construct(
			public int $owner_id = 0, 
			public readonly string $name, 
			public readonly string $phone, 
			public readonly string $email, 
			public readonly string $address, 
        ) {}
    
        public static function fromArray(array $data): self
        {
            return new self(
				$data['owner_id'] ?? 0,
				$data['name'],
				$data['phone'],
				$data['email'],
				$data['address'],
            );
        }
    
        public function toArray(): array
        {
            return ([
				'owner_id'     => $this->owner_id ?? 0,
				'name'     => $this->name,
				'phone'     => $this->phone,
				'email'     => $this->email,
				'address'     => $this->address,
            ]);
        }
    }