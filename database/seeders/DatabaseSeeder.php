<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@jif.com'],
            [
                'name' => 'Admin RDR Interior Aluminium',
                'password' => bcrypt('admin123'),
                'is_admin' => true,
            ]
        );

        $this->call([
            SettingSeeder::class,
            SlideSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            BlogCategorySeeder::class,
            BlogSeeder::class,
        ]);
    }
}
