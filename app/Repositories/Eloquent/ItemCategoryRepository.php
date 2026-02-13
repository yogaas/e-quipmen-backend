<?php
    
declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\ItemCategory;
use App\Repositories\Contracts\ItemCategoryRepositoryInterface;

class ItemCategoryRepository extends BaseRepository implements ItemCategoryRepositoryInterface
{
    public function __construct(ItemCategory $itemcategory)
    {
        parent::__construct($itemcategory);
    }
}