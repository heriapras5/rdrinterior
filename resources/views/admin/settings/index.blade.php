@extends('admin.layouts.app')

@section('title', 'Pengaturan - Admin RDR Interior Aluminium')

@section('header', 'Pengaturan Website')

@section('content')
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl space-y-6">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 p-6">
            <h3 class="text-sm font-semibold text-aluminium-800 mb-5 flex items-center gap-2">
                <i class="fas fa-info-circle text-aluminium-600"></i> Informasi Website
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Nama Situs</label>
                    <input type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}" maxlength="255"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Nama website yang ditampilkan di browser dan SEO.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Nama Perusahaan</label>
                    <input type="text" name="company_name" value="{{ $settings['company_name'] ?? '' }}" maxlength="255"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Nama PT/badan hukum perusahaan. Ditampilkan di footer.</p>
                </div>
                <div x-data="{ preview: null, remove_logo: '0' }">
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Logo <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <input type="file" name="logo" accept="image/png,image/jpeg,image/jpg,image/webp"
                           @change="preview = URL.createObjectURL($event.target.files[0])"
                           x-ref="logoInput"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-aluminium-600 file:text-white file:text-sm file:font-medium hover:file:bg-aluminium-700 transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Format: JPG, PNG, WebP. Maksimal 2MB. Ukuran ideal: 200x200px.</p>
                    <div x-show="preview" class="relative mt-2 inline-block">
                        <img :src="preview" class="w-24 h-24 rounded-lg object-cover border border-aluminium-200 shadow-sm cursor-pointer" @click="imgPopup = preview">
                        <button type="button" @click="preview = null; $refs.logoInput.value = ''"
                                class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    @if (!empty($settings['logo']))
                        @php $_logo = Str::startsWith($settings['logo'], 'http') ? $settings['logo'] : asset('storage/' . $settings['logo']); @endphp
                        <div x-data="{ showExisting: true }" x-show="showExisting" class="relative mt-2 inline-block">
                            <img src="{{ $_logo }}" alt="Logo" class="w-24 h-24 rounded-lg object-cover border border-aluminium-200 shadow-sm cursor-pointer" @click="imgPopup = '{{ $_logo }}'">
                            <button type="button" @click="showExisting = false; remove_logo = '1'"
                                    class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <span x-data="{ showExisting: true }" x-show="showExisting" class="text-xs text-aluminium-400 block mt-1">Logo saat ini</span>
                    @endif
                    <input type="hidden" name="remove_logo" x-model="remove_logo">
                </div>

                <div x-data="{ preview: null, remove_favicon: '0' }">
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Favicon</label>
                    <input type="file" name="favicon" accept="image/*"
                           @change="preview = URL.createObjectURL($event.target.files[0])"
                           x-ref="faviconInput"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-aluminium-600 file:text-white file:text-sm file:font-medium hover:file:bg-aluminium-700 transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Format: JPG, PNG, WebP. Maksimal 2MB. Ukuran ideal: 32x32px atau 64x64px.</p>
                    <div x-show="preview" class="relative mt-2 inline-block">
                        <img :src="preview" class="w-16 h-16 rounded-lg object-cover border border-aluminium-200 shadow-sm cursor-pointer" @click="imgPopup = preview">
                        <button type="button" @click="preview = null; $refs.faviconInput.value = ''"
                                class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    @if (!empty($settings['favicon']))
                        @php $_fav = Str::startsWith($settings['favicon'], 'http') ? $settings['favicon'] : asset('storage/' . $settings['favicon']); @endphp
                        <div x-data="{ showExisting: true }" x-show="showExisting" class="relative mt-2 inline-block">
                            <img src="{{ $_fav }}" alt="Favicon" class="w-16 h-16 rounded-lg object-cover border border-aluminium-200 shadow-sm cursor-pointer" @click="imgPopup = '{{ $_fav }}'">
                            <button type="button" @click="showExisting = false; remove_favicon = '1'"
                                    class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <span x-data="{ showExisting: true }" x-show="showExisting" class="text-xs text-aluminium-400 block mt-1">Favicon saat ini</span>
                    @endif
                    <input type="hidden" name="remove_favicon" x-model="remove_favicon">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Deskripsi <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <textarea name="site_description" id="summernote-site-desc" rows="3" class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm">{{ $settings['site_description'] ?? '' }}</textarea>
                    <p class="text-xs text-aluminium-400 mt-1">Deskripsi website untuk SEO.</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Deskripsi Footer <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <textarea name="footer_description" id="summernote-footer-desc" rows="3" class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm">{{ $settings['footer_description'] ?? '' }}</textarea>
                    <p class="text-xs text-aluminium-400 mt-1">Deskripsi yang ditampilkan di footer.</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 p-6">
            <h3 class="text-sm font-semibold text-aluminium-800 mb-5 flex items-center gap-2">
                <i class="fas fa-phone text-aluminium-600"></i> Kontak
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Nomor WhatsApp <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] ?? '' }}" maxlength="20"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Format: 6281234567890 (tanpa + atau spasi)</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Alamat <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <textarea name="address" rows="3" class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors" maxlength="500">{{ $settings['address'] ?? '' }}</textarea>
                    <p class="text-xs text-aluminium-400 mt-1">Alamat lengkap toko/kantor (maksimal 500 karakter).</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Jam Operasional <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <textarea name="operational_hours" rows="3" class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors" maxlength="500">{{ $settings['operational_hours'] ?? '' }}</textarea>
                    <p class="text-xs text-aluminium-400 mt-1">Jam operasional toko. Setiap baris untuk satu hari/baris jadwal.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Telepon <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <input type="text" name="phone" value="{{ $settings['phone'] ?? '' }}" maxlength="20"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Contoh: (021) 1234 5678</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Email <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <input type="email" name="email" value="{{ $settings['email'] ?? '' }}" maxlength="255"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">Email kontak yang ditampilkan di footer.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Google Maps Embed URL <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <input type="text" name="maps_embed" value="{{ $settings['maps_embed'] ?? '' }}"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">URL embed dari Google Maps untuk menampilkan peta.</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 p-6">
            <h3 class="text-sm font-semibold text-aluminium-800 mb-5 flex items-center gap-2">
                <i class="fas fa-share-nodes text-aluminium-600"></i> Media Sosial
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Facebook URL <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <input type="url" name="facebook_url" value="{{ $settings['facebook_url'] ?? '' }}" maxlength="500"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">URL lengkap halaman Facebook.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Instagram URL <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <input type="url" name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}" maxlength="500"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">URL lengkap profil Instagram.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">TikTok URL <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                    <input type="url" name="tiktok_url" value="{{ $settings['tiktok_url'] ?? '' }}" maxlength="500"
                           class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                    <p class="text-xs text-aluminium-400 mt-1">URL lengkap profil TikTok.</p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button type="submit" class="btn-admin-primary">
                <i class="far fa-floppy-disk"></i> Simpan Pengaturan
            </button>
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
                $('#summernote-site-desc').summernote({ height: 150, toolbar: [['style', ['bold', 'italic', 'underline', 'clear']], ['para', ['ul', 'ol', 'paragraph']], ['insert', ['link']], ['view', ['codeview']]] });
                $('#summernote-footer-desc').summernote({ height: 150, toolbar: [['style', ['bold', 'italic', 'underline', 'clear']], ['para', ['ul', 'ol', 'paragraph']], ['insert', ['link']], ['view', ['codeview']]] });
            }
        }, 200);
    });
</script>
@endpush
