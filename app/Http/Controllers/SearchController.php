<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Blog;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $products = collect();
        $blogs = collect();

        if ($q) {
            $products = Product::with(['category', 'images'])
                ->where('is_active', true)
                ->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('description', 'like', "%{$q}%");
                })
                ->latest()
                ->paginate(6, ['*'], 'product_page')
                ->withQueryString();

            $blogs = Blog::with('category')
                ->where('is_active', true)
                ->where(function ($query) use ($q) {
                    $query->where('title', 'like', "%{$q}%")
                          ->orWhere('content', 'like', "%{$q}%");
                })
                ->latest()
                ->paginate(6, ['*'], 'blog_page')
                ->withQueryString();
        }

        return view('search', compact('q', 'products', 'blogs'));
    }
}
