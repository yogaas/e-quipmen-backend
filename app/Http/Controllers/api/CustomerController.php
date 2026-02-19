<?php

    namespace App\Http\Controllers\Api;
    
    use App\Models\Customer;
    use App\DTOs\CustomerDTO;
    use Illuminate\Http\Request;
    use App\Services\CustomerService;
    use App\Traits\ApiResponse;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\CustomerRequest;
    use App\Http\Resources\CustomerResource;
    use Illuminate\Support\Facades\Gate;
    
    class CustomerController extends Controller
    {
        use ApiResponse;
        public $model = Customer::class;
    
        public function __construct(
            protected CustomerService $service
        ) {}
    
        public function index(Request $request)
        {
            Gate::authorize('viewAny', $this->model);

            return $this->handleException(function () use ($request) {
    
                $where = ['owner_id' => $this->ownerid($request)];
                $list = $this->service->list($request->all(), $where);
            
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
            Gate::authorize('create', $this->model);

            return $this->handleException(function () use ($request) {

                $dto = CustomerDTO::fromArray($request->validated());
                $dto->owner_id = $this->ownerid($request);
                $data = $this->service->create($dto);
    
                return $this->success(
                    new CustomerResource($data),
                    'Customer created',
                    201
                );
            });
        }
    
        public function show(int $id)
        {
            Gate::authorize('view', $this->model);

            return $this->handleException(function () use ($id) {
    
                $data = $this->service->find($id);
    
                return $this->success(
                    new CustomerResource($data),
                    'Customer detail retrieved'
                );
            });
        }
    
        public function update(CustomerRequest $request, int $id)
        {
            Gate::authorize('update', $this->model);

            return $this->handleException(function () use ($id, $request) {
    
                $dto = CustomerDTO::fromArray($request->validated());
                $dto->owner_id = $this->ownerid($request);
                $data = $this->service->update(
                    $id,
                    $dto
                );
    
                return $this->success(
                    new CustomerResource($data),
                    'Customer updated'
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
                    'Customer deleted'
                );
            
            });
        }
    }