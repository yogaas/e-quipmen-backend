<?php

namespace App\Services;

use App\Models\User;
use App\Models\Menus;
use App\Models\UserRole;
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
        return $this->repo->paginate($params);
    }

    public function create(UserDTO $dto, array $roleData)
    {
        $user = $this->repo->create($dto->toArray());

        UserRole::create([
            'owner_id' => $user->owner_id,
            'user_id' => $user->id,
            'role' => $roleData['role'],
            'active' => $roleData['active']
        ]);
        return $user;
    }

    public function find(int $id)
    {
        $user = $this->repo->findById($id);
        if (!$user) {
            throw new \RuntimeException('User not found');
        }
       
        return $user;
    }

    public function update(int $id, UserDTO $dto, array $roleData)
    {
        $user = $this->repo->findById($id);
        if (!$user) {
            throw new \RuntimeException('User not found');
        }

        $return = $this->repo->update($id, $dto->toArray());

        $role = UserRole::where(['user_id' => $id, 'owner_id' => $user->owner_id])->first();
        if ($role) {
            $role->update([
            'role' => $roleData['role'],
            'active' => $roleData['active']
            ]);
        }else{
            UserRole::create([
                'owner_id' => $user->owner_id,
                'user_id' => $id,
                'role' => $roleData['role'],
                'active' => $roleData['active']
            ]);
        }
        
        return $return;
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
