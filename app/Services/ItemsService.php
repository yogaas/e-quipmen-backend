<?php

namespace App\Services;

use App\Models\Items;
use App\DTOs\ItemsDTO;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\ItemsRepositoryInterface;

class ItemsService
{
    public function __construct(
        protected ItemsRepositoryInterface $repo
    ) {}

    public function list(array $params) : array
    {
        return $this->repo->paginate($params);
    }

    public function create(ItemsDTO $dto)
    {
            return $this->repo->create($dto->toArray());
    }

    public function find(int $id)
    {
        $items = $this->repo->findById($id);
        if (!$items) {
            throw new \RuntimeException('Items not found');
        }
        return $items;
    }

    public function update(int $id, ItemsDTO $dto)
    {
        $items = $this->repo->findById($id);
        if (!$items) {
            throw new \RuntimeException('Items not found');
        }
        
        return $this->repo->update($id, $dto->toArray());
    }

    public function delete(int $id): void
    {
        $items = $this->repo->findById($id);
        if (!$items) {
            throw new \RuntimeException('Items not found');
        }
        
        $this->repo->delete($id);
    }
}