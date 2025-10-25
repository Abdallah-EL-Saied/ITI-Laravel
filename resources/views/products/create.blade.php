@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-success rounded-circle p-3 text-white me-3">
                            <i class="bi bi-plus-lg fs-4"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-bold">Create New Product</h4>
                            <p class="text-muted mb-0">Add a new product to your inventory</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Product Name *</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="form-control form-control-lg" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Category *</label>
                                <select name="category" class="form-select form-select-lg" required>
                                    <option value="">Select Category</option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Clothing">Clothing</option>
                                    <option value="Books">Books</option>
                                    <option value="Home & Garden">Home & Garden</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Toys">Toys</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Price ($) *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">$</span>
                                    <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                                           class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Stock Quantity</label>
                                <input type="number" name="stock_quantity" value="{{ old('stock_quantity', 0) }}"
                                       class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input type="checkbox" name="is_active" value="1" checked
                                           class="form-check-input">
                                    <label class="form-check-label">Active Product</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Product Image</label>
                                <input type="file" name="image" accept="image/*" class="form-control">
                                <div class="form-text">JPG, PNG, GIF. Max size: 2MB</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-success px-5">
                                <i class="bi bi-check-circle me-2"></i>Create Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
