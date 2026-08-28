<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:255',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Thêm danh mục thành công!');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->back()->with('success', 'Xóa danh mục thành công!');
    }
}