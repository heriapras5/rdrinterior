<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = BlogCategory::pluck('id', 'slug');

        $blogs = [
            [
                'blog_category_id' => $categories['tips-trik'],
                'title' => '5 Tips Memilih Pintu Aluminium untuk Rumah Anda',
                'slug' => 'tips-memilih-pintu-aluminium',
                'content' => '<p>Memilih pintu aluminium yang tepat untuk rumah Anda membutuhkan pertimbangan yang matang. Berikut adalah 5 tips yang dapat membantu Anda:</p><h3>1. Perhatikan Ketebalan Material</h3><p>Pilih pintu aluminium dengan ketebalan minimal 1.2mm untuk memastikan kekuatan dan ketahanan yang optimal.</p><h3>2. Sesuaikan dengan Desain Rumah</h3><p>Pilih model dan warna yang sesuai dengan konsep desain rumah Anda. Aluminium tersedia dalam berbagai pilihan finishing.</p><h3>3. Cek Sistem Penguncian</h3><p>Pastikan pintu dilengkapi dengan sistem penguncian yang aman dan berkualitas.</p><h3>4. Pertimbangkan Ukuran</h3><p>Ukur dengan teliti area pemasangan pintu. Pintu aluminium dapat dibuat custom sesuai ukuran yang dibutuhkan.</p><h3>5. Pilih Finishing yang Tepat</h3><p>Sesuaikan finishing dengan lokasi pemasangan. Untuk outdoor, pilih finishing powder coating yang tahan cuaca.</p>',
                'excerpt' => 'Panduan lengkap memilih pintu aluminium yang tepat untuk hunian Anda, dari ketebalan material hingga finishing.',
                'author' => 'Admin RDR',
                'is_active' => true,
            ],
            [
                'blog_category_id' => $categories['inspirasi-desain'],
                'title' => 'Inspirasi Desain Dapur Minimalis dengan Kitchen Set Aluminium',
                'slug' => 'inspirasi-dapur-minimalis-kitchen-set-aluminium',
                'content' => '<p>Dapur minimalis modern semakin populer di kalangan masyarakat perkotaan. Salah satu elemen kunci adalah pemilihan kitchen set yang tepat. Kitchen set aluminium hadir sebagai solusi yang menggabungkan estetika dan fungsionalitas.</p><h3>Keunggulan Kitchen Set Aluminium</h3><ul><li>Tahan air dan lembab</li><li>Anti rayap dan jamur</li><li>Mudah dibersihkan</li><li>Ringan namun kuat</li><li>Tersedia banyak pilihan warna</li></ul><p>Dengan kitchen set aluminium, dapur minimalis impian Anda bukan lagi sekadar khayalan.</p>',
                'excerpt' => 'Temukan inspirasi desain dapur minimalis modern dengan kitchen set aluminium yang tahan lama dan elegan.',
                'author' => 'Admin RDR',
                'is_active' => true,
            ],
            [
                'blog_category_id' => $categories['berita'],
                'title' => 'RDR Interior Aluminium Luncurkan Koleksi Produk Terbaru 2026',
                'slug' => 'koleksi-produk-terbaru-2026',
                'content' => '<p>RDR Interior Aluminium dengan bangga mengumumkan peluncuran koleksi produk terbaru untuk tahun 2026. Koleksi ini menghadirkan inovasi terbaru dalam desain dan teknologi produk interior aluminium.</p><p>Beberapa produk unggulan dalam koleksi terbaru ini antara lain:</p><ul><li>Pintu lipat aluminium dengan sistem silent sliding</li><li>Jendela casement dengan double seal untuk kedap suara</li><li>Partisi ruangan dengan desain minimalis terbaru</li><li>Kitchen set aluminium dengan finishing tekstur kayu</li></ul><p>Untuk informasi lebih lanjut tentang produk terbaru, silakan kunjungi halaman produk kami atau hubungi tim kami.</p>',
                'excerpt' => 'RDR Interior Aluminium meluncurkan koleksi produk terbaru dengan inovasi desain dan teknologi terkini.',
                'author' => 'Admin RDR',
                'is_active' => true,
            ],
        ];

        foreach ($blogs as $data) {
            Blog::firstOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
