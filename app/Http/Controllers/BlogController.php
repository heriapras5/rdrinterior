<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('blogs')->where('is_active', true)->get();
        $categoryFilter = request('category');
        $blogs = Blog::with('category')->where('is_active', true);
        if ($categoryFilter) {
            $blogs->whereHas('category', function ($q) use ($categoryFilter) {
                $q->where('slug', $categoryFilter);
            });
        }
        $blogs = $blogs->latest()->paginate(6)->withQueryString();
        $recentBlogs = Blog::with('category')->where('is_active', true)->latest()->take(5)->get();
        return view('blog-list', compact('blogs', 'recentBlogs', 'categories'));
    }

    public function show($slug)
    {
        $blog = Blog::with('category')->where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedBlogs = Blog::with('category')->where('blog_category_id', $blog->blog_category_id)
            ->where('id', '!=', $blog->id)
            ->where('is_active', true)
            ->latest()
            ->take(3)
            ->get();
        return view('blog-detail', compact('blog', 'relatedBlogs'));
    }
}
