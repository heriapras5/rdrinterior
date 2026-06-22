<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Interior Aluminium Premium',
                'subtitle' => 'Wujudkan hunian impian Anda dengan produk interior aluminium berkualitas tinggi. Tahan lama, elegan, dan modern.',
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=1600&q=80',
                'button_text' => 'Lihat Produk',
                'button_url' => '/produk',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Pintu & Jendela Aluminium',
                'subtitle' => 'Koleksi lengkap pintu dan jendela aluminium dengan berbagai model dan finishing. Cocok untuk segala kebutuhan.',
                'image' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=1600&q=80',
                'button_text' => 'Lihat Katalog',
                'button_url' => '/kategori',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Konsultasi Gratis',
                'subtitle' => 'Tim ahli kami siap membantu Anda memilih produk yang tepat untuk hunian atau proyek Anda.',
                'image' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1600&q=80',
                'button_text' => 'Hubungi Kami',
                'button_url' => '/kontak',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            Slide::firstOrCreate(['sort_order' => $slide['sort_order']], $slide);
        }
    }
}
