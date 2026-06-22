<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AboutSettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.about-settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = ['about_image', 'about_title', 'about_description', 'about_vision', 'about_mission'];

        $request->validate([
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

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

        return redirect()->route('admin.about-settings.edit')->with('success', 'Pengaturan halaman Tentang berhasil disimpan.');
    }
}
