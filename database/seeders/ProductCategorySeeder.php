<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Pintu Aluminium', 'slug' => 'pintu-aluminium', 'description' => 'Pintu aluminium modern untuk hunian dan komersial dengan berbagai model dan finishing.', 'is_active' => true],
            ['name' => 'Jendela Aluminium', 'slug' => 'jendela-aluminium', 'description' => 'Jendela aluminium berkualitas tinggi dengan sistem bukaan sliding, casement, dan lainnya.', 'is_active' => true],
            ['name' => 'Partisi Ruangan', 'slug' => 'partisi-ruangan', 'description' => 'Partisi aluminium untuk pembatas ruangan yang elegan dan fungsional.', 'is_active' => true],
            ['name' => 'Kitchen Set', 'slug' => 'kitchen-set', 'description' => 'Kitchen set aluminium dengan desain minimalis modern tahan lama dan anti karat.', 'is_active' => true],
            ['name' => 'Cermin & Aksesoris', 'slug' => 'cermin-aksesoris', 'description' => 'Cermin frameless aluminium dan aksesoris interior berkualitas tinggi.', 'is_active' => true],
            ['name' => 'Kabinet & Lemari', 'slug' => 'kabinet-lemari', 'description' => 'Kabinet dan lemari aluminium serbaguna dengan desain modern dan tahan lama.', 'is_active' => true],
        ];

        foreach ($categories as $cat) {
            ProductCategory::firstOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
