<?php
    
    declare(strict_types=1);
    
    namespace App\Repositories\Eloquent;
    
    use App\Models\Items;
    use App\Repositories\Contracts\ItemsRepositoryInterface;
    
    class ItemsRepository extends BaseRepository implements ItemsRepositoryInterface
    {
        public function __construct(Items $items)
        {
            parent::__construct($items);
        }
    }