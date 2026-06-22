<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = [
            'site_name', 'site_description',
            'logo', 'favicon',
            'whatsapp_number', 'email', 'phone', 'address',
            'maps_embed',
            'facebook_url', 'instagram_url', 'tiktok_url',
            'operational_hours',
            'company_name',
            'footer_description',
            'about_title', 'about_description', 'about_vision', 'about_mission',
        ];

        $request->validate([
            'logo'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'favicon'      => 'nullable|image|mimes:jpeg,png,jpg,webp,ico|max:1024',
            'whatsapp_number' => 'nullable|string|max:20',
            'email'        => 'nullable|email|max:255',
            'phone'        => 'nullable|string|max:20',
        ]);

        foreach (['logo', 'favicon'] as $imgKey) {
            if ($request->input("remove_$imgKey") === '1' && !$request->hasFile($imgKey)) {
                $old = Setting::where('key', $imgKey)->value('value');
                if ($old) {
                    \Storage::disk('public')->delete($old);
                }
                Setting::updateOrCreate(['key' => $imgKey], ['value' => '']);
            }
        }

        foreach ($keys as $key) {
            if ($request->hasFile($key)) {
                $old = Setting::where('key', $key)->value('value');
                if ($old) {
                    \Storage::disk('public')->delete($old);
                }
                $path = $request->file($key)->store('uploads', 'public');
                Setting::updateOrCreate(['key' => $key], ['value' => $path]);
            } elseif ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}
