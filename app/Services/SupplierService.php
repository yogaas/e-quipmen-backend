<?php

namespace App\Services;

use App\Models\Supplier;
use App\DTOs\SupplierDTO;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\SupplierRepositoryInterface;

class SupplierService
{
    public function __construct(
        protected SupplierRepositoryInterface $repo
    ) {}

    public function list(array $params) : array
    {
        return $this->repo->paginate($params);
    }

    public function create(SupplierDTO $dto)
    {
            return $this->repo->create($dto->toArray());
    }

    public function find(int $id)
    {
        $supplier = $this->repo->findById($id);
        if (!$supplier) {
            throw new \RuntimeException('Supplier not found');
        }
        return $supplier;
    }

    public function update(int $id, SupplierDTO $dto)
    {
        $supplier = $this->repo->findById($id);
        if (!$supplier) {
            throw new \RuntimeException('Supplier not found');
        }
        
        return $this->repo->update($id, $dto->toArray());
    }

    public function delete(int $id): void
    {
        $supplier = $this->repo->findById($id);
        if (!$supplier) {
            throw new \RuntimeException('Supplier not found');
        }
        
        $this->repo->delete($id);
    }
}
