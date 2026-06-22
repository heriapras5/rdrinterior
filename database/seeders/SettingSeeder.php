<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'RDR Interior Aluminium'],
            ['key' => 'site_description', 'value' => 'Solusi interior aluminium berkualitas untuk hunian dan komersial. Pintu, jendela, partisi, kitchen set, dan berbagai produk aluminium premium.'],
            ['key' => 'about_title', 'value' => 'Tentang RDR Interior Aluminium'],
            ['key' => 'about_description', 'value' => '<p>RDR Interior Aluminium adalah perusahaan yang bergerak di bidang penyediaan produk interior aluminium berkualitas tinggi. Berdiri sejak 2020, kami telah melayani ratusan pelanggan di seluruh Indonesia.</p><p>Kami berkomitmen untuk memberikan produk terbaik dengan harga yang kompetitif, didukung oleh tim profesional yang berpengalaman di bidangnya.</p>'],
            ['key' => 'about_vision', 'value' => '<p>Menjadi perusahaan penyedia produk interior aluminium terdepan di Indonesia yang dikenal akan kualitas, inovasi, dan pelayanan terbaik.</p>'],
            ['key' => 'about_mission', 'value' => '<ul><li>Menyediakan produk interior aluminium berkualitas tinggi dengan harga terjangkau</li><li>Memberikan pelayanan terbaik kepada setiap pelanggan</li><li>Terus berinovasi dalam desain dan teknologi produk</li><li>Berkontribusi dalam pengembangan industri interior aluminium di Indonesia</li></ul>'],
            ['key' => 'whatsapp_number', 'value' => '6281234567890'],
            ['key' => 'phone', 'value' => '(021) 1234-5678'],
            ['key' => 'email', 'value' => 'info@rdrinterior.com'],
            ['key' => 'address', 'value' => 'Jl. Contoh Aluminium No. 123, Jakarta Selatan, 12345'],
            ['key' => 'operational_hours', 'value' => "Senin - Jumat: 08:00 - 17:00\nSabtu: 08:00 - 14:00\nMinggu: Libur"],
            ['key' => 'instagram_url', 'value' => 'https://www.instagram.com/rdrinterioraluminium/'],
            ['key' => 'tiktok_url', 'value' => 'https://www.tiktok.com/@rdraluminiumkitchenset'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], ['value' => $s['value']]);
        }
    }
}
