<x-app-layout>
    <x-slot name="header">
        @session('error')
            {{ session('error') }}
        @endsession
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
                <x-button href="{{ route('products.create') }}" icon="bi bi-plus-circle" type="primary">
                    Add Product
                </x-button>

                <!-- Trashed Products Button -->
                <x-button href="{{ route('products.trashed') }}" icon="bi bi-trash3" type="secondary">
                    Trashed Products
                </x-button>
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
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900 dark:text-gray-100">
                                        EGP {{ number_format($product->price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap flex gap-2 flex-wrap">

                                        <!-- View Button -->
                                        <x-button
                                            href="{{ route('products.show', $product->id) }}"
                                            type="secondary"
                                            icon="bi bi-eye">
                                            View
                                        </x-button>

                                        <!-- Edit Button -->
                                        <x-button
                                            href="{{ route('products.edit', $product->id) }}"
                                            type="primary"
                                            icon="bi bi-pencil">
                                            Edit
                                        </x-button>

                                        <!-- Delete Button -->
                                        <form action="{{ route('products.destroy', $product->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this product?');"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-button type="danger" icon="bi bi-trash">Delete</x-button>
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
