<?php

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Models\SaleDetail;

interface SaleDetailRepositoryInterface extends BaseRepositoryInterface
{
    public function findByCode(string $code);
}