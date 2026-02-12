<?php

namespace App\Services;

use App\Models\Sale;
use App\DTOs\SaleDTO;
use App\Models\SaleDetail;
use App\DTOs\SaleDetailDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\SaleRepositoryInterface;
use App\Repositories\Contracts\SaleDetailRepositoryInterface;

class SaleService
{
    public function __construct(
        protected SaleRepositoryInterface $repo,
        protected SaleDetailRepositoryInterface $repoDetail
    ) {}

    public function list(array $params) : array
    {
        return $this->repo->paginate($params);
    }

    public function create(SaleDTO $dto)
    {
          return DB::transaction(function () use ($dto) {
        
            $penjualan = $this->repo->create($dto->toArrayPost());
            
            foreach ($dto->details as $detail) {
                $detail->unique_code = $dto->unique_code;
                $detail->owner_id = $dto->owner_id;
                $this->repoDetail->create($detail->toArray());
            }

            return $penjualan;
        });
    }

    public function find(string $id)
    {
        $sale = $this->repo->findById($id);
        if (!$sale) {
            throw new \RuntimeException('Sale not found');
        }

        $sale->details = $this->repoDetail->findByCode($id);

        return $sale;
    }

    public function update(int $id, SaleDTO $dto)
    {
        $sale = $this->repo->findById($id);
        if (!$sale) {
            throw new \RuntimeException('Sale not found');
        }

        $this->repoDetail::where('unique_code', $id)->delete();

        foreach ($dto->details as $detail) {
            $this->repoDetail->create($detail->toArray());
        }
        
        return $this->repo->update($id, $dto->toArray());
    }

    public function delete(int $id): void
    {
        $sale = $this->repo->findById($id);
        if (!$sale) {
            throw new \RuntimeException('Sale not found');
        }
        
        $this->repo->delete($id);
    }
}