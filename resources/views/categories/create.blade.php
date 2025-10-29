<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Add Category</h3>
            <x-button href="{{ route('categories.index') }}" icon="bi bi-arrow-left" type="secondary">Back</x-button>
        </div>
    </x-slot>

    <div class="sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-6">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Name *</label>
                <input type="text" name="name" required
                    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 dark:bg-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-green-500"></textarea>
            </div>
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Image</label>
                <input type="file" name="image" accept="image/*"
                    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500">
            </div>
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" value="1" checked
                    class="h-5 w-5 text-green-500 rounded focus:ring-2 focus:ring-green-500">
                <label class="text-gray-700 dark:text-gray-300 font-medium">Active Category</label>
            </div>
            <div>
                <x-button type="success" icon="bi bi-check-circle" :submit="true">Save</x-button>
            </div>
        </form>
    </div>
</x-app-layout>
