<?php

namespace App\Services;

use App\Models\User;
use App\DTOs\UserDTO;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $repo
    ) {}

    public function list(array $params) : array
    {
        return $this->repo->paginateUser($params);
    }

    public function create(UserDTO $dto)
    {
        return $this->repo->create($dto->toArray());
    }

    public function find(int $id)
    {
        $user = $this->repo->findById($id);
        if (!$user) {
            throw new \RuntimeException('User not found');
        }
        return $user;
    }

    public function update(int $id, UserDTO $dto)
    {
        $user = $this->repo->findById($id);
        if (!$user) {
            throw new \RuntimeException('User not found');
        }

        $user = new UIser($dto);
        //$user->password = Hash::make($user->password);
        
        return $this->repo->update($id, $user->toArray());
    }

    public function delete(int $id): void
    {
        $this->repo->delete($id);
    }

    private function handleException(callable $callback)
    {
        try {
           return $callback();
        } catch (\Throwable $th) {
            return $this->error(
                $th->getMessage(),
                null,
                500
            );
        }
    }
}
