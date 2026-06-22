@extends('admin.layouts.app')

@section('title', 'Detail Pesan - Admin RDR Interior Aluminium')

@section('content')
    <div class="max-w-3xl">
        <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 text-sm text-aluminium-500 hover:text-aluminium-600 transition-colors mb-6">
            <i class="fas fa-arrow-left"></i> Kembali ke Pesan Masuk
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 p-6">
            <div class="flex items-start justify-between mb-6">
                <h2 class="text-lg font-semibold text-aluminium-800">Detail Pesan</h2>
                @if ($message->is_read)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                        <i class="fas fa-check-circle mr-1.5"></i> Sudah Dibaca
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                        <i class="fas fa-clock mr-1.5"></i> Belum Dibaca
                    </span>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                <div>
                    <p class="text-xs font-medium text-aluminium-400 uppercase tracking-wider mb-1">Nama</p>
                    <p class="text-sm font-medium text-aluminium-800">{{ $message->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-aluminium-400 uppercase tracking-wider mb-1">Email</p>
                    <p class="text-sm text-aluminium-800">{{ $message->email }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-aluminium-400 uppercase tracking-wider mb-1">Telepon</p>
                    <p class="text-sm text-aluminium-800">{{ $message->phone ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-aluminium-400 uppercase tracking-wider mb-1">Subjek</p>
                    <p class="text-sm text-aluminium-800">{{ $message->subject ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-xs font-medium text-aluminium-400 uppercase tracking-wider mb-1">Tanggal</p>
                    <p class="text-sm text-aluminium-800">{{ $message->created_at ? $message->created_at->format('d M Y H:i') : '-' }}</p>
                </div>
            </div>

            <div class="mb-6">
                <p class="text-xs font-medium text-aluminium-400 uppercase tracking-wider mb-2">Pesan</p>
                <div class="bg-aluminium-50 rounded-lg p-4 text-sm text-aluminium-700 leading-relaxed whitespace-pre-wrap">
                    {{ $message->message }}
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-aluminium-100">
                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" id="delete-message-{{ $message->id }}">
                    @csrf @method('DELETE')
                    <button type="button" onclick="confirmDelete('delete-message-{{ $message->id }}')"
                            class="btn-admin-danger">
                        <i class="far fa-trash-can"></i> Hapus Pesan
                    </button>
                </form>
                <a href="{{ route('admin.messages.index') }}" class="btn-admin-secondary">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
