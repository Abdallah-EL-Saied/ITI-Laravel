@extends('layouts.app')

@section('title', 'All Products')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">All Products</h3>

        <div class="d-flex gap-2">
            <form class="d-flex" method="GET" action="{{ route('products.index') }}">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm"
                    placeholder="Search...">
                <button class="btn btn-outline-primary btn-sm ms-2"><i class="bi bi-search"></i></button>
            </form>
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Add
            </a>
        </div>
    </div>

    @if($products->count())
        <div class="row g-3">
            @foreach($products as $product)
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 shadow-sm border-0">
                        @if($product->image)
                            <img src="{{ asset('storage/products/' . $product->image) }}" class="card-img-top"
                                style="height: 180px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 180px;">
                                <i class="bi bi-image text-secondary fs-1"></i>
                            </div>
                        @endif

                        <div class="card-body">
                            <h6 class="card-title mb-1 text-primary">{{ $product->name }}</h6>
                            <p class="small text-muted mb-2">{{ Str::limit($product->description, 50) }}</p>
                            <p class="fw-semibold mb-0">EGP {{ number_format($product->price, 2) }}</p>
                        </div>

                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Delete this product?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center flex-column mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>

        {{-- Hide "Showing X to Y of Z results" ONLY on this page --}}
        <style>
            nav[role="navigation"]+p,
            nav[role="navigation"]+div {
                display: none !important;
            }
        </style>

    @else
        <div class="text-center py-5">
            <i class="bi bi-box text-secondary fs-1"></i>
            <p class="mt-3 text-muted">No products found.</p>
        </div>
    @endif
@endsection
