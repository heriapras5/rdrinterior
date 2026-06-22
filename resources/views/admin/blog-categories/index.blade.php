@extends('admin.layouts.app')

@section('title', 'Kategori Blog - Admin RDR Interior Aluminium')

@section('header', 'Kategori Blog')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-aluminium-800">Kategori Blog</h2>
        <a href="{{ route('admin.blog-categories.create') }}" class="btn-admin-primary">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
    </div>

    <form method="GET" action="{{ route('admin.blog-categories.index') }}" class="mb-6">
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-aluminium-400">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari kategori blog..."
                       class="w-full pl-10 pr-4 py-2.5 border border-aluminium-300 rounded-lg text-sm focus:ring-2 focus:ring-aluminium-500 focus:border-aluminium-500 outline-none transition-colors">
            </div>
            <select name="status" class="px-4 py-2.5 border border-aluminium-300 rounded-lg text-sm focus:ring-2 focus:ring-aluminium-500 focus:border-aluminium-500 outline-none transition-colors bg-white">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
            <button type="submit" class="btn-admin-primary">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
            @if(request()->anyFilled(['search', 'status']))
                <a href="{{ route('admin.blog-categories.index') }}" class="btn-admin-secondary">
                    <i class="fas fa-times mr-1"></i> Reset
                </a>
            @endif
        </div>
    </form>

    <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 overflow-hidden">
        @if ($categories->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-aluminium-100 bg-aluminium-50/50">
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">#</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider hidden sm:table-cell">Gambar</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">Nama</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider hidden md:table-cell">Deskripsi</th>
                            <th class="text-center px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider hidden sm:table-cell">Blog</th>
                            <th class="text-center px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">Status</th>
                            <th class="text-right px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-aluminium-50">
                        @foreach ($categories as $cat)
                            <tr class="hover:bg-aluminium-50/50 transition-colors">
                                <td class="px-5 py-4 text-aluminium-400 text-sm">{{ $categories->firstItem() + $loop->index }}</td>
                                <td class="px-5 py-4 hidden sm:table-cell">
                                    @if ($cat->image)
                                        @php $_bcImg = Str::startsWith($cat->image, 'http') ? $cat->image : asset('storage/' . $cat->image); @endphp
                                        <img src="{{ $_bcImg }}" alt="{{ $cat->name }}" class="w-12 h-12 rounded-lg object-cover cursor-pointer" @click="imgPopup = '{{ $_bcImg }}'">
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-aluminium-100 flex items-center justify-center text-aluminium-400 cursor-default">
                                            <i class="fas fa-image text-sm"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <p class="font-medium text-aluminium-800">{{ $cat->name }}</p>
                                </td>
                                <td class="px-5 py-4 text-aluminium-500 hidden md:table-cell">{{ Str::limit($cat->description, 50) ?? '-' }}</td>
                                <td class="px-5 py-4 text-center text-aluminium-500 hidden sm:table-cell">{{ $cat->blogs_count }}</td>
                                <td class="px-5 py-4 text-center">
                                    @if ($cat->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.blog-categories.edit', $cat) }}"
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-blue-500 hover:bg-blue-50 hover:text-blue-600 transition-colors"
                                           title="Edit">
                                            <i class="far fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.blog-categories.destroy', $cat) }}" method="POST"
                                              id="delete-form-{{ $cat->id }}">
                                            @csrf @method('DELETE')
                                            <button type="button" onclick="confirmDelete('delete-form-{{ $cat->id }}')"
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
                {{ $categories->links() }}
            </div>
        @else
            <div class="text-center py-12 text-aluminium-400">
                @if(request()->anyFilled(['search', 'status']))
                    <i class="fas fa-search text-3xl mb-3 block"></i>
                    <p class="text-sm">Data tidak ditemukan</p>
                    <p class="text-xs text-aluminium-400 mt-1">Pencarian tidak sesuai dengan data yang tersedia</p>
                    <a href="{{ route('admin.blog-categories.index') }}" class="text-aluminium-600 hover:text-aluminium-800 text-sm font-medium mt-3 inline-block">Reset filter</a>
                @else
                    <i class="fas fa-folder-open text-3xl mb-3 block"></i>
                    <p class="text-sm">Belum ada kategori blog</p>
                    <a href="{{ route('admin.blog-categories.create') }}" class="text-aluminium-600 hover:text-aluminium-800 text-sm font-medium mt-2 inline-block">Tambah kategori pertama</a>
                @endif
            </div>
        @endif
    </div>
@endsection
