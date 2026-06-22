@extends('admin.layouts.app')

@section('title', isset($product) ? 'Edit Produk - Admin ' . ($_globalSiteName ?? 'RDR Interior Aluminium') : 'Tambah Produk - Admin ' . ($_globalSiteName ?? 'RDR Interior Aluminium'))

@section('header', isset($product) ? 'Edit Produk' : 'Tambah Produk')

@section('content')
    <div class="max-w-3xl">
        @if ($errors->any())
            <div class="mb-6 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">
                <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
                <div class="flex-1 text-sm">
                    <span class="font-medium">Terjadi kesalahan:</span>
                    <ul class="list-disc list-inside mt-1 space-y-0.5">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div x-show="validationErrors && Object.keys(validationErrors).length" class="mb-6 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">
            <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
            <div class="flex-1 text-sm">
                <span class="font-medium">Terjadi kesalahan:</span>
                <template x-for="(msgs, field) in validationErrors" :key="field">
                    <ul class="list-disc list-inside mt-1 space-y-0.5">
                        <template x-for="msg in msgs" :key="msg">
                            <li x-text="msg"></li>
                        </template>
                    </ul>
                </template>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 p-6">
            <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
                  method="POST" enctype="multipart/form-data" class="space-y-5"
      x-data="{
          newFiles: [],
          deletedImages: [],
          validationErrors: {},
          addNewFiles(event) {
              const files = Array.from(event.target.files);
              files.forEach(f => {
                  const dup = this.newFiles.some(nf => nf.file.name === f.name && nf.file.size === f.size);
                  if (!dup) this.newFiles.push({ file: f, url: URL.createObjectURL(f) });
              });
              event.target.value = '';
          },
          removeNewFile(index) {
              URL.revokeObjectURL(this.newFiles[index].url);
              this.newFiles.splice(index, 1);
          },
          removeExisting(id) {
              this.deletedImages.push(id);
          },
          async submitForm() {
              const formData = new FormData(this.$el);
              formData.delete('images[]');
              this.newFiles.forEach(f => formData.append('images[]', f.file));
              try {
                  const res = await fetch(this.$el.action, {
                      method: 'POST',
                      body: formData,
                      headers: { 'Accept': 'application/json' }
                  });
                  if (res.redirected) {
                      window.location.href = res.url;
                  } else if (res.ok) {
                      window.location.href = '{{ route('admin.products.index') }}';
                  } else if (res.status === 422) {
                      const errData = await res.json();
                      this.validationErrors = errData.errors || {};
                  } else {
                      window.location.reload();
                  }
              } catch(e) {
                  this.$el.submit();
              }
          }
      }"
      @submit.prevent="submitForm">
    @csrf
    @if (isset($product)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                        <select name="product_category_id" required
                                class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                            <option value="">Pilih kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('product_category_id', $product->product_category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required maxlength="255"
                               class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                        <p class="text-xs text-aluminium-400 mt-1">Maksimal 255 karakter. Slug akan dibuat otomatis dari nama.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Material <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                        <input type="text" name="material" value="{{ old('material', $product->material ?? '') }}" maxlength="255"
                               class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                        <p class="text-xs text-aluminium-400 mt-1">Contoh: Aluminium 6063, Stainless Steel</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Dimensi <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                        <input type="text" name="dimensions" value="{{ old('dimensions', $product->dimensions ?? '') }}" placeholder="120 x 60 x 75 cm"
                               class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                        <p class="text-xs text-aluminium-400 mt-1">Format: Panjang x Lebar x Tinggi (cm)</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Warna <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                        <input type="text" name="color" value="{{ old('color', $product->color ?? '') }}" placeholder="Putih, Hitam, Coklat"
                               class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                        <p class="text-xs text-aluminium-400 mt-1">Warna produk. Contoh: Putih, Hitam, Coklat</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Waktu Preorder <span class="text-aluminium-400 font-normal">(opsional)</span></label>
                        <input type="text" name="preorder_time" value="{{ old('preorder_time', $product->preorder_time ?? '') }}" placeholder="1-2 minggu"
                               class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                        <p class="text-xs text-aluminium-400 mt-1">Estimasi waktu preorder. Contoh: 1-2 minggu, 7-14 hari</p>
                    </div>

                </div>

                <div class="border-t border-aluminium-200 pt-5">
                    <h3 class="text-sm font-semibold text-aluminium-700 mb-4">Tautan E-commerce</h3>
                    <p class="text-xs text-aluminium-400 mb-4">Masukkan URL lengkap (https://...) untuk setiap marketplace. Kosongkan jika tidak tersedia.</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-aluminium-700 mb-1.5">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-green-600" viewBox="0 0 24 24" fill="currentColor"><rect x="2" y="2" width="20" height="20" rx="5" fill="currentColor" fill-opacity=".15"/><rect x="5" y="5.5" width="14" height="3.5" rx="1" fill="currentColor"/><rect x="10" y="9" width="4" height="10" rx="2" fill="currentColor"/></svg>
                                    Tokopedia
                                </span>
                            </label>
                            <input type="url" name="tokopedia_url" value="{{ old('tokopedia_url', $product->tokopedia_url ?? '') }}" placeholder="https://tokopedia.com/..."
                                   class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-aluminium-700 mb-1.5">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-orange-500" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="11" fill="currentColor" fill-opacity=".15"/><path d="M6 9.5h12v11c0 .6-.4 1-1 1H7c-.6 0-1-.4-1-1v-11z" fill="currentColor"/><path d="M9.5 9.5V7.5c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                                    Shopee
                                </span>
                            </label>
                            <input type="url" name="shopee_url" value="{{ old('shopee_url', $product->shopee_url ?? '') }}" placeholder="https://shopee.co.id/..."
                                   class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-aluminium-700 mb-1.5">
                                <span class="flex items-center gap-1.5">
                                    <i class="fab fa-tiktok"></i>
                                    TikTok Shop
                                </span>
                            </label>
                            <input type="url" name="tiktokshop_url" value="{{ old('tiktokshop_url', $product->tiktokshop_url ?? '') }}" placeholder="https://tiktok.com/..."
                                   class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-aluminium-500/20 focus:border-aluminium-500 outline-none transition-colors">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="description" id="summernote-desc" rows="5" class="w-full rounded-lg border border-aluminium-300 px-4 py-2.5 text-sm">{{ old('description', $product->description ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-aluminium-700 mb-1.5">Gambar <span class="text-red-500">*</span></label>
                    <input type="file" multiple accept="image/png,image/jpeg,image/jpg,image/webp"
                           @change="addNewFiles($event)" x-ref="fileInput" hidden>
                    <button type="button" @click="$refs.fileInput.click()"
                            class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-lg border-2 border-dashed border-aluminium-300 text-aluminium-500 hover:border-aluminium-400 hover:text-aluminium-600 transition-colors text-sm">
                        <i class="fas fa-plus"></i> Pilih Gambar
                    </button>
                    <p class="text-xs text-aluminium-400 mt-1">Format: JPG, PNG, WebP. Maksimal 5MB per gambar. Klik tombol di atas untuk memilih file (bisa berkali-kali).</p>

                    <template x-for="id in deletedImages" :key="id">
                        <input type="hidden" name="deleted_images[]" :value="id">
                    </template>

                    @if (isset($product) && $product->images && count($product->images) > 0)
                        <div class="mt-3">
                            <p class="text-xs font-medium text-aluminium-500 mb-2">Gambar saat ini:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($product->images as $img)
                                    @php $pImg = Str::startsWith($img->image, 'http') ? $img->image : asset('storage/' . $img->image); @endphp
                                    <div x-data="{ visible: true }" x-show="visible" class="relative">
                                        <img src="{{ $pImg }}" alt="Preview" class="w-16 h-16 rounded-lg object-cover border border-aluminium-200 shadow-sm cursor-pointer" @click="imgPopup = '{{ $pImg }}'">
                                        <button type="button" @click="visible = false; removeExisting({{ $img->id }})"
                                                class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <p x-show="deletedImages.length > 0" class="text-xs text-red-500 mt-2"><span x-text="deletedImages.length"></span> gambar akan dihapus saat disimpan.</p>
                        </div>
                    @endif

                    <div x-show="newFiles.length" class="flex flex-wrap gap-2 mt-3">
                        <p class="text-xs font-medium text-aluminium-500 mb-2 w-full">Gambar baru:</p>
                        <template x-for="(f, idx) in newFiles" :key="idx">
                            <div class="relative">
                                <img :src="f.url" class="w-16 h-16 rounded-lg object-cover border-2 border-green-300 shadow-sm cursor-pointer" @click="imgPopup = f.url">
                                <button type="button" @click="removeNewFile(idx)"
                                        class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-sm">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-aluminium-300 text-aluminium-600 focus:ring-aluminium-500/20">
                        <label for="is_active" class="text-sm text-aluminium-600">Aktif</label>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="is_highlight" id="is_highlight" value="1"
                            {{ old('is_highlight', $product->is_highlight ?? false) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-aluminium-300 text-aluminium-600 focus:ring-aluminium-500/20">
                        <label for="is_highlight" class="text-sm text-aluminium-600">Tampilkan di Beranda</label>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="btn-admin-primary">
                        <i class="far fa-floppy-disk"></i> {{ isset($product) ? 'Perbarui' : 'Simpan' }}
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn-admin-secondary">
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
                $('#summernote-desc').summernote({
                    height: 200,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link']],
                        ['view', ['codeview']]
                    ]
                });
            }
        }, 200);
    });
</script>
@endpush
