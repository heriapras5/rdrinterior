@extends('admin.layouts.app')

@section('title', 'Blog - Admin RDR Interior Aluminium')

@section('header', 'Blog')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-aluminium-800">Blog</h2>
        <a href="{{ route('admin.blogs.create') }}" class="btn-admin-primary">
            <i class="fas fa-plus"></i> Tambah Blog
        </a>
    </div>

    <form method="GET" action="{{ route('admin.blogs.index') }}" class="mb-6">
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-aluminium-400">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari blog..."
                       class="w-full pl-10 pr-4 py-2.5 border border-aluminium-300 rounded-lg text-sm focus:ring-2 focus:ring-aluminium-500 focus:border-aluminium-500 outline-none transition-colors">
            </div>
            <select name="category" class="px-4 py-2.5 border border-aluminium-300 rounded-lg text-sm focus:ring-2 focus:ring-aluminium-500 focus:border-aluminium-500 outline-none transition-colors bg-white">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select name="status" class="px-4 py-2.5 border border-aluminium-300 rounded-lg text-sm focus:ring-2 focus:ring-aluminium-500 focus:border-aluminium-500 outline-none transition-colors bg-white">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
            <button type="submit" class="btn-admin-primary">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
            @if(request()->anyFilled(['search', 'category', 'status']))
                <a href="{{ route('admin.blogs.index') }}" class="btn-admin-secondary">
                    <i class="fas fa-times mr-1"></i> Reset
                </a>
            @endif
        </div>
    </form>

    <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 overflow-hidden">
        @if ($blogs->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-aluminium-100 bg-aluminium-50/50">
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">#</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">Thumbnail</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">Judul</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider hidden lg:table-cell">Kategori</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider hidden xl:table-cell">Penulis</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider hidden md:table-cell">Tanggal</th>
                            <th class="text-center px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider hidden sm:table-cell">Status</th>
                            <th class="text-right px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-aluminium-50">
                        @foreach ($blogs as $blog)
                            <tr class="hover:bg-aluminium-50/50 transition-colors">
                                <td class="px-5 py-4 text-aluminium-400 text-sm">{{ $blogs->firstItem() + $loop->index }}</td>
                                <td class="px-5 py-4">
                                    @if ($blog->thumbnail)
                                        @php $_bImg = Str::startsWith($blog->thumbnail, 'http') ? $blog->thumbnail : asset('storage/' . $blog->thumbnail); @endphp
                                        <img src="{{ $_bImg }}" alt="{{ $blog->title }}" class="w-14 h-14 rounded-lg object-cover cursor-pointer" @click="imgPopup = '{{ $_bImg }}'">
                                    @else
                                        <div class="w-14 h-14 rounded-lg bg-aluminium-100 flex items-center justify-center text-aluminium-400 cursor-default">
                                            <i class="fas fa-newspaper text-lg"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <p class="font-medium text-aluminium-800">{{ $blog->title }}</p>
                                </td>
                                <td class="px-5 py-4 text-aluminium-500 hidden lg:table-cell">{{ $blog->category?->name ?? '-' }}</td>
                                <td class="px-5 py-4 text-aluminium-400 hidden xl:table-cell">{{ $blog->author ?? 'RDR Interior Aluminium' }}</td>
                                <td class="px-5 py-4 text-aluminium-400 text-xs hidden md:table-cell">{{ $blog->created_at?->format('d M Y') ?? '-' }}</td>
                                <td class="px-5 py-4 text-center hidden sm:table-cell">
                                    @if ($blog->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.blogs.edit', $blog) }}"
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-blue-500 hover:bg-blue-50 hover:text-blue-600 transition-colors"
                                           title="Edit">
                                            <i class="far fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST"
                                              id="delete-form-{{ $blog->id }}">
                                            @csrf @method('DELETE')
                                            <button type="button" onclick="confirmDelete('delete-form-{{ $blog->id }}')"
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
                {{ $blogs->links() }}
            </div>
        @else
            <div class="text-center py-12 text-aluminium-400">
                @if(request()->anyFilled(['search', 'category', 'status']))
                    <i class="fas fa-search text-3xl mb-3 block"></i>
                    <p class="text-sm">Data tidak ditemukan</p>
                    <p class="text-xs text-aluminium-400 mt-1">Pencarian tidak sesuai dengan data yang tersedia</p>
                    <a href="{{ route('admin.blogs.index') }}" class="text-aluminium-600 hover:text-aluminium-800 text-sm font-medium mt-3 inline-block">Reset filter</a>
                @else
                    <i class="fas fa-newspaper text-3xl mb-3 block"></i>
                    <p class="text-sm">Belum ada artikel blog</p>
                    <a href="{{ route('admin.blogs.create') }}" class="text-aluminium-600 hover:text-aluminium-800 text-sm font-medium mt-2 inline-block">Tambah blog pertama</a>
                @endif
            </div>
        @endif
    </div>
@endsection
