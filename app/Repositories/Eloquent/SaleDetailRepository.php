<?php
    
declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\SaleDetail;
use App\Repositories\Contracts\SaleDetailRepositoryInterface;

class SaleDetailRepository extends BaseRepository implements SaleDetailRepositoryInterface
{
    public function __construct(SaleDetail $saledetail)
    {
        parent::__construct($saledetail);
    }

    public function findByCode(string $code)
    {
        return $this->model->where('unique_code', $code)->get();
    }
}
