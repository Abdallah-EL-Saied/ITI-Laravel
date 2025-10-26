@extends('layouts.app')

@section('title', 'All Products')

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
        <h3 class="text-xl font-bold">All Products</h3>

        <div class="flex flex-wrap gap-2">
            <!-- Search Form -->
            <form class="flex" method="GET" action="{{ route('products.index') }}">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="px-3 py-1 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Search products...">
                <button
                    class="px-3 py-1 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 flex items-center justify-center">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <!-- Add Product Button -->
            <a href="{{ route('products.create') }}"
                class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 flex items-center gap-1">
                <i class="bi bi-plus-circle"></i> Add Product
            </a>
        </div>
    </div>

    @if($products->count())
        <!-- Products Table -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($products as $index => $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($product->image)
                                    <img src="{{ asset('storage/products/' . $product->image) }}" class="h-16 w-16 object-cover rounded"
                                        alt="{{ $product->name }}">
                                @else
                                    <div class="h-16 w-16 bg-gray-100 flex items-center justify-center rounded text-gray-400">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold text-blue-600">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-gray-500 text-sm">{{ Str::limit($product->description, 60) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-bold">EGP {{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                <a href="{{ route('products.show', $product->id) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-600 rounded hover:bg-blue-200 flex items-center gap-1">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded hover:bg-yellow-200 flex items-center gap-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this product?');">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 flex items-center gap-1">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center flex-col">
            {{ $products->appends(request()->query())->links('pagination::tailwind') }}
        </div>

    @else
        <!-- Empty State -->
        <div class="text-center py-20">
            <i class="bi bi-box text-gray-400 text-5xl"></i>
            <p class="mt-4 text-gray-500">No products available.</p>
        </div>
    @endif
@endsection
