<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\AuthApiController;

// -------------------------------
// Public Routes
// -------------------------------
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

// -------------------------------
// Protected Routes (Require Auth)
// -------------------------------
Route::middleware(['auth:sanctum'])->name('api')->group(function () {

    // User info + logout
    Route::get('/user', [AuthApiController::class, 'user']);
    Route::post('/logout', [AuthApiController::class, 'logout']);

    // -------------------------------
    // Products Routes
    // -------------------------------
    Route::middleware('role:admin,manager')->group(function () {
        Route::get('products/trashed', [ProductApiController::class, 'trashed']);
        Route::post('products/{id}/restore', [ProductApiController::class, 'restore']);
        Route::delete('products/{id}/force-delete', [ProductApiController::class, 'forceDelete']);
    });

    Route::apiResource('products', ProductApiController::class);

    // -------------------------------
    // Categories Routes
    // -------------------------------
    Route::middleware('role:admin,manager')->group(function () {
        Route::get('categories/trashed', [CategoryApiController::class, 'trashed']);
        Route::post('categories/{id}/restore', [CategoryApiController::class, 'restore']);
        Route::delete('categories/{id}/force-delete', [CategoryApiController::class, 'forceDelete']);
    });

    Route::apiResource('categories', CategoryApiController::class);
});
