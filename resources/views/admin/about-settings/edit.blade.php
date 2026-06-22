@extends('admin.layouts.app')

@section('title', 'Pengaturan Halaman Tentang - Admin RDR Interior Aluminium')

@section('header', 'Pengaturan Halaman Tentang')

@section('content')
    <form action="{{ route('admin.about-settings.update') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl space-y-6">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 p-6">
            <h3 class="text-sm font-semibold text-aluminium-800 mb-5 flex items-center gap-2">
                <i class="fas fa-building text-aluminium-600"></i> Konten Halaman Tentang
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Judul Halaman <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <input type="text" name="about_title" value="{{ $settings['about_title'] ?? '' }}" maxlength="255"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Judul utama halaman Tentang Kami.</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Deskripsi <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <textarea name="about_description" id="summernote-about-desc" rows="5" class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm">{{ $settings['about_description'] ?? '' }}</textarea>
                    <p class="text-xs text-aluminium-400 mt-1">Deskripsi tentang perusahaan.</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Visi <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <textarea name="about_vision" id="summernote-about-visi" rows="4" class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm">{{ $settings['about_vision'] ?? '' }}</textarea>
                    <p class="text-xs text-aluminium-400 mt-1">Visi perusahaan.</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Misi <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <textarea name="about_mission" id="summernote-about-misi" rows="4" class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm">{{ $settings['about_mission'] ?? '' }}</textarea>
                    <p class="text-xs text-aluminium-400 mt-1">Misi perusahaan.</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 p-6">
            <h3 class="text-sm font-semibold text-aluminium-800 mb-5 flex items-center gap-2">
                <i class="fas fa-image text-aluminium-600"></i> Gambar Utama
            </h3>
            <div x-data="{ preview: null }">
                <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Gambar Tentang <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                <input type="file" name="about_image" accept="image/png,image/jpeg,image/jpg,image/webp"
                       @change="preview = URL.createObjectURL($event.target.files[0])"
                       x-ref="fileInput"
                       class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-aluminium-600 file:text-white file:text-sm file:font-medium hover:file:bg-aluminium-700 transition-colors">
                <p class="text-xs text-aluminium-400 mt-1">Format: JPG, PNG, WebP. Maksimal 2MB. Ukuran ideal: 800x600px.</p>
                <div x-show="preview" class="relative mt-2 inline-block">
                    <img :src="preview" class="w-40 h-28 rounded-lg object-cover border border-aluminium-200 shadow-sm">
                    <button type="button" @click="preview = null; $refs.fileInput.value = ''"
                            class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @if (!empty($settings['about_image']))
                    @php $_aboutImg = Str::startsWith($settings['about_image'], 'http') ? $settings['about_image'] : asset('storage/' . $settings['about_image']); @endphp
                    <div x-data="{ showExisting: true }" x-show="showExisting" class="relative mt-2 inline-block">
                        <img src="{{ $_aboutImg }}" alt="Gambar Tentang" class="w-40 h-28 rounded-lg object-cover border border-aluminium-200 shadow-sm">
                        <button type="button" @click="showExisting = false"
                                class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <span x-data="{ showExisting: true }" x-show="showExisting" class="text-xs text-aluminium-400 block mt-1">Gambar saat ini</span>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-admin-primary">
                <i class="far fa-floppy-disk"></i> Simpan Pengaturan
            </button>
            <a href="{{ route('admin.settings.index') }}" class="btn-admin-secondary">
                Kembali
            </a>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        if (typeof $.fn.summernote === 'undefined') { loadSummernote(); }
        const _initSn = setInterval(function() {
            if (typeof $.fn.summernote !== 'undefined') {
                clearInterval(_initSn);
                $('#summernote-about-desc').summernote({ height: 200, toolbar: [['style', ['bold', 'italic', 'underline', 'clear']], ['para', ['ul', 'ol', 'paragraph']], ['insert', ['link']], ['view', ['codeview']]] });
                $('#summernote-about-visi').summernote({ height: 200, toolbar: [['style', ['bold', 'italic', 'underline', 'clear']], ['para', ['ul', 'ol', 'paragraph']], ['insert', ['link']], ['view', ['codeview']]] });
                $('#summernote-about-misi').summernote({ height: 200, toolbar: [['style', ['bold', 'italic', 'underline', 'clear']], ['para', ['ul', 'ol', 'paragraph']], ['insert', ['link']], ['view', ['codeview']]] });
            }
        }, 200);
    });
</script>
@endpush
