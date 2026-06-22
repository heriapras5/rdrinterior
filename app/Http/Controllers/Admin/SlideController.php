<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function index(Request $request)
    {
        $query = Slide::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        $slides = $query->orderBy('sort_order')->paginate(10);

        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|max:255',
            'subtitle'    => 'nullable|max:500',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'button_text' => 'nullable|max:100',
            'button_url'  => 'nullable|max:255',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');
        $data['image'] = $request->file('image')->store('uploads', 'public');

        Slide::create($data);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide berhasil ditambahkan.');
    }

    public function edit(Slide $slide)
    {
        return view('admin.slides.form', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $data = $request->validate([
            'title'       => 'required|max:255',
            'subtitle'    => 'nullable|max:500',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'button_text' => 'nullable|max:100',
            'button_url'  => 'nullable|max:255',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            \Storage::disk('public')->delete($slide->image);
            $data['image'] = $request->file('image')->store('uploads', 'public');
        } else {
            unset($data['image']);
        }

        $slide->update($data);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy(Slide $slide)
    {
        \Storage::disk('public')->delete($slide->image);
        $slide->delete();

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide berhasil dihapus.');
    }
}
