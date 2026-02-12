<?php
    
declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Section;
use App\Repositories\Contracts\SectionRepositoryInterface;

class SectionRepository extends BaseRepository implements SectionRepositoryInterface
{
    public function __construct(Section $section)
    {
        parent::__construct($section);
    }
}
