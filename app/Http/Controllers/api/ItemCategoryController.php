<?php

    namespace App\Http\Controllers\Api;
    
    use App\DTOs\ItemCategoryDTO;
    use Illuminate\Http\Request;
    use App\Services\ItemCategoryService;
    use App\Traits\ApiResponse;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\ItemCategoryRequest;
    use App\Http\Resources\ItemCategoryResource;
    
    class ItemCategoryController extends Controller
    {
        use ApiResponse;
    
        public function __construct(
            protected ItemCategoryService $service
        ) {}
    
        public function index(Request $request)
        {
            return $this->handleException(function () use ($request) {
    
                $list = $this->service->list($request->all(), $this->ownerid($request));
            
                return $this->success_list(
                    ItemCategoryResource::collection($list['data']),
                    $list['totalCount'],
                    $list['pageSize'],
                    $list['pageIndex'],
                    $list['sortOrder'],
                    $list['orderByFieldName'],
                    'ItemCategory list retrieved',
                );
            });
            
        }
    
        public function store(ItemCategoryRequest $request)
        {
            return $this->handleException(function () use ($request) {
                $data = $this->service->create(
                    UserDTO::fromArray($request->validated())
                );
    
                return $this->success(
                    new UserResource($data),
                    'ItemCategory created',
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
                    'ItemCategory detail retrieved'
                );
            });
        }
    
        public function update(ItemCategoryRequest $request, int $id)
        {
            return $this->handleException(function () use ($id) {
    
                $data = $this->service->update(
                    $id,
                    ItemCategoryDTO::fromArray($request->validated())
                );
    
                return $this->success(
                    new ItemCategoryResource($data),
                    'ItemCategory updated'
                );
            });
        }
    
        public function destroy(int $id)
        {
            return $this->handleException(function () use ($id) {
    
                $this->service->delete($id);
    
                return $this->success(
                    null,
                    'ItemCategory deleted'
                );
            
            });
        }
    }