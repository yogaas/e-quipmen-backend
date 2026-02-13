<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function paginateUser(array $params) : array
    {
        $search  = $params['search'] ?? null;
        $orderByFieldName  = $params['orderByFieldName'] ?? '';
        $sortOrder = $params['sortOrder'] ?? 'asc';
        $pageSize = $params['pageSize'] ?? 10;
        $pageIndex = $params['pageIndex'] ?? 0;

        $skipRecord =  $pageSize*$pageIndex;

        $query = DB::table('users')
                ->leftJoin('user_role', 'users.id', '=', 'user_role.user_id')
                ->select('users.*', 'user_role.role', 'user_role.active');

        if ($search) 
        {
            $query->where('users.name', 'like', "%{$search}%");
            $query->orWhere('users.email', 'like', "%{$search}%");
        }

        $total = $query->count();
        $data = $query
        ->orderBy($orderByFieldName, $sortOrder)
        ->take($pageSize)
        ->skip($skipRecord)
        ->get();
        $array_list = [
            'data'                  => $data,
            'totalCount'            => $total,
            'pageSize'              => $pageSize,
            'pageIndex'             => $pageIndex,
            'sortOrder'             => $sortOrder,
            'orderByFieldName'      => $orderByFieldName,
        ];
        return ($array_list);
    }
}
