<?php

use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ItemCategoryController;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\TypePaymentController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\SaleController;


Route::prefix('api/v1')->group(function () {

    Route::post('/token', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/refresh-token', [AuthController::class, 'refresh']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

    
        Route::apiResource('users', UserController::class);
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('categories', ItemCategoryController::class);
        Route::apiResource('items', ItemsController::class);
        Route::apiResource('suppliers', SupplierController::class);
        Route::apiResource('accounts', AccountController::class);
        Route::apiResource('type-payment', TypePaymentController::class);
        Route::apiResource('sections', SectionController::class);
        Route::apiResource('sales', SaleController::class);
    });
});



