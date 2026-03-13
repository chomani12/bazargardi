<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.products.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_ku' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description_ku' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');
        Product::create($data);
        return redirect('/admin/products')->with('success', 'بەرهەم زیادکرا');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_ku' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description_ku' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');
        $product->update($data);
        return redirect('/admin/products')->with('success', 'بەرهەم نوێکرایەوە');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/admin/products')->with('success', 'بەرهەم سڕایەوە');
    }
}
