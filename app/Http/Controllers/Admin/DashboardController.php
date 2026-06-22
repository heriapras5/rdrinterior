<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\PageView;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'visitors_total' => PageView::count(),
            'messages'       => ContactMessage::where('is_read', false)->count(),
            'total_products' => Product::where('is_active', true)->count(),
        ];

        $visitorRaw = PageView::selectRaw('DATE(visited_at) as date, COUNT(*) as total')
            ->where('visited_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $visitorChart = collect(range(6, 0))->mapWithKeys(fn($d) => [
            now()->subDays($d)->format('Y-m-d') => $visitorRaw->get(now()->subDays($d)->format('Y-m-d'), 0),
        ]);

        $topProductViews = PageView::selectRaw('page, COUNT(*) as total')
            ->where('page', 'like', '%/produk/%')
            ->groupBy('page')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $slugs = $topProductViews->pluck('page')->map(fn($p) => basename($p));
        $products = Product::with('images')->whereIn('slug', $slugs)->get()->keyBy('slug');

        $topProducts = [];
        foreach ($topProductViews as $pv) {
            $_slug = basename($pv->page);
            $_prod = $products->get($_slug);
            $topProducts[] = (object) [
                'name'  => $_prod ? $_prod->name : $_slug,
                'slug'  => $_slug,
                'image' => $_prod && $_prod->images->count()
                    ? (Str::startsWith($_prod->images[0]->image, 'http') ? $_prod->images[0]->image : asset('storage/' . $_prod->images[0]->image))
                    : null,
                'total' => $pv->total,
            ];
        }

        $recentMessages = ContactMessage::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'visitorChart', 'topProducts', 'recentMessages'));
    }
}
