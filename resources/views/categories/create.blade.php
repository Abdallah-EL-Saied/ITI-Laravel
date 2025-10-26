@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
    <div class="max-w-2xl mx-auto py-10 px-4">

        <h1 class="text-2xl font-bold mb-6">Add Category</h1>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Name *</label>
                <input type="text" name="name" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" value="1" checked
                    class="h-5 w-5 text-green-500 rounded focus:ring-2 focus:ring-green-500">
                <label class="text-gray-700 font-medium">Active Category</label>
            </div>

            <div>
                <button type="submit"
                    class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 flex items-center gap-2">
                    <i class="bi bi-check-circle"></i> Save
                </button>
            </div>
        </form>

    </div>
@endsection
