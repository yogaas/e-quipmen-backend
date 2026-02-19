<?php

    namespace App\Http\Controllers\Api;
    
    use App\Models\Role;
    use App\DTOs\RoleDTO;
    use Illuminate\Http\Request;
    use App\Services\RoleService;
    use App\Traits\ApiResponse;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\RoleRequest;
    use App\Http\Resources\RoleResource;
    use Illuminate\Support\Facades\Gate;
    
    class RoleController extends Controller
    {
        use ApiResponse;
        public $model = Role::class;
    
        public function __construct(
            protected RoleService $service
        ) {}
    
        public function index(Request $request)
        {
            Gate::authorize('viewAny', $this->model);

            return $this->handleException(function () use ($request) {
    
                $where = ['owner_id' => $this->ownerid($request)];
                $list = $this->service->list($request->all(), $where);
            
                return $this->success_list(
                    RoleResource::collection($list['data']),
                    $list['totalCount'],
                    $list['pageSize'],
                    $list['pageIndex'],
                    $list['sortOrder'],
                    $list['orderByFieldName'],
                    'Role list retrieved',
                );
            });
            
        }

        public function menus()
        {
            return $this->handleException(function () {
    
                $list = $this->service->menu_all();
                return $this->success(
                    $list,
                    'Menus retrieved',
                    200
                );
            });
            
        }
    
        public function store(RoleRequest $request)
        {
            Gate::authorize('create', $this->model);

            return $this->handleException(function () use ($request) {
                $dto = RoleDTO::fromArray($request->validated());
                $dto->owner_id = $this->ownerid($request);
                $menu_user = $request->input('menus');
                $data = $this->service->create($dto, $menu_user);
                $data->menus = $menu_user;

                return $this->success(
                    new RoleResource($data),
                    'Role created',
                    201
                );
            });
        }
    
        public function show(string $id)
        {
            Gate::authorize('view', $this->model);

            return $this->handleException(function () use ($id) {
    
                $data = $this->service->find($id);
    
                return $this->success(
                    new RoleResource($data),
                    'Role detail retrieved'
                );
            });
        }
    
        public function update(RoleRequest $request, string $id)
        {
            Gate::authorize('update', $this->model);

            return $this->handleException(function () use ($id,$request) {
    
            $dto = RoleDTO::fromArray($request->validated());
                $dto->owner_id = $this->ownerid($request);
                $menu_user = $request->input('menus');
                $data = $this->service->update(
                    $id,
                    $dto,
                    $menu_user
                );
    
                return $this->success(
                    new RoleResource($data),
                    'Role updated'
                );
            });
        }
    
        public function destroy(string $id)
        {
            Gate::authorize('delete', $this->model);

            return $this->handleException(function () use ($id) {
    
                $this->service->delete($id);
    
                return $this->success(
                    null,
                    'Role deleted'
                );
            
            });
        }
    }