<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogCategory::withCount('blogs');

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

        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog-categories.form');
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

        BlogCategory::create($data);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Kategori blog berhasil ditambahkan.');
    }

    public function edit(BlogCategory $blogCategory)
    {
        return view('admin.blog-categories.form', ['category' => $blogCategory]);
    }

    public function update(Request $request, BlogCategory $blogCategory)
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
            if ($blogCategory->image) {
                \Storage::disk('public')->delete($blogCategory->image);
            }
            $data['image'] = $request->file('image')->store('uploads', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($blogCategory->image) {
                \Storage::disk('public')->delete($blogCategory->image);
            }
            $data['image'] = null;
        }

        $blogCategory->update($data);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Kategori blog berhasil diperbarui.');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        if ($blogCategory->image) {
            \Storage::disk('public')->delete($blogCategory->image);
        }
        $blogCategory->delete();
        return redirect()->route('admin.blog-categories.index')->with('success', 'Kategori blog berhasil dihapus.');
    }
}
