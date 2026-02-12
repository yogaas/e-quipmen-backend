<?php

namespace App\DTOs;

class UserDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $password = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['email'],
            $data['password'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password,
        ]);
    }
}
