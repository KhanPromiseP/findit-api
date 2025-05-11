<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;



class CategoryController extends Controller
{
    public function index()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::withCount('lostItemPosts')->orderBy('name')->get();
        return view('admin.categories.manage', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($request->only('name'));

        return back()->with('success', 'Category created successfully.');
    }

    public function destroy(Category $category)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        if ($category->lost_item_posts_count > 0) {
            return back()->with('error', 'Cannot delete category with associated posts.');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }
}