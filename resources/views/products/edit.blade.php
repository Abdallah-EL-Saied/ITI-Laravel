@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="max-w-4xl mx-auto py-10 px-4">

        <!-- Header Card -->
        <div class="bg-white shadow-sm rounded-xl mb-6 p-6 flex items-center gap-4">
            <div class="bg-yellow-500 text-white rounded-full p-3 text-2xl flex items-center justify-center">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-1">Edit Product</h4>
                <p class="text-gray-500 text-sm">Update product information</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-sm rounded-xl p-6">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Product Name *</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                            required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Category *</label>
                        <select name="category_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                            required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Price ($) *</label>
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 rounded-l-lg bg-gray-100 border border-r-0 border-gray-300">$</span>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                                class="flex-1 border border-gray-300 rounded-r-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Stock Quantity</label>
                        <input type="number" name="stock_quantity"
                            value="{{ old('stock_quantity', $product->stock_quantity) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Status</label>
                        <div class="flex items-center mt-2">
                            <!-- Hidden input to send 0 if checkbox is unchecked -->
                            <input type="hidden" name="is_active" value="0">

                            <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}
                                class="h-5 w-5 text-yellow-500 rounded focus:ring-2 focus:ring-yellow-400">
                            <span class="ml-2 text-gray-700">Active Product</span>
                        </div>
                    </div>

                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Product Image</label>
                    @if($product->image)
                        <div class="mb-3">
                            <p class="text-gray-500 mb-2">Current Image:</p>
                            <img src="{{ asset('storage/products/' . $product->image) }}" class="rounded-lg"
                                style="max-height: 150px;">
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <p class="text-gray-400 text-sm mt-1">Leave empty to keep current image</p>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between items-center border-t border-gray-200 pt-4 mt-4">
                    <a href="{{ route('products.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg flex items-center gap-2 hover:bg-gray-100">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <div class="flex gap-2">
                        <a href="{{ route('products.show', $product->id) }}"
                            class="px-4 py-2 border border-blue-500 text-blue-500 rounded-lg flex items-center gap-2 hover:bg-blue-50">
                            <i class="bi bi-eye"></i> View
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-yellow-500 text-white rounded-lg flex items-center gap-2 hover:bg-yellow-600">
                            <i class="bi bi-check-circle"></i> Update
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection
