<?php

    namespace App\DTOs;
    
    class TypePaymentDTO
    {
        public function __construct(
            public readonly int $id, 
			public readonly int $owner_id, 
			public readonly string $paymen, 
			public readonly string $type_transaction, 
			public readonly int $account_id, 
			
        ) {}
    
        public static function fromArray(array $data): self
        {
            return new self(
                 $data['id'],
				$data['owner_id'],
				$data['paymen'],
				$data['type_transaction'],
				$data['account_id'],
				
            );
        }
    
        public function toArray(): array
        {
            return array_filter([
                'id'     => $this->id,
				'owner_id'     => $this->owner_id,
				'paymen'     => $this->paymen,
				'type_transaction'     => $this->type_transaction,
				'account_id'     => $this->account_id,
				
            ]);
        }
    }