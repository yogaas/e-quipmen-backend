<?php

namespace App\DTOs;

class UserDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $password = null,
        public int $owner = 0,
        public int $owner_id = 0,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['email'],
            $data['password'] ?? null,
            $data['owner'] ?? 0,
            $data['owner_id'] ?? 0,
        );
    }

    public function toArray(): array
    {
        return ([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password,
            'owner'    => $this->owner ?? 0,
            'owner_id'    => $this->owner_id ?? 0,
        ]);
    }
}
