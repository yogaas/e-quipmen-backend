<?php

    namespace App\DTOs;
    
    class CustomerDTO
    {
        public function __construct(
            public readonly int $id, 
			public readonly int $owner_id, 
			public readonly string $name, 
			public readonly string $company, 
			public readonly string $phone, 
			public readonly string $email, 
			public readonly string $address, 
			
        ) {}
    
        public static function fromArray(array $data): self
        {
            return new self(
                $data['id'],
				$data['owner_id'],
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
                'id'     => $this->id,
				'owner_id'     => $this->owner_id,
				'name'     => $this->name,
				'company'     => $this->company,
				'phone'     => $this->phone,
				'email'     => $this->email,
				'address'     => $this->address,
				
            ]);
        }
    }