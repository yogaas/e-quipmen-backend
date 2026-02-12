<?php

namespace App\Http\Controllers\Api;

use App\DTOs\SectionDTO;
use Illuminate\Http\Request;
use App\Services\SectionService;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Http\Resources\SectionResource;

class SectionController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected SectionService $service
    ) {}

    public function index(Request $request)
    {
        return $this->handleException(function () use ($request) {

            $list = $this->service->list($request->all());
        
            return $this->success_list(
                SectionResource::collection($list['data']),
                $list['totalCount'],
                $list['pageSize'],
                $list['pageIndex'],
                $list['sortOrder'],
                $list['orderByFieldName'],
                'Section list retrieved',
            );
        });
        
    }

    public function store(SectionRequest $request)
    {
        return $this->handleException(function () use ($request) {
            $data = $this->service->create(
                UserDTO::fromArray($request->validated())
            );

            return $this->success(
                new UserResource($data),
                'Section created',
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
                'Section detail retrieved'
            );
        });
    }

    public function update(SectionRequest $request, int $id)
    {
        return $this->handleException(function () use ($id) {

            $data = $this->service->update(
                $id,
                SectionDTO::fromArray($request->validated())
            );

            return $this->success(
                new SectionResource($data),
                'Section updated'
            );
        });
    }

    public function destroy(int $id)
    {
        return $this->handleException(function () use ($id) {

            $this->service->delete($id);

            return $this->success(
                null,
                'Section deleted'
            );
        
        });
    }
}