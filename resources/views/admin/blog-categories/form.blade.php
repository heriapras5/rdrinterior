@extends('admin.layouts.app')

@section('title', isset($category) ? 'Edit Kategori Blog - Admin RDR Interior Aluminium' : 'Tambah Kategori Blog - Admin RDR Interior Aluminium')

@section('header', isset($category) ? 'Edit Kategori Blog' : 'Tambah Kategori Blog')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 p-6">
            <form action="{{ isset($category) ? route('admin.blog-categories.update', $category) : route('admin.blog-categories.store') }}"
                  method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @if (isset($category)) @method('PUT') @endif

                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required maxlength="255"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Maksimal 255 karakter. Slug akan dibuat otomatis dari nama.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Deskripsi <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <textarea name="description" id="summernote-bcat-desc" rows="3" class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm">{{ old('description', $category->description ?? '') }}</textarea>
                </div>

                <div x-data="{ preview: null }">
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Gambar <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <input type="file" name="image" accept="image/png,image/jpeg,image/jpg,image/webp"
                           @change="preview = URL.createObjectURL($event.target.files[0])"
                           x-ref="fileInput"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-aluminium-600 file:text-white file:text-sm file:font-medium hover:file:bg-aluminium-700 transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Format: JPG, PNG, WebP. Maksimal 2MB.</p>
                    <div x-show="preview" class="relative mt-3 inline-block">
                        <img :src="preview" class="w-24 h-24 rounded-lg object-cover border border-aluminium-200 shadow-sm cursor-pointer" @click="imgPopup = preview">
                        <button type="button" @click="preview = null; $refs.fileInput.value = ''"
                                class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    @if (isset($category) && $category->image)
                        @php $catImg = Str::startsWith($category->image, 'http') ? $category->image : asset('storage/' . $category->image); @endphp
                        <input type="hidden" name="remove_image" value="0" x-ref="removeInput">
                        <div x-data="{ showExisting: true }" x-show="showExisting" class="relative mt-3 inline-block">
                            <img src="{{ $catImg }}" alt="Preview" class="w-24 h-24 rounded-lg object-cover border border-aluminium-200 shadow-sm cursor-pointer" @click="imgPopup = '{{ $catImg }}'">
                            <button type="button" @click="showExisting = false; $refs.removeInput.value = '1'"
                                    class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <span x-data="{ showExisting: true }" x-show="showExisting" class="text-xs text-aluminium-400 block mt-1">Gambar saat ini</span>
                    @endif
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                        {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-aluminium-300 text-aluminium-600 focus:ring-aluminium-500/20">
                    <label for="is_active" class="text-sm text-aluminium-600">Aktif</label>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="btn-admin-primary">
                        <i class="far fa-floppy-disk"></i> {{ isset($category) ? 'Perbarui' : 'Simpan' }}
                    </button>
                    <a href="{{ route('admin.blog-categories.index') }}" class="btn-admin-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        if (typeof $.fn.summernote === 'undefined') { loadSummernote(); }
        const _initSn = setInterval(function() {
            if (typeof $.fn.summernote !== 'undefined') {
                clearInterval(_initSn);
                $('#summernote-bcat-desc').summernote({ height: 150, toolbar: [['style', ['bold', 'italic', 'underline', 'clear']], ['para', ['ul', 'ol', 'paragraph']], ['insert', ['link']], ['view', ['codeview']]] });
            }
        }, 200);
    });
</script>
@endpush
