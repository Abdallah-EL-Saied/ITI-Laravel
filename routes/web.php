<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ----------------------
// Profile Routes
// ----------------------
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ----------------------
// Products Routes
// ----------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // Trashed Products
    Route::get('/products/trashed', [ProductController::class, 'trashed'])
        ->middleware('role:manager,admin')
        ->name('products.trashed');

    // Restore Product
    Route::post('/products/{id}/restore', [ProductController::class, 'restore'])
        ->middleware('role:manager,admin')
        ->name('products.restore');

    // Force Delete Product
    Route::delete('/products/{id}/force-delete', [ProductController::class, 'forceDelete'])
        ->middleware('role:admin')
        ->name('products.forceDelete');

    // Standard Resource Routes (index, create, store, show, edit, update, destroy)
    Route::resource('products', ProductController::class);
});

// ----------------------
// Categories Routes
// ----------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // Trashed Categories
    Route::get('/categories/trashed', [CategoryController::class, 'trashed'])
        ->middleware('role:manager,admin')
        ->name('categories.trashed');

    // Restore Category
    Route::post('/categories/{id}/restore', [CategoryController::class, 'restore'])
        ->middleware('role:manager,admin')
        ->name('categories.restore');

    // Force Delete Category
    Route::delete('/categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])
        ->middleware('role:admin')
        ->name('categories.forceDelete');

    // Standard Resource Routes (index, create, store, show, edit, update, destroy)
    Route::resource('categories', CategoryController::class);
});

// Include auth routes (login, register, password reset, etc.)
require __DIR__ . '/auth.php';
