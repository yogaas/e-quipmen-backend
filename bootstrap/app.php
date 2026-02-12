<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->group('api', [
            EnsureFrontendRequestsAreStateful::class,
            //'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
        $exceptions->render(function (AuthenticationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized, token tidak valid atau belum login'
                ], 401);
            }
        });
    
        // Validation error
        $exceptions->render(function (ValidationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $e->errors()
                ], 422);
            }
        });

        $exceptions->render(function (
            AccessDeniedHttpException $e,
            $request
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Access to this resource is denied.',
                'error'   => 'FORBIDDEN',
            ], 403);
        });
    })
    ->create();
