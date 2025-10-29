<x-app-layout>
    <x-slot name="header">
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Create New Product</h3>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow rounded-lg p-6">

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Product Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:text-gray-100"
                            required>
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Category *</label>
                        <select name="category_id"
                            class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:text-gray-100"
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
                    <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:text-gray-100">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Price ($) *</label>
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 rounded-l-lg bg-gray-100 dark:bg-gray-700 border border-r-0 border-gray-300 dark:border-gray-700">$</span>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                                class="flex-1 border border-gray-300 dark:border-gray-700 rounded-r-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:text-gray-100"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Stock Quantity</label>
                        <input type="number" name="stock_quantity" value="{{ old('stock_quantity', 0) }}"
                            class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:text-gray-100">
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Status</label>
                        <div class="flex items-center mt-2">
                            <input type="checkbox" name="is_active" value="1" checked
                                class="h-5 w-5 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">Active Product</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Product Image</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:text-gray-100">
                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">JPG, PNG, GIF. Max size: 2MB</p>
                </div>

                <div class="flex justify-between items-center border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                    <x-button href="{{ route('products.index') }}" icon="bi bi-arrow-left" type="secondary">
                        Back
                    </x-button>

                    <x-button type="success" icon="bi bi-check-circle" :submit="true">
                        Create Product
                    </x-button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
