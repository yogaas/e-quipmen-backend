<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\DTOs\UserDTO;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    use ApiResponse;
    public $model = User::class;

    public function __construct(
        protected UserService $service
    ) {}

    public function index(Request $request)
    {
        Gate::authorize('viewAny', $this->model);

        return $this->handleException(function () use ($request) {

            $users = $this->service->list($request->all());
            
            return $this->success_list( 
                UserResource::collection($users['data']),
                $users['totalCount'],
                $users['pageSize'],
                $users['pageIndex'],
                $users['sortOrder'],
                $users['orderByFieldName'],
                'User list retrieved',
            );
        });
        
    }

    public function store(UserRequest $request)
    {
        Gate::authorize('create', $this->model);

        return $this->handleException(function () use ($request) {
            $dto = UserDTO::fromArray($request->validated());
			$dto->owner = 0;
            $dto->owner_id = $this->ownerid($request);
			$user = $this->service->create($dto, [
                'role' => $request->role,
                'active' => $request->active,
            ]);

            return $this->success(
                new UserResource($user),
                'User created',
                201
            );
        });
    }

    public function show(int $id)
    {
        Gate::authorize('view', $this->model);

        return $this->handleException(function () use ($id) {

            $user = $this->service->find($id);
            
            return $this->success(
                new UserResource($user),
                'User detail retrieved'
            );
        });
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        Gate::authorize('update', $this->model);

        return $this->handleException(function () use ($id, $request) {

            $user = $this->service->update(
                $id,
                UserDTO::fromArray($request->validated()),
                [
                    'role' => $request->role,
                    'active' => $request->active,
                ]
            );

            return $this->success(
                new UserResource($user),
                'User updated'
            );
        });
    }

    public function destroy(int $id)
    {
        Gate::authorize('delete', $this->model);

        return $this->handleException(function () use ($id) {

            $this->service->delete($id);

            return $this->success(
                null,
                'User deleted'
            );
        
        });
    }
}
