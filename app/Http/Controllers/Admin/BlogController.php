<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with('category');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        if ($categoryId = $request->get('category')) {
            $query->where('blog_category_id', $categoryId);
        }

        if ($status = $request->get('status')) {
            $query->where('is_active', $status === 'active');
        }

        $blogs = $query->latest()->paginate(10)->withQueryString();
        $categories = BlogCategory::where('is_active', true)->get();

        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        $categories = BlogCategory::where('is_active', true)->get();
        return view('admin.blogs.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title'            => 'required|string|max:255',
            'thumbnail'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'content'          => 'nullable|string',
            'excerpt'          => 'nullable|string|max:500',
            'author'           => 'nullable|string|max:255',
            'is_active'        => 'boolean',
        ]);

        $data['slug']      = Str::slug($data['title']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('uploads', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog berhasil ditambahkan.');
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::where('is_active', true)->get();
        return view('admin.blogs.form', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title'            => 'required|string|max:255',
            'thumbnail'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'content'          => 'nullable|string',
            'excerpt'          => 'nullable|string|max:500',
            'author'           => 'nullable|string|max:255',
            'is_active'        => 'boolean',
        ]);

        $data['slug']      = Str::slug($data['title']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            if ($blog->thumbnail) {
                \Storage::disk('public')->delete($blog->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('uploads', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($blog->thumbnail) {
                \Storage::disk('public')->delete($blog->thumbnail);
            }
            $data['thumbnail'] = null;
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog berhasil diperbarui.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->thumbnail) {
            \Storage::disk('public')->delete($blog->thumbnail);
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog berhasil dihapus.');
    }
}
