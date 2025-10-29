<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Trashed Categories</h3>
            <x-button href="{{ route('categories.index') }}" icon="bi bi-arrow-left" type="secondary">Back</x-button>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($categories->count())
                <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                    #</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                    Deleted At</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $index => $category)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-semibold text-blue-600 dark:text-blue-400">{{ $category->name }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 dark:text-gray-300">
                                        {{ $category->deleted_at->diffForHumans() }}</td>
                                    <td class="px-6 py-4 flex gap-2 flex-wrap">
                                        <form action="{{ route('categories.restore', $category->id) }}" method="POST">
                                            @csrf
                                            <x-button type="success" icon="bi bi-arrow-counterclockwise"
                                                :submit="true">Restore</x-button>
                                        </form>

                                        <form action="{{ route('categories.forceDelete', $category->id) }}" method="POST"
                                            onsubmit="return confirm('Delete permanently?');">
                                            @csrf
                                            @method('DELETE')
                                            <x-button type="danger" icon="bi bi-trash3" :submit="true">Delete
                                                Permanently</x-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">{{ $categories->links('pagination::tailwind') }}</div>
            @else
                <div class="text-center py-20 text-gray-500 dark:text-gray-400">
                    <i class="bi bi-trash text-5xl"></i>
                    <p class="mt-4">No trashed categories found.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
