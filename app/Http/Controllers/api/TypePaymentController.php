<?php

namespace App\Http\Controllers\Api;

use App\DTOs\TypePaymentDTO;
use Illuminate\Http\Request;
use App\Services\TypePaymentService;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypePaymentRequest;
use App\Http\Resources\TypePaymentResource;

class TypePaymentController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected TypePaymentService $service
    ) {}

    public function index(Request $request)
    {
        return $this->handleException(function () use ($request) {

            $list = $this->service->list($request->all());
        
            return $this->success_list(
                TypePaymentResource::collection($list['data']),
                $list['totalCount'],
                $list['pageSize'],
                $list['pageIndex'],
                $list['sortOrder'],
                $list['orderByFieldName'],
                'TypePayment list retrieved',
            );
        });
        
    }

    public function store(TypePaymentRequest $request)
    {
        return $this->handleException(function () use ($request) {
            $data = $this->service->create(
                UserDTO::fromArray($request->validated())
            );

            return $this->success(
                new UserResource($data),
                'TypePayment created',
                201
            );
        });
    }

    public function show(int $id)
    {
        return $this->handleException(function () use ($id) {

            $data = $this->service->find($id);

            return $this->success(
                new UserResource($data),
                'TypePayment detail retrieved'
            );
        });
    }

    public function update(TypePaymentRequest $request, int $id)
    {
        return $this->handleException(function () use ($id) {

            $data = $this->service->update(
                $id,
                TypePaymentDTO::fromArray($request->validated())
            );

            return $this->success(
                new TypePaymentResource($data),
                'TypePayment updated'
            );
        });
    }

    public function destroy(int $id)
    {
        return $this->handleException(function () use ($id) {

            $this->service->delete($id);

            return $this->success(
                null,
                'TypePayment deleted'
            );
        
        });
    }
}