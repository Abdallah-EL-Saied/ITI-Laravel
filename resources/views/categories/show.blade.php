<x-app-layout>
    <x-slot name="header">
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $category->name }}</h3>
    </x-slot>

    <div class="sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('categories.index') }}"
                class="px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2">Back
                to Categories</a>
            <a href="{{ route('categories.edit', $category->id) }}"
                class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 flex items-center gap-2">Edit
                Category</a>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 mb-6">
            <p><strong>Name:</strong> {{ $category->name }}</p>
            <p><strong>Description:</strong> {{ $category->description ?: '-' }}</p>
            <p><strong>Status:</strong> <span
                    class="px-2 py-1 rounded-lg {{ $category->is_active ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">{{ $category->is_active ? 'Active' : 'Inactive' }}</span>
            </p>
            @if($category->image)
                <div class="mt-4">
                    <img src="{{ asset('storage/categories/' . $category->image) }}" class="h-48 rounded-lg"
                        alt="{{ $category->name }}">
                </div>
            @endif
        </div>

        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Products in this Category</h4>

        @if($category->products->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($category->products as $product)
                    <div class="bg-white dark:bg-gray-700 shadow rounded-lg overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/products/' . $product->image) }}" class="w-full h-48 object-cover"
                                alt="{{ $product->name }}">
                        @else
                            <div class="w-full h-48 bg-gray-100 dark:bg-gray-600 flex items-center justify-center text-gray-400">
                                <i class="bi bi-image text-4xl"></i>
                            </div>
                        @endif
                        <div class="p-4">
                            <h5 class="font-semibold text-gray-900 dark:text-gray-100">{{ $product->name }}</h5>
                            <p class="text-gray-700 dark:text-gray-300">${{ number_format($product->price, 2) }}</p>
                            <a href="{{ route('products.show', $product->id) }}"
                                class="mt-2 inline-block px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">View
                                Product</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400">No products found in this category.</p>
        @endif
    </div>
</x-app-layout>
