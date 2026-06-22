<?php

namespace App\Providers;

use App\Models\ProductCategory;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.tailwind');

        $settings = [];

        $db = config('database.connections.mysql');
        $sock = @fsockopen($db['host'], $db['port'], $errno, $errstr, 2);
        if ($sock) {
            fclose($sock);
            try {
                $settings = Setting::pluck('value', 'key')->toArray();
            } catch (\Exception $e) {
                $settings = [];
            }
        }

        view()->share('_globalSettings', $settings);
        view()->share('_globalLogo', !empty($settings['logo']) ? (Str::startsWith($settings['logo'], 'http') ? $settings['logo'] : asset('storage/'.$settings['logo'])) : null);
        view()->share('_globalFavicon', !empty($settings['favicon']) ? (Str::startsWith($settings['favicon'], 'http') ? $settings['favicon'] : asset('storage/'.$settings['favicon'])) : null);
        view()->share('_globalSiteName', $settings['site_name'] ?? 'RDR Interior Aluminium');

        try {
            $_navCats = ProductCategory::where('is_active', true)->get(['name', 'slug']);
            view()->share('_globalNavCategories', $_navCats);
        } catch (\Exception $e) {
            view()->share('_globalNavCategories', collect());
        }
    }
}
