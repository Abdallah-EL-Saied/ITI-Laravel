@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
    <div class="max-w-4xl mx-auto py-10 px-4">

        <!-- Header Card -->
        <div class="bg-white shadow-sm rounded-xl mb-6 p-6 flex items-center gap-4">
            <div class="text-black text-3xl">
                <i class="bi bi-plus-lg"></i>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-1">Create New Product</h4>
                <p class="text-gray-500 text-sm">Add a new product to your inventory</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-sm rounded-xl p-6">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Product Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Category *</label>
                        <select name="category_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Description</label>
                    <textarea name="description"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Price ($) *</label>
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 rounded-l-lg bg-gray-100 border border-r-0 border-gray-300">$</span>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                                class="flex-1 border border-gray-300 rounded-r-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Stock Quantity</label>
                        <input type="number" name="stock_quantity" value="{{ old('stock_quantity', 0) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Status</label>
                        <div class="flex items-center mt-2">
                            <!-- Hidden input to send 0 if checkbox is unchecked -->
                            <input type="hidden" name="is_active" value="0">

                            <input type="checkbox" name="is_active" value="1" checked
                                class="h-5 w-5 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                            <span class="ml-2 text-gray-700">Active Product</span>
                        </div>
                    </div>

                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Product Image</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-gray-400 text-sm mt-1">JPG, PNG, GIF. Max size: 2MB</p>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between items-center border-t border-gray-200 pt-4 mt-4">
                    <a href="{{ route('products.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg flex items-center gap-2 hover:bg-gray-100">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-green-500 text-white rounded-lg flex items-center gap-2 hover:bg-green-600">
                        <i class="bi bi-check-circle"></i> Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
