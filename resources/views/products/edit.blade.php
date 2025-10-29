<x-app-layout>
    <x-slot name="header">
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Edit Product</h3>
        <!-- Static Success Alert -->
        <div role="status" aria-live="polite"
            class="max-w-xl mx-auto p-4 rounded-2xl bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 shadow-sm">
            <div class="flex items-start gap-3">
                <!-- Icon -->
                <svg class="w-6 h-6 shrink-0 text-green-600 dark:text-green-300" viewBox="0 0 20 20" fill="currentColor"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>

                <div class="flex-1">
                    <p class="font-semibold text-green-800 dark:text-green-200">@session('error')
                        {{ session('error') }}
                    @endsession
                    </p>
                    <p class="mt-1 text-sm text-green-700 dark:text-green-100">Your operation completed successfully.
                    </p>
                </div>
            </div>
        </div>

    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow rounded-lg p-6">

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Product Name *</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}"
                            class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:bg-gray-900 dark:text-gray-100"
                            required>
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Category *</label>
                        <select name="category_id"
                            class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:bg-gray-900 dark:text-gray-100"
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
                    <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:bg-gray-900 dark:text-gray-100">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Price ($) *</label>
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 rounded-l-lg bg-gray-100 dark:bg-gray-700 border border-r-0 border-gray-300 dark:border-gray-700">$</span>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                                class="flex-1 border border-gray-300 dark:border-gray-700 rounded-r-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:bg-gray-900 dark:text-gray-100"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Stock Quantity</label>
                        <input type="number" name="stock_quantity"
                            value="{{ old('stock_quantity', $product->stock_quantity) }}"
                            class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:bg-gray-900 dark:text-gray-100">
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Status</label>
                        <div class="flex items-center mt-2">
                            <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}
                                class="h-5 w-5 text-yellow-500 rounded focus:ring-2 focus:ring-yellow-400">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">Active Product</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Product Image</label>
                    @if($product->image)
                        <div class="mb-3">
                            <p class="text-gray-500 dark:text-gray-400 mb-2">Current Image:</p>
                            <img src="{{ asset('storage/products/' . $product->image) }}" class="rounded-lg"
                                style="max-height: 150px;">
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:bg-gray-900 dark:text-gray-100">
                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Leave empty to keep current image</p>
                </div>

                <div class="flex justify-between border-t border-gray-200 dark:border-gray-700 pt-4">
                    <x-button href="{{ route('products.index') }}" icon="bi bi-arrow-left" type="secondary">
                        Back
                    </x-button>

                    <div class="flex gap-2">
                        <x-button href="{{ route('products.show', $product->id) }}" icon="bi bi-eye" type="secondary">
                            View
                        </x-button>

                        <x-button type="warning" icon="bi bi-check-circle" :submit="true">
                            Update
                        </x-button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>