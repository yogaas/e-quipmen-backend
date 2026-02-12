<?php
    
    declare(strict_types=1);
    
    namespace App\Repositories\Eloquent;
    
    use App\Models\Supplier;
    use App\Repositories\Contracts\SupplierRepositoryInterface;
    
    class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface
    {
        public function __construct(Supplier $supplier)
        {
            parent::__construct($supplier);
        }
    }