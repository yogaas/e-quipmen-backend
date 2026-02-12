<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * Exceptions that should not be reported.
     */
    protected $dontReport = [];

    /**
     * Inputs that are never flashed for validation exceptions.
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register exception handling callbacks.
     */
    public function register(): void
    {
        /**
         * 🔴 Model not found (findOrFail)
         */
        $this->renderable(function (ModelNotFoundException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data'    => null,
                'errors'  => null
            ], 404);
        });

        /**
         * 🔴 Validation error
         */
        $this->renderable(function (ValidationException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data'    => null,
                'errors'  => $e->errors()
            ], 422);
        });

        /**
         * 🔴 Authentication error
         */
        $this->renderable(function (AuthenticationException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
                'data'    => null,
                'errors'  => null
            ], 401);
        });

        /**
         * 🔴 HTTP exceptions (403, 404 manual, dll)
         */
        $this->renderable(function (HttpException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'HTTP error',
                'data'    => null,
                'errors'  => null
            ], $e->getStatusCode());
        });

        /**
         * 🔴 Fallback: unexpected error
         */
        $this->renderable(function (Throwable $e, $request) {

            // LOG error (WAJIB di production)
            logger()->error($e);

            // Mode debug (local / staging)
            if (config('app.debug')) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                    'data'    => null,
                    'errors'  => [
                        'exception' => class_basename($e),
                        'file'      => $e->getFile(),
                        'line'      => $e->getLine(),
                    ]
                ], 500);
            }

            // Production mode
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'data'    => null,
                'errors'  => null
            ], 500);
        });
    }
}
