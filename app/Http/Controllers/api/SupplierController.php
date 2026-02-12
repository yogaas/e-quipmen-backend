<?php

    namespace App\Http\Controllers\Api;
    
    use App\DTOs\SupplierDTO;
    use Illuminate\Http\Request;
    use App\Services\SupplierService;
    use App\Traits\ApiResponse;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\SupplierRequest;
    use App\Http\Resources\SupplierResource;
    
    class SupplierController extends Controller
    {
        use ApiResponse;
    
        public function __construct(
            protected SupplierService $service
        ) {}
    
        public function index(Request $request)
        {
            return $this->handleException(function () use ($request) {
    
                $list = $this->service->list($request->all());
            
                return $this->success_list(
                    SupplierResource::collection($list['data']),
                    $list['totalCount'],
                    $list['pageSize'],
                    $list['pageIndex'],
                    $list['sortOrder'],
                    $list['orderByFieldName'],
                    'Supplier list retrieved',
                );
            });
            
        }
    
        public function store(SupplierRequest $request)
        {
            return $this->handleException(function () use ($request) {
                $data = $this->service->create(
                    UserDTO::fromArray($request->validated())
                );
    
                return $this->success(
                    new UserResource($data),
                    'Supplier created',
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
                    'Supplier detail retrieved'
                );
            });
        }
    
        public function update(SupplierRequest $request, int $id)
        {
            return $this->handleException(function () use ($id) {
    
                $data = $this->service->update(
                    $id,
                    SupplierDTO::fromArray($request->validated())
                );
    
                return $this->success(
                    new SupplierResource($data),
                    'Supplier updated'
                );
            });
        }
    
        public function destroy(int $id)
        {
            return $this->handleException(function () use ($id) {
    
                $this->service->delete($id);
    
                return $this->success(
                    null,
                    'Supplier deleted'
                );
            
            });
        }
    }