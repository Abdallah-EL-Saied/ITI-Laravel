<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryApiController extends Controller
{

    use AuthorizesRequests;
    public function index()
    {
        return response()->json(Category::paginate(10));
    }

    public function store(CategoryStoreRequest $request)
    {
        $this->authorize('create', Category::class);

        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $data['image'] = basename($path);
        }

        $category = Category::create($data);
        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        $this->authorize('view', $category);
        return response()->json($category->load('products'));
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($category->image && Storage::exists('public/categories/' . $category->image)) {
                Storage::delete('public/categories/' . $category->image);
            }
            $path = $request->file('image')->store('categories', 'public');
            $data['image'] = basename($path);
        }

        $category->update($data);
        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }

    public function trashed()
    {
        $this->authorize('viewAny', Category::class);
        return response()->json(Category::onlyTrashed()->paginate(10));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $category);
        $category->restore();

        return response()->json($category);
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $category);

        if ($category->image && Storage::exists('public/categories/' . $category->image)) {
            Storage::delete('public/categories/' . $category->image);
        }

        $category->forceDelete();
        return response()->json(['message' => 'Category permanently deleted']);
    }
}
