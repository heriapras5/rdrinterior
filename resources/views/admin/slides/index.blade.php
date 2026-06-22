@extends('admin.layouts.app')

@section('title', 'Slider - Admin RDR Interior Aluminium')

@section('header', 'Slider')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-aluminium-800">Slider</h2>
        <a href="{{ route('admin.slides.create') }}" class="btn-admin-primary">
            <i class="fas fa-plus"></i> Tambah Slide
        </a>
    </div>

    <form method="GET" action="{{ route('admin.slides.index') }}" class="mb-6">
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-aluminium-400">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari slide..."
                       class="w-full pl-10 pr-4 py-2.5 border border-aluminium-300 rounded-lg text-sm focus:ring-2 focus:ring-aluminium-500 focus:border-aluminium-500 outline-none transition-colors">
            </div>
            <button type="submit" class="btn-admin-primary">
                <i class="fas fa-search mr-1"></i> Cari
            </button>
            @if(request()->filled('search'))
                <a href="{{ route('admin.slides.index') }}" class="btn-admin-secondary">
                    <i class="fas fa-times mr-1"></i> Reset
                </a>
            @endif
        </div>
    </form>

    <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 overflow-hidden">
        @if ($slides->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-aluminium-100 bg-aluminium-50/50">
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">#</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">Gambar</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">Judul</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider hidden md:table-cell">Subtitle</th>
                            <th class="text-center px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider hidden sm:table-cell">Urutan</th>
                            <th class="text-center px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">Status</th>
                            <th class="text-right px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-aluminium-50">
                        @foreach ($slides as $slide)
                            <tr class="hover:bg-aluminium-50/50 transition-colors">
                                <td class="px-5 py-4 text-aluminium-400 text-sm">{{ $slides->firstItem() + $loop->index }}</td>
                                <td class="px-5 py-4">
                                    <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}" class="w-20 h-12 rounded-lg object-cover cursor-pointer" @click="imgPopup = '{{ $slide->image_url }}'">
                                </td>
                                <td class="px-5 py-4">
                                    <p class="font-medium text-aluminium-800">{{ $slide->title }}</p>
                                </td>
                                <td class="px-5 py-4 text-aluminium-500 hidden md:table-cell">{{ Str::limit($slide->subtitle, 60) ?? '-' }}</td>
                                <td class="px-5 py-4 text-center text-aluminium-500 hidden sm:table-cell">{{ $slide->sort_order }}</td>
                                <td class="px-5 py-4 text-center">
                                    @if ($slide->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.slides.edit', $slide) }}"
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-blue-500 hover:bg-blue-50 hover:text-blue-600 transition-colors"
                                           title="Edit">
                                            <i class="far fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST"
                                              id="delete-form-{{ $slide->id }}">
                                            @csrf @method('DELETE')
                                            <button type="button" onclick="confirmDelete('delete-form-{{ $slide->id }}')"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-500 hover:bg-red-50 hover:text-red-600 transition-colors"
                                                    title="Hapus">
                                                <i class="far fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-5 py-4 border-t border-aluminium-100">
                {{ $slides->links() }}
            </div>
        @else
            <div class="text-center py-12 text-aluminium-400">
                @if(request()->filled('search'))
                    <i class="fas fa-search text-3xl mb-3 block"></i>
                    <p class="text-sm">Data tidak ditemukan</p>
                    <p class="text-xs text-aluminium-400 mt-1">Pencarian tidak sesuai dengan data yang tersedia</p>
                    <a href="{{ route('admin.slides.index') }}" class="text-aluminium-600 hover:text-aluminium-800 text-sm font-medium mt-3 inline-block">Reset filter</a>
                @else
                    <i class="fas fa-images text-3xl mb-3 block"></i>
                    <p class="text-sm">Belum ada slide</p>
                    <a href="{{ route('admin.slides.create') }}" class="text-aluminium-600 hover:text-aluminium-800 text-sm font-medium mt-2 inline-block">Tambah slide pertama</a>
                @endif
            </div>
        @endif
    </div>
@endsection
