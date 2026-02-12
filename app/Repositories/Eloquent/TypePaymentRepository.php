<?php
    
declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\TypePayment;
use App\Repositories\Contracts\TypePaymentRepositoryInterface;

class TypePaymentRepository extends BaseRepository implements TypePaymentRepositoryInterface
{
    public function __construct(TypePayment $typepayment)
    {
        parent::__construct($typepayment);
    }
}