@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Products
                </a>
            </div>

            <!-- Product Card -->
            <div class="card border-0 shadow-lg">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- Image Section -->
                        <div class="col-md-5">
                            @if($product->image)
                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                     class="img-fluid rounded-start h-100 w-100"
                                     alt="{{ $product->name }}"
                                     style="object-fit: cover; min-height: 500px;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center h-100 min-vh-50">
                                    <div class="text-center text-muted">
                                        <i class="bi bi-image display-1"></i>
                                        <p class="mt-3">No Image Available</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Details Section -->
                        <div class="col-md-7">
                            <div class="p-4 p-md-5">
                                <!-- Header -->
                                <div class="d-flex justify-content-between align-items-start mb-4">
                                    <div>
                                        <h1 class="h2 fw-bold text-primary">{{ $product->name }}</h1>
                                        <span class="badge bg-secondary fs-6">{{ $product->category }}</span>
                                    </div>
                                    <div class="text-end">
                                        <div class="h3 text-success fw-bold mb-2">${{ number_format($product->price, 2) }}</div>
                                        <div class="d-flex gap-2">
                                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                            <span class="badge {{ $product->stock_quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                                Stock: {{ $product->stock_quantity }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <h5 class="fw-semibold mb-3">Description</h5>
                                    <p class="text-muted lead">{{ $product->description ?: 'No description provided.' }}</p>
                                </div>

                                <!-- Product Details -->
                                <div class="row g-3 mb-4">
                                    <div class="col-sm-6">
                                        <div class="card bg-light border-0">
                                            <div class="card-body text-center">
                                                <i class="bi bi-tag fs-1 text-primary mb-2"></i>
                                                <h6 class="fw-bold">Category</h6>
                                                <p class="mb-0">{{ $product->category }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card bg-light border-0">
                                            <div class="card-body text-center">
                                                <i class="bi bi-box-seam fs-1 text-success mb-2"></i>
                                                <h6 class="fw-bold">Stock Level</h6>
                                                <p class="mb-0 {{ $product->stock_quantity > 0 ? 'text-success' : 'text-danger' }} fw-bold">
                                                    {{ $product->stock_quantity }} units
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-3 pt-4 border-top">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="btn btn-warning px-4 flex-fill">
                                        <i class="bi bi-pencil me-2"></i>Edit Product
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-fill">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100"
                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                            <i class="bi bi-trash me-2"></i>Delete Product
                                        </button>
                                    </form>
                                </div>

                                <!-- Additional Info -->
                                <div class="mt-4 pt-3 border-top">
                                    <div class="row text-muted small">
                                        <div class="col-6">
                                            <i class="bi bi-calendar me-1"></i>
                                            Created: {{ $product->created_at->format('M d, Y') }}
                                        </div>
                                        <div class="col-6 text-end">
                                            <i class="bi bi-arrow-clockwise me-1"></i>
                                            Updated: {{ $product->updated_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
