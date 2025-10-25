@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning rounded-circle p-3 text-white me-3">
                            <i class="bi bi-pencil-square fs-4"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-bold">Edit Product</h4>
                            <p class="text-muted mb-0">Update product information</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Product Name *</label>
                                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                       class="form-control form-control-lg" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Category *</label>
                                <select name="category" class="form-select form-select-lg" required>
                                    <option value="">Select Category</option>
                                    <option value="Electronics" {{ $product->category == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                                    <option value="Clothing" {{ $product->category == 'Clothing' ? 'selected' : '' }}>Clothing</option>
                                    <option value="Books" {{ $product->category == 'Books' ? 'selected' : '' }}>Books</option>
                                    <option value="Home & Garden" {{ $product->category == 'Home & Garden' ? 'selected' : '' }}>Home & Garden</option>
                                    <option value="Sports" {{ $product->category == 'Sports' ? 'selected' : '' }}>Sports</option>
                                    <option value="Toys" {{ $product->category == 'Toys' ? 'selected' : '' }}>Toys</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Price ($) *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">$</span>
                                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                                           class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Stock Quantity</label>
                                <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                       class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input type="checkbox" name="is_active" value="1"
                                           {{ $product->is_active ? 'checked' : '' }} class="form-check-input">
                                    <label class="form-check-label">Active Product</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Product Image</label>
                                @if($product->image)
                                <div class="mb-3">
                                    <p class="text-muted mb-2">Current Image:</p>
                                    <img src="{{ asset('storage/products/' . $product->image) }}"
                                         class="img-thumbnail me-3" style="max-height: 150px;">
                                </div>
                                @endif
                                <input type="file" name="image" accept="image/*" class="form-control">
                                <div class="form-text">Leave empty to keep current image</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </a>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary px-4">
                                    <i class="bi bi-eye me-2"></i>View
                                </a>
                                <button type="submit" class="btn btn-warning px-5">
                                    <i class="bi bi-check-circle me-2"></i>Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
