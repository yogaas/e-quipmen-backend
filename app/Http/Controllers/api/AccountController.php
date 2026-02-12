<?php

namespace App\Http\Controllers\Api;

use App\DTOs\AccountDTO;
use Illuminate\Http\Request;
use App\Services\AccountService;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;

class AccountController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected AccountService $service
    ) {}

    public function index(Request $request)
    {
        return $this->handleException(function () use ($request) {

            $list = $this->service->list($request->all());
        
            return $this->success_list(
                AccountResource::collection($list['data']),
                $list['totalCount'],
                $list['pageSize'],
                $list['pageIndex'],
                $list['sortOrder'],
                $list['orderByFieldName'],
                'Account list retrieved',
            );
        });
        
    }

    public function store(AccountRequest $request)
    {
        return $this->handleException(function () use ($request) {
            $data = $this->service->create(
                UserDTO::fromArray($request->validated())
            );

            return $this->success(
                new UserResource($data),
                'Account created',
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
                'Account detail retrieved'
            );
        });
    }

    public function update(AccountRequest $request, int $id)
    {
        return $this->handleException(function () use ($id) {

            $data = $this->service->update(
                $id,
                AccountDTO::fromArray($request->validated())
            );

            return $this->success(
                new AccountResource($data),
                'Account updated'
            );
        });
    }

    public function destroy(int $id)
    {
        return $this->handleException(function () use ($id) {

            $this->service->delete($id);

            return $this->success(
                null,
                'Account deleted'
            );
        
        });
    }
}