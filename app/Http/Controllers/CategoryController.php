<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $categories = $query->latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorize('create', Category::class);
        return view('categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $this->authorize('create', Category::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = basename($path);
        }
        $validated['user_id'] = auth()->id();
        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        $this->authorize('view', $category);
        $category->load('products');
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($category->image && Storage::exists('public/categories/' . $category->image)) {
                Storage::delete('public/categories/' . $category->image);
            }
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = basename($path);
        }

        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    public function trashed()
    {
        $this->authorize('viewAny', Category::class);
        $categories = Category::onlyTrashed()->latest()->paginate(10);
        return view('categories.trashed', compact('categories'));
    }


    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $category);

        $category->restore();
        return redirect()->route('categories.trashed')->with('success', 'Category restored successfully.');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $category);

        if ($category->image && Storage::exists('public/categories/' . $category->image)) {
            Storage::delete('public/categories/' . $category->image);
        }

        $category->forceDelete();
        return redirect()->route('categories.trashed')->with('success', 'Category permanently deleted.');
    }
}
