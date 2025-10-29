<x-app-layout>
    <x-slot name="header">
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $product->name }}</h3>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <x-button href="{{ route('products.index') }}" icon="bi bi-arrow-left" type="secondary">
                Back to Products
            </x-button>

            <div class="mt-4 bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden md:flex md:gap-0">
                <!-- Image Section -->
                <div class="md:w-5/12">
                    @if($product->image)
                        <img src="{{ asset('storage/products/' . $product->image) }}"
                            class="w-full h-full object-cover rounded-l-xl min-h-[500px]" alt="{{ $product->name }}">
                    @else
                        <div
                            class="w-full h-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center min-h-[500px] text-gray-400">
                            <i class="bi bi-image text-6xl"></i>
                            <p class="mt-3">No Image Available</p>
                        </div>
                    @endif
                </div>

                <!-- Details Section -->
                <div class="md:w-7/12 p-6 md:p-10 flex flex-col">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $product->name }}</h1>
                            <span
                                class="inline-block bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm px-3 py-1 rounded-lg mt-1">
                                {{ optional($product->category)->name ?? 'N/A' }}
                            </span>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-2">
                                ${{ number_format($product->price, 2) }}
                            </div>
                            <div class="flex gap-2 justify-end flex-wrap">
                                <span
                                    class="px-2 py-1 text-sm rounded-lg {{ $product->is_active ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                <span
                                    class="px-2 py-1 text-sm rounded-lg {{ $product->stock_quantity > 0 ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                    Stock: {{ $product->stock_quantity }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h5 class="font-semibold mb-2 text-gray-900 dark:text-gray-100">Description</h5>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            {{ $product->description ?: 'No description provided.' }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg text-center">
                            <i class="bi bi-tag text-blue-600 dark:text-blue-400 text-4xl mb-2 inline-block"></i>
                            <h6 class="font-bold mb-1">Category</h6>
                            <p>{{ optional($product->category)->name ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg text-center">
                            <i class="bi bi-box-seam text-green-600 dark:text-green-400 text-4xl mb-2 inline-block"></i>
                            <h6 class="font-bold mb-1">Stock Level</h6>
                            <p
                                class="font-bold {{ $product->stock_quantity > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $product->stock_quantity }} units
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-gray-200 dark:border-gray-700 flex-wrap">
                        <x-button href="{{ route('products.edit', $product->id) }}" icon="bi bi-pencil" type="warning">
                            Edit
                        </x-button>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Delete this product?');">
                            @csrf
                            @method('DELETE')
                            <x-button type="danger" icon="bi bi-trash" :submit="true">
                                Delete
                            </x-button>
                        </form>
                    </div>

                    <div
                        class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm flex justify-between flex-wrap">
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
</x-app-layout>
