<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckProductLimit;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Products routes with middleware only on create and store
Route::middleware('auth')->group(function () {

    // Middleware on create & store only
    Route::middleware([CheckProductLimit::class])->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    });

    // Resource routes for products excluding create & store
    Route::resource('products', ProductController::class)
        ->except(['create', 'store']);

    // Resource routes for categories (full CRUD)
    Route::resource('categories', CategoryController::class);
});

require __DIR__ . '/auth.php';
