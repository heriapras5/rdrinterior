@extends('admin.layouts.app')

@section('title', 'Pesan Masuk - Admin RDR Interior Aluminium')

@section('header', 'Pesan Masuk')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-aluminium-800">Pesan Masuk</h2>
            <p class="text-sm text-aluminium-500 mt-0.5">Kelola pesan dari pengunjung website</p>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.messages.index') }}" class="mb-6">
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-aluminium-400">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari pesan..."
                       class="w-full pl-10 pr-4 py-2.5 border border-aluminium-300 rounded-lg text-sm focus:ring-2 focus:ring-aluminium-500 focus:border-aluminium-500 outline-none transition-colors">
            </div>
            <select name="status" class="px-4 py-2.5 border border-aluminium-300 rounded-lg text-sm focus:ring-2 focus:ring-aluminium-500 focus:border-aluminium-500 outline-none transition-colors bg-white">
                <option value="">Semua Status</option>
                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
            </select>
            <button type="submit" class="btn-admin-primary">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
            @if(request()->anyFilled(['search', 'status']))
                <a href="{{ route('admin.messages.index') }}" class="btn-admin-secondary">
                    <i class="fas fa-times mr-1"></i> Reset
                </a>
            @endif
        </div>
    </form>

    <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 overflow-hidden">
        @if ($messages->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-aluminium-100 bg-aluminium-50/50">
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">#</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">Nama</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider hidden sm:table-cell">Email</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider hidden md:table-cell">Subjek</th>
                            <th class="text-center px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">Status</th>
                            <th class="text-left px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider hidden sm:table-cell">Tanggal</th>
                            <th class="text-right px-5 py-3.5 font-medium text-aluminium-500 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-aluminium-50">
                        @foreach ($messages as $message)
                            <tr class="hover:bg-aluminium-50/50 transition-colors {{ !$message->is_read ? 'bg-aluminium-50/40' : '' }}">
                                <td class="px-5 py-4 text-aluminium-400">{{ $loop->iteration + ($messages->currentPage() - 1) * $messages->perPage() }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        @if(!$message->is_read)
                                            <span class="w-2 h-2 rounded-full bg-aluminium-500 shrink-0"></span>
                                        @endif
                                        <span class="font-medium text-aluminium-800">{{ $message->name }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-aluminium-500 hidden sm:table-cell">{{ $message->email }}</td>
                                <td class="px-5 py-4 text-aluminium-600 hidden md:table-cell">{{ Str::limit($message->subject, 40) ?? '-' }}</td>
                                <td class="px-5 py-4 text-center">
                                    @if ($message->is_read)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Sudah Dibaca</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">Belum Dibaca</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-aluminium-400 text-xs hidden sm:table-cell">{{ $message->created_at ? $message->created_at->format('d M Y H:i') : '-' }}</td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.messages.show', $message) }}"
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-blue-500 hover:bg-blue-50 hover:text-blue-600 transition-colors"
                                           title="Lihat">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                                              id="delete-form-{{ $message->id }}">
                                            @csrf @method('DELETE')
                                            <button type="button" onclick="confirmDelete('delete-form-{{ $message->id }}')"
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
                {{ $messages->links() }}
            </div>
        @else
            <div class="text-center py-12 text-aluminium-400">
                @if(request()->anyFilled(['search', 'status']))
                    <i class="fas fa-search text-3xl mb-3 block"></i>
                    <p class="text-sm">Data tidak ditemukan</p>
                    <p class="text-xs text-aluminium-400 mt-1">Pencarian tidak sesuai dengan data yang tersedia</p>
                    <a href="{{ route('admin.messages.index') }}" class="text-aluminium-600 hover:text-aluminium-800 text-sm font-medium mt-3 inline-block">Reset filter</a>
                @else
                    <i class="fas fa-inbox text-3xl mb-3 block"></i>
                    <p class="text-sm">Belum ada pesan masuk</p>
                @endif
            </div>
        @endif
    </div>
@endsection
