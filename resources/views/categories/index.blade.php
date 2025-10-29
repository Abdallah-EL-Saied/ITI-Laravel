<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">All Categories</h3>
            <div class="flex gap-3">
                <x-button href="{{ route('categories.create') }}" icon="bi bi-plus-circle" type="primary">
                    Add New
                </x-button>
                <x-button href="{{ route('categories.trashed') }}" icon="bi bi-trash3" type="danger">
                    Trashed
                </x-button>
            </div>
        </div>
    </x-slot>

    <div class="sm:px-6 lg:px-8 mt-6">
        @if ($categories->count())
            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">#
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-semibold text-blue-600 dark:text-blue-400">{{ $category->name }}</td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $category->description ?: '-' }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 rounded-lg text-white text-sm {{ $category->is_active ? 'bg-green-500' : 'bg-red-500' }}">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex gap-2 flex-wrap">
                                    <x-button href="{{ route('categories.show', $category->id) }}" icon="bi bi-eye" type="info">
                                        View
                                    </x-button>
                                    <x-button href="{{ route('categories.edit', $category->id) }}" icon="bi bi-pencil"
                                        type="warning">
                                        Edit
                                    </x-button>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-button type="danger" icon="bi bi-trash" :submit="true">Delete</x-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $categories->links('pagination::tailwind') }}</div>
        @else
            <div class="text-center py-20 text-gray-500 dark:text-gray-400">
                <i class="bi bi-folder-x text-5xl"></i>
                <p class="mt-4">No categories found.</p>
            </div>
        @endif
    </div>
</x-app-layout>
