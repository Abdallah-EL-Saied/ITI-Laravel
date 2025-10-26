@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('products.index') }}"
           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 gap-2">
            <i class="bi bi-arrow-left"></i> Back to Products
        </a>
    </div>

    <!-- Product Card -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="md:flex md:gap-0">

            <!-- Image Section -->
            <div class="md:w-5/12">
                @if($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}"
                         class="w-full h-full object-cover rounded-l-xl min-h-[500px]"
                         alt="{{ $product->name }}">
                @else
                    <div class="w-full h-full bg-gray-100 flex items-center justify-center min-h-[500px]">
                        <div class="text-center text-gray-400">
                            <i class="bi bi-image text-6xl"></i>
                            <p class="mt-3">No Image Available</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Details Section -->
            <div class="md:w-7/12 p-6 md:p-10 flex flex-col">

                <!-- Header -->
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-blue-600">{{ $product->name }}</h1>
                        <span class="inline-block bg-gray-300 text-gray-700 text-sm px-3 py-1 rounded-lg mt-1">
                            {{ optional($product->category)->name ?? 'N/A' }}
                        </span>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-green-600 mb-2">
                            ${{ number_format($product->price, 2) }}
                        </div>
                        <div class="flex gap-2 justify-end flex-wrap">
                            <span class="px-2 py-1 text-sm rounded-lg {{ $product->is_active ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            <span class="px-2 py-1 text-sm rounded-lg {{ $product->stock_quantity > 0 ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                Stock: {{ $product->stock_quantity }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h5 class="font-semibold mb-2">Description</h5>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $product->description ?: 'No description provided.' }}
                    </p>
                </div>

                <!-- Product Details Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-100 p-4 rounded-lg text-center">
                        <i class="bi bi-tag text-blue-600 text-4xl mb-2 inline-block"></i>
                        <h6 class="font-bold mb-1">Category</h6>
                        <p>{{ optional($product->category)->name ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg text-center">
                        <i class="bi bi-box-seam text-green-600 text-4xl mb-2 inline-block"></i>
                        <h6 class="font-bold mb-1">Stock Level</h6>
                        <p class="font-bold {{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock_quantity }} units
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4 border-t border-gray-200 flex-wrap">
                    <a href="{{ route('products.edit', $product->id) }}"
                       class="flex-1 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 flex justify-center items-center gap-2">
                        <i class="bi bi-pencil"></i> Edit Product
                    </a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 flex justify-center items-center gap-2"
                                onclick="return confirm('Are you sure you want to delete this product?')">
                            <i class="bi bi-trash"></i> Delete Product
                        </button>
                    </form>
                </div>

                <!-- Additional Info -->
                <div class="mt-6 pt-4 border-t border-gray-200 text-gray-500 text-sm flex justify-between flex-wrap">
                    <div class="flex items-center gap-1">
                        <i class="bi bi-calendar"></i>
                        Created: {{ $product->created_at->format('M d, Y') }}
                    </div>
                    <div class="flex items-center gap-1 justify-end">
                        <i class="bi bi-arrow-clockwise"></i>
                        Updated: {{ $product->updated_at->format('M d, Y') }}
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
