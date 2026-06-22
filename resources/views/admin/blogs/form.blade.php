@extends('admin.layouts.app')

@section('title', isset($blog) ? 'Edit Blog - Admin RDR Interior Aluminium' : 'Tambah Blog - Admin RDR Interior Aluminium')

@section('header', isset($blog) ? 'Edit Blog' : 'Tambah Blog')

@section('content')
    <div class="max-w-3xl">
        <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 p-6">
            <form action="{{ isset($blog) ? route('admin.blogs.update', $blog) : route('admin.blogs.store') }}"
                  method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @if (isset($blog)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                        <select name="blog_category_id" required
                                class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                            <option value="">Pilih kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('blog_category_id', $blog->blog_category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $blog->title ?? '') }}" required maxlength="255"
                               class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                        <p class="text-xs text-aluminium-400 mt-1">Maksimal 255 karakter. Slug akan dibuat otomatis dari judul.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Penulis <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                        <input type="text" name="author" value="{{ old('author', $blog->author ?? 'RDR Interior Aluminium') }}" maxlength="255"
                               class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                        <p class="text-xs text-aluminium-400 mt-1">Kosongkan untuk menggunakan "RDR Interior Aluminium" sebagai penulis.</p>
                    </div>

                    <div x-data="{ preview: null }">
                        <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Thumbnail <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                        <input type="file" name="thumbnail" accept="image/png,image/jpeg,image/jpg,image/webp"
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
                        @if (isset($blog) && $blog->thumbnail)
                            @php $thumbSrc = Str::startsWith($blog->thumbnail, 'http') ? $blog->thumbnail : asset('storage/' . $blog->thumbnail); @endphp
                            <input type="hidden" name="remove_image" value="0" x-ref="removeInput">
                            <div x-data="{ showExisting: true }" x-show="showExisting" class="relative mt-3 inline-block">
                                <img src="{{ $thumbSrc }}" alt="Preview" class="w-24 h-24 rounded-lg object-cover border border-aluminium-200 shadow-sm cursor-pointer" @click="imgPopup = '{{ $thumbSrc }}'">
                                <button type="button" @click="showExisting = false; $refs.removeInput.value = '1'"
                                        class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <span x-data="{ showExisting: true }" x-show="showExisting" class="text-xs text-aluminium-400 block mt-1">Gambar saat ini</span>
                        @endif
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Kutipan / Excerpt <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <textarea name="excerpt" rows="2" class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors" maxlength="500">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
                    <p class="text-xs text-aluminium-400 mt-1">Ringkasan singkat artikel (maksimal 500 karakter). Akan ditampilkan di halaman blog.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Konten <span class="text-red-500">*</span></label>
                    <textarea name="content" id="summernote-content" rows="15" class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm">{{ old('content', $blog->content ?? '') }}</textarea>
                    <p class="text-xs text-aluminium-400 mt-1">Gunakan editor untuk memformat konten artikel.</p>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                        {{ old('is_active', $blog->is_active ?? true) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-aluminium-300 text-aluminium-600 focus:ring-aluminium-500/20">
                    <label for="is_active" class="text-sm text-aluminium-600">Aktif</label>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="btn-admin-primary">
                        <i class="far fa-floppy-disk"></i> {{ isset($blog) ? 'Perbarui' : 'Simpan' }}
                    </button>
                    <a href="{{ route('admin.blogs.index') }}" class="btn-admin-secondary">
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
                $('#summernote-content').summernote({
                    height: 300,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture']],
                        ['view', ['codeview']]
                    ]
                });
            }
        }, 200);
    });
</script>
@endpush
