<?php

namespace App\Http\Controllers\Api;

use App\DTOs\SaleDTO;
use Illuminate\Http\Request;
use App\Services\SaleService;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\SaleResource;
use App\Http\Resources\SaleListResource;

class SaleController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected SaleService $service
    ) {}

    public function index(Request $request)
    {
        return $this->handleException(function () use ($request) {

            $list = $this->service->list($request->all());
        
            return $this->success_list(
                SaleListResource::collection($list['data']),
                $list['totalCount'],
                $list['pageSize'],
                $list['pageIndex'],
                $list['sortOrder'],
                $list['orderByFieldName'],
                'Sale list retrieved',
            );
        });
        
    }

    public function store(SaleRequest $request)
    {
        return $this->handleException(function () use ($request) {

            $uniqueCode = $this->generateUniqueCode("TRX", "sales", "unique_code");
            $req =  SaleDTO::fromArray($request->validated());
            $req->unique_code = $uniqueCode;
            $req->owner_id = $this->ownerid($request);

            $data = $this->service->create(
                $req
            );
            
            $data->unique_code = $uniqueCode;
            $data->details = $req->details;

            return $this->success(
                new SaleResource($data, true),
                'Sale created',
                201
            );
        });
    }

    public function show(string $id)
    {
        return $this->handleException(function () use ($id) {

            $data = $this->service->find($id);
            
            return $this->success(
                new SaleResource($data, true),
                'Sale detail retrieved'
            );
        });
    }

    public function update(SaleRequest $request, int $id)
    {
        return $this->handleException(function () use ($id) {

            $data = $this->service->update(
                $id,
                SaleDTO::fromArray($request->validated())
            );

            return $this->success(
                new SaleResource($data),
                'Sale updated'
            );
        });
    }

    public function destroy(int $id)
    {
        return $this->handleException(function () use ($id) {

            $this->service->delete($id);

            return $this->success(
                null,
                'Sale deleted'
            );
        
        });
    }
}