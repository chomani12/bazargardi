<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ku' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        Category::create($data);
        return redirect('/admin/categories')->with('success', 'جۆر زیادکرا');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name_ku' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $category->update($data);
        return redirect('/admin/categories')->with('success', 'جۆر نوێکرایەوە');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/admin/categories')->with('success', 'جۆر سڕایەوە');
    }
}
