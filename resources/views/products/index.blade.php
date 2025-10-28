<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">All Products</h3>

            <div class="flex flex-wrap gap-2">
                <!-- Search Form -->
                <form class="flex" method="GET" action="{{ route('products.index') }}">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="px-3 py-1 border border-gray-300 dark:border-gray-700 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:text-gray-100"
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
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if($products->count())
                <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($products as $index => $product)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($product->image)
                                            <img src="{{ asset('storage/products/' . $product->image) }}" class="h-16 w-16 object-cover rounded"
                                                alt="{{ $product->name }}">
                                        @else
                                            <div class="h-16 w-16 bg-gray-100 dark:bg-gray-700 flex items-center justify-center rounded text-gray-400">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-blue-600 dark:text-blue-400">{{ $product->name }}</td>
                                    <td class="px-6 py-4 text-gray-500 dark:text-gray-300 text-sm">{{ Str::limit($product->description, 60) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900 dark:text-gray-100">EGP {{ number_format($product->price, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex gap-2 flex-wrap">
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="px-3 py-1 bg-blue-100 text-blue-600 rounded hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800 flex items-center gap-1">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded hover:bg-yellow-200 dark:bg-yellow-900 dark:text-yellow-300 dark:hover:bg-yellow-800 flex items-center gap-1">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this product?');">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800 flex items-center gap-1">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-center flex-col">
                    {{ $products->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            @else
                <div class="text-center py-20 text-gray-500 dark:text-gray-400">
                    <i class="bi bi-box text-5xl"></i>
                    <p class="mt-4">No products available.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
