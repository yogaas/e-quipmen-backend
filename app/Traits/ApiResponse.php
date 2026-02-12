<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function success(
        mixed $data = null,
        string $message = 'Success',
        int $status = 200
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
            'errors'  => null
        ], $status);
    }

    protected function error(
        string $message = 'Error',
        mixed $errors = null,
        int $status = 500
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => null,
            'errors'  => $errors
        ], $status);
    }

    protected function success_list(
        mixed $data = null,
        int $totalCount = 0,
        int $pageSize = 0,
        int $pageIndex = 0,
        string $sortOrder = '',
        string $orderByFieldName = '',
        
        string $message = 'Success',
        int $status = 200
    ): JsonResponse {
        return response()->json([
            'success'           => true,
            'message'           => $message,
            'data'              => $data,
            'totalCount'        => $totalCount,
            'pageSize'          => $pageSize,
            'pageIndex'         => $pageIndex,
            'sortOrder'         => $sortOrder,
            'orderByFieldName'  => $orderByFieldName,
            'errors'            => null
        ], $status);
    }
}
