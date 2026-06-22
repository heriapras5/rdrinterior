<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductCategory::withCount('products');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('is_active', $status === 'active');
        }

        $categories = $query->latest()->paginate(10)->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active'   => 'boolean',
        ]);

        $data['slug']      = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        ProductCategory::create($data);

        return redirect()->route('admin.product-categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('admin.categories.form', ['category' => $productCategory]);
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active'   => 'boolean',
        ]);

        $data['slug']      = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($productCategory->image) {
                \Storage::disk('public')->delete($productCategory->image);
            }
            $data['image'] = $request->file('image')->store('uploads', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($productCategory->image) {
                \Storage::disk('public')->delete($productCategory->image);
            }
            $data['image'] = null;
        }

        $productCategory->update($data);

        return redirect()->route('admin.product-categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory->image) {
            \Storage::disk('public')->delete($productCategory->image);
        }
        $productCategory->delete();
        return redirect()->route('admin.product-categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
