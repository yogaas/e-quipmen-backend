<?php

    namespace App\Http\Controllers\Api;
    
    use App\DTOs\CustomerDTO;
    use Illuminate\Http\Request;
    use App\Services\CustomerService;
    use App\Traits\ApiResponse;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\CustomerRequest;
    use App\Http\Resources\CustomerResource;
    
    class CustomerController extends Controller
    {
        use ApiResponse;
    
        public function __construct(
            protected CustomerService $service
        ) {}
    
        public function index(Request $request)
        {
            return $this->handleException(function () use ($request) {
    
                $list = $this->service->list($request->all());
            
                return $this->success_list(
                    CustomerResource::collection($list['data']),
                    $list['totalCount'],
                    $list['pageSize'],
                    $list['pageIndex'],
                    $list['sortOrder'],
                    $list['orderByFieldName'],
                    'Customer list retrieved',
                );
            });
            
        }
    
        public function store(CustomerRequest $request)
        {
            return $this->handleException(function () use ($request) {
                $data = $this->service->create(
                    UserDTO::fromArray($request->validated())
                );
    
                return $this->success(
                    new UserResource($data),
                    'Customer created',
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
                    'Customer detail retrieved'
                );
            });
        }
    
        public function update(CustomerRequest $request, int $id)
        {
            return $this->handleException(function () use ($id) {
    
                $data = $this->service->update(
                    $id,
                    CustomerDTO::fromArray($request->validated())
                );
    
                return $this->success(
                    new CustomerResource($data),
                    'Customer updated'
                );
            });
        }
    
        public function destroy(int $id)
        {
            return $this->handleException(function () use ($id) {
    
                $this->service->delete($id);
    
                return $this->success(
                    null,
                    'Customer deleted'
                );
            
            });
        }
    }