<?php
    
declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Account;
use App\Repositories\Contracts\AccountRepositoryInterface;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{
    public function __construct(Account $account)
    {
        parent::__construct($account);
    }
}