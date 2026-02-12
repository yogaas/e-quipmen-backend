<?php

namespace App\Services;

use App\Models\TypePayment;
use App\DTOs\TypePaymentDTO;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\TypePaymentRepositoryInterface;

class TypePaymentService
{
    public function __construct(
        protected TypePaymentRepositoryInterface $repo
    ) {}

    public function list(array $params) : array
    {
        return $this->repo->paginate($params);
    }

    public function create(TypePaymentDTO $dto)
    {
            return $this->repo->create($dto->toArray());
    }

    public function find(int $id)
    {
        $typepayment = $this->repo->findById($id);
        if (!$typepayment) {
            throw new \RuntimeException('TypePayment not found');
        }
        return $typepayment;
    }

    public function update(int $id, TypePaymentDTO $dto)
    {
        $typepayment = $this->repo->findById($id);
        if (!$typepayment) {
            throw new \RuntimeException('TypePayment not found');
        }
        
        return $this->repo->update($id, $dto->toArray());
    }

    public function delete(int $id): void
    {
        $typepayment = $this->repo->findById($id);
        if (!$typepayment) {
            throw new \RuntimeException('TypePayment not found');
        }
        
        $this->repo->delete($id);
    }
}