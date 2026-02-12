<?php

namespace App\Services;

use App\Models\Account;
use App\DTOs\AccountDTO;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\AccountRepositoryInterface;

class AccountService
{
    public function __construct(
        protected AccountRepositoryInterface $repo
    ) {}

    public function list(array $params) : array
    {
        return $this->repo->paginate($params);
    }

    public function create(AccountDTO $dto)
    {
            return $this->repo->create($dto->toArray());
    }

    public function find(int $id)
    {
        $account = $this->repo->findById($id);
        if (!$account) {
            throw new \RuntimeException('Account not found');
        }
        return $account;
    }

    public function update(int $id, AccountDTO $dto)
    {
        $account = $this->repo->findById($id);
        if (!$account) {
            throw new \RuntimeException('Account not found');
        }
        
        return $this->repo->update($id, $dto->toArray());
    }

    public function delete(int $id): void
    {
        $account = $this->repo->findById($id);
        if (!$account) {
            throw new \RuntimeException('Account not found');
        }
        
        $this->repo->delete($id);
    }
}