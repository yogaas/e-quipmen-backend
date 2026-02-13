<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\DTOs\ListDTO;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findById(int|string $id): ?Model
    {
        return $this->model->find($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int|string $id, array $data): Model
    {
        $model = $this->findById($id);

        if (!$model) {
            throw new \RuntimeException('Data not found');
        }

        $model->update($data);
        return $model;
    }

    public function delete(int|string $id): void
    {
        $model = $this->findById($id);

        if (!$model) {
            throw new \RuntimeException('Data not found');
        }

        $model->delete();
    }

    public function paginate(array $params) : array
    {
        $search  = $params['search'] ?? null;
        $orderByFieldName  = $params['orderByFieldName'] ?? '';
        $sortOrder = $params['sortOrder'] ?? 'asc';
        $pageSize = $params['pageSize'] ?? 10;
        $pageIndex = $params['pageIndex'] ?? 0;

        $skipRecord =  $pageSize*$pageIndex;

        $query = $this->model::query();

        if ($search) {
            $no = 1;
            foreach ($this->model->getFillable() as $key => $value) {
                if($no == 1){
                    $query->where($value, 'like', "%{$search}%");
                }else{
                    $query->orWhere($value, 'like', "%{$search}%");
                }
                $no++;
            }
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

    public function paginateWhere(array $params, array $where = null) : array
    {
        $search  = $params['search'] ?? null;
        $orderByFieldName  = $params['orderByFieldName'] ?? '';
        $sortOrder = $params['sortOrder'] ?? 'asc';
        $pageSize = $params['pageSize'] ?? 10;
        $pageIndex = $params['pageIndex'] ?? 0;

        $skipRecord =  $pageSize*$pageIndex;

        $query = $this->model::query();
        
        $i = 0;
        if($where){
            $no = 1;
            foreach ($where as $key => $value) {
                if($no == 1){
                    $query->where($key, $value);
                }else{
                    $query->Where($key, $value);
                }
                $no++;
                $i++;
            }
        }

        $total = $query->count();

        if ($search) {
            $no = 1;
            foreach ($this->model->getFillable() as $key => $value) {
                if($no == 1 && $i == 0){
                    $query->where($value, 'like', "%{$search}%");
                }else{
                    $query->orWhere($value, 'like', "%{$search}%");
                }
                $no++;
            }
            
        }

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
