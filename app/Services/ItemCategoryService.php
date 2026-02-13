<?php

namespace App\Services;

use App\Models\ItemCategory;
use App\DTOs\ItemCategoryDTO;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\ItemCategoryRepositoryInterface;

class ItemCategoryService
{
    public function __construct(
        protected ItemCategoryRepositoryInterface $repo
    ) {}

    public function list(array $params, int $owner_id) : array
    {
        $where = ['owner_id' => $owner_id];
        return $this->repo->paginateWhere($params, $where);
    }

    public function create(ItemCategoryDTO $dto)
    {
            return $this->repo->create($dto->toArray());
    }

    public function find(int $id)
    {
        $itemcategory = $this->repo->findById($id);
        if (!$itemcategory) {
            throw new \RuntimeException('ItemCategory not found');
        }
        return $itemcategory;
    }

    public function update(int $id, ItemCategoryDTO $dto)
    {
        $itemcategory = $this->repo->findById($id);
        if (!$itemcategory) {
            throw new \RuntimeException('ItemCategory not found');
        }
        
        return $this->repo->update($id, $dto->toArray());
    }

    public function delete(int $id): void
    {
        $itemcategory = $this->repo->findById($id);
        if (!$itemcategory) {
            throw new \RuntimeException('ItemCategory not found');
        }
        
        $this->repo->delete($id);
    }
}