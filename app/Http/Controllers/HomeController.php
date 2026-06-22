<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Slide;

class HomeController extends Controller
{
    public function index()
    {
        $highlights = Product::with('category', 'images')
            ->where('is_active', true)
            ->where('is_highlight', true)
            ->latest()
            ->take(8)
            ->get();

        $slides = Slide::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn($s) => [
                'image' => $s->image_url,
                'title' => $s->title,
                'subtitle' => $s->subtitle,
                'button_url' => $s->button_url ?: '/produk',
                'button_text' => $s->button_text ?: 'Lihat Koleksi',
            ])
            ->toArray();

        if (empty($slides)) {
            $slides = [
                ['image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=1600&q=80', 'title' => 'Interior Aluminium Premium', 'subtitle' => 'Solusi interior aluminium berkualitas tinggi untuk hunian dan komersial Anda. Pintu, jendela, partisi, dan kitchen set aluminium modern.', 'button_url' => '/produk', 'button_text' => 'Lihat Koleksi'],
                ['image' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=1600&q=80', 'title' => 'Desain Modern & Elegan', 'subtitle' => 'Temukan berbagai pilihan desain interior aluminium terbaru dengan kualitas terbaik dan harga kompetitif.', 'button_url' => '/produk', 'button_text' => 'Lihat Koleksi'],
                ['image' => 'https://images.unsplash.com/photo-1578301978693-85fa9c0320b9?w=1600&q=80', 'title' => 'Kualitas Terjamin', 'subtitle' => 'Bahan aluminium berkualitas tinggi, dikerjakan oleh tenaga ahli berpengalaman, dengan garansi kepuasan.', 'button_url' => '/produk', 'button_text' => 'Lihat Koleksi'],
            ];
        }

        return view('home', compact('slides', 'highlights'));
    }
}
