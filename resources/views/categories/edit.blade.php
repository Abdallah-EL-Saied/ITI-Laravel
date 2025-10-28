<x-app-layout>
    <x-slot name="header">
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Edit Category</h3>
    </x-slot>

    <div class="sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf @method('PUT')
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Name *</label>
                <input type="text" name="name" value="{{ $category->name }}" required
                    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 dark:bg-gray-900 dark:text-gray-100">
            </div>
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 dark:bg-gray-900 dark:text-gray-100">{{ $category->description }}</textarea>
            </div>
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Image</label>
                @if($category->image)
                    <img src="{{ asset('storage/categories/' . $category->image) }}" class="h-32 mb-2 rounded-lg">
                @endif
                <input type="file" name="image" accept="image/*"
                    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}
                    class="h-5 w-5 text-green-500 rounded focus:ring-2 focus:ring-green-500">
                <label class="text-gray-700 dark:text-gray-300 font-medium">Active Category</label>
            </div>
            <div>
                <button type="submit"
                    class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 flex items-center gap-2">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
