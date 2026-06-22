<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tips & Trik', 'slug' => 'tips-trik', 'description' => 'Tips dan trik seputar interior aluminium untuk hunian Anda.', 'is_active' => true],
            ['name' => 'Inspirasi Desain', 'slug' => 'inspirasi-desain', 'description' => 'Inspirasi desain interior aluminium modern untuk berbagai ruangan.', 'is_active' => true],
            ['name' => 'Berita', 'slug' => 'berita', 'description' => 'Berita terbaru seputar produk dan layanan RDR Interior Aluminium.', 'is_active' => true],
        ];

        foreach ($categories as $cat) {
            BlogCategory::firstOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
