<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'images')->where('is_active', true)->latest()->paginate(12);
        return view('produk', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::with('category', 'images')->where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedProducts = Product::with('images', 'category')
            ->where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        if ($relatedProducts->count() < 4) {
            $excludeIds = $relatedProducts->pluck('id')->push($product->id);
            $fallback = Product::with('images', 'category')
                ->whereNotIn('id', $excludeIds)
                ->where('is_active', true)
                ->inRandomOrder()
                ->take(4 - $relatedProducts->count())
                ->get();
            $relatedProducts = $relatedProducts->concat($fallback);
        }
        return view('product-detail', compact('product', 'relatedProducts'));
    }
}
