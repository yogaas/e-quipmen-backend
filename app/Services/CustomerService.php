<?php

namespace App\Services;

use App\Models\Customer;
use App\DTOs\CustomerDTO;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\CustomerRepositoryInterface;

class CustomerService
{
    public function __construct(
        protected CustomerRepositoryInterface $repo
    ) {}

    public function list(array $params) : array
    {
        return $this->repo->paginate($params);
    }

    public function create(CustomerDTO $dto)
    {
            return $this->repo->create($dto->toArray());
    }

    public function find(int $id)
    {
        $customer = $this->repo->findById($id);
        if (!$customer) {
            throw new \RuntimeException('Customer not found');
        }
        return $customer;
    }

    public function update(int $id, CustomerDTO $dto)
    {
        $customer = $this->repo->findById($id);
        if (!$customer) {
            throw new \RuntimeException('Customer not found');
        }
        
        return $this->repo->update($id, $dto->toArray());
    }

    public function delete(int $id): void
    {
        $customer = $this->repo->findById($id);
        if (!$customer) {
            throw new \RuntimeException('Customer not found');
        }
        
        $this->repo->delete($id);
    }
}