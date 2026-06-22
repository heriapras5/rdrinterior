@extends('admin.layouts.app')

@section('title', isset($slide) ? 'Edit Slide - Admin RDR Interior Aluminium' : 'Tambah Slide - Admin RDR Interior Aluminium')

@section('header', isset($slide) ? 'Edit Slide' : 'Tambah Slide')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 p-6">
            <form action="{{ isset($slide) ? route('admin.slides.update', $slide) : route('admin.slides.store') }}"
                  method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @if (isset($slide)) @method('PUT') @endif

                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $slide->title ?? '') }}" required maxlength="255"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Judul utama yang tampil di banner hero.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Subtitle <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $slide->subtitle ?? '') }}" maxlength="500"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Deskripsi pendamping judul.</p>
                </div>

                <div x-data="{ preview: null }">
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Gambar @if(!isset($slide))<span class="text-red-500">*</span>@endif</label>
                    <input type="file" name="image" accept="image/png,image/jpeg,image/jpg,image/webp" {{ isset($slide) ? '' : 'required' }}
                           @change="preview = URL.createObjectURL($event.target.files[0])"
                           x-ref="fileInput"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-aluminium-600 file:text-white file:text-sm file:font-medium hover:file:bg-aluminium-700 transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Format: JPG, PNG, WebP. Maksimal 2MB. Ukuran ideal: 1920x800px. @if(isset($slide))Biarkan kosong jika tidak ingin mengganti gambar.@endif</p>
                    <div x-show="preview" class="relative mt-3 inline-block">
                        <img :src="preview" class="w-32 h-20 rounded-lg object-cover border border-aluminium-200 shadow-sm cursor-pointer" @click="imgPopup = preview">
                        <button type="button" @click="preview = null; $refs.fileInput.value = ''"
                                class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    @if (isset($slide) && $slide->image)
                        @php $slideImg = $slide->image_url; @endphp
                        <div x-data="{ showExisting: true }" x-show="showExisting" class="relative mt-3 inline-block">
                            <img src="{{ $slideImg }}" alt="Preview" class="w-32 h-20 rounded-lg object-cover border border-aluminium-200 shadow-sm cursor-pointer" @click="imgPopup = '{{ $slideImg }}'">
                            <button type="button" @click="showExisting = false"
                                    class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <span x-data="{ showExisting: true }" x-show="showExisting" class="text-xs text-aluminium-400 block mt-1">Gambar saat ini</span>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Teks Tombol <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                        <input type="text" name="button_text" value="{{ old('button_text', $slide->button_text ?? '') }}" maxlength="100"
                               class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                        <p class="text-xs text-aluminium-400 mt-1">Kosongkan untuk "Lihat Koleksi".</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-aluminium-700 mb-1.5">URL Tombol <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                        <input type="text" name="button_url" value="{{ old('button_url', $slide->button_url ?? '') }}" maxlength="255"
                               class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                        <p class="text-xs text-aluminium-400 mt-1">Kosongkan untuk "/produk".</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Urutan <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $slide->sort_order ?? 0) }}" min="0"
                           class="w-32 rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Semakin kecil angka, semakin awal tampil.</p>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                        {{ old('is_active', $slide->is_active ?? true) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-aluminium-300 text-aluminium-600 focus:ring-aluminium-500/20">
                    <label for="is_active" class="text-sm text-aluminium-600">Aktif</label>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="btn-admin-primary">
                        <i class="far fa-floppy-disk"></i> {{ isset($slide) ? 'Perbarui' : 'Simpan' }}
                    </button>
                    <a href="{{ route('admin.slides.index') }}" class="btn-admin-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
