<?php

    namespace App\Http\Controllers\Api;
    
    use App\DTOs\ItemsDTO;
    use Illuminate\Http\Request;
    use App\Services\ItemsService;
    use App\Traits\ApiResponse;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\ItemsRequest;
    use App\Http\Resources\ItemsResource;
    
    class ItemsController extends Controller
    {
        use ApiResponse;
    
        public function __construct(
            protected ItemsService $service
        ) {}
    
        public function index(Request $request)
        {
            return $this->handleException(function () use ($request) {
    
                $list = $this->service->list($request->all());
            
                return $this->success_list(
                    ItemsResource::collection($list['data']),
                    $list['totalCount'],
                    $list['pageSize'],
                    $list['pageIndex'],
                    $list['sortOrder'],
                    $list['orderByFieldName'],
                    'Items list retrieved',
                );
            });
            
        }
    
        public function store(ItemsRequest $request)
        {
            return $this->handleException(function () use ($request) {
                $data = $this->service->create(
                    UserDTO::fromArray($request->validated())
                );
    
                return $this->success(
                    new UserResource($data),
                    'Items created',
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
                    'Items detail retrieved'
                );
            });
        }
    
        public function update(ItemsRequest $request, int $id)
        {
            return $this->handleException(function () use ($id) {
    
                $data = $this->service->update(
                    $id,
                    ItemsDTO::fromArray($request->validated())
                );
    
                return $this->success(
                    new ItemsResource($data),
                    'Items updated'
                );
            });
        }
    
        public function destroy(int $id)
        {
            return $this->handleException(function () use ($id) {
    
                $this->service->delete($id);
    
                return $this->success(
                    null,
                    'Items deleted'
                );
            
            });
        }
    }
