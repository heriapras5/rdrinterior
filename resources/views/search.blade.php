@extends('layouts.app')

@section('title', $q ? "Pencarian \"$q\" - $_globalSiteName" : "Pencarian - $_globalSiteName")
@section('meta_description', 'Hasil pencarian produk dan artikel di ' . ($_globalSiteName ?? 'RDR Interior Aluminium') . '.')

@section('content')
    <section class="py-16 gradient-hero text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-in">
            <h1 class="text-4xl md:text-5xl font-bold">Pencarian</h1>
            <p class="text-white/70 mt-3 max-w-2xl mx-auto">Temukan produk dan artikel yang Anda cari</p>
        </div>
    </section>

    <section class="py-14 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="/search" method="GET" class="max-w-2xl mx-auto mb-12" data-aos="fade-in">
                <div class="relative">
                    <input type="text" name="q" value="{{ $q }}" placeholder="Cari produk atau artikel..." required
                           class="w-full pl-12 pr-6 py-4 border border-aluminium-200 rounded-xl focus:ring-2 focus:ring-aluminium-400 focus:border-aluminium-400 outline-none transition-all duration-200 text-lg bg-aluminium-50">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-6 h-6 text-aluminium-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </form>

            @if ($q)
                <div class="mb-8 text-aluminium-600" data-aos="fade-in">
                    <p>Menampilkan hasil untuk: <strong class="text-aluminium-800">"{{ $q }}"</strong></p>
                </div>

                @if ($products->count() > 0)
                    <div class="mb-12" data-aos="slide-up">
                        <h2 class="text-xl font-bold text-aluminium-900 mb-6">Produk</h2>
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                            @foreach ($products as $product)
                                <x-product-card :image="$product->images->first()?->image ?? ''" :name="$product->name" :slug="$product->slug" :category="$product->category?->name ?? ''" :material="$product->material" :color="$product->color" :dimensions="$product->dimensions" />
                            @endforeach
                        </div>
                        <x-pagination :paginator="$products" />
                    </div>
                @endif

                @if ($blogs->count() > 0)
                    <div data-aos="slide-up">
                        <h2 class="text-xl font-bold text-aluminium-900 mb-6">Artikel</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach ($blogs as $blog)
                                <x-blog-card
                                    :thumbnail="$blog->thumbnail"
                                    :title="$blog->title"
                                    :slug="$blog->slug"
                                    :category="$blog->category?->name ?? ''"
                                    :date="$blog->created_at->format('d M Y')"
                                    :excerpt="$blog->excerpt ?? strip_tags(Str::limit($blog->content, 150))"
                                />
                            @endforeach
                        </div>
                        <x-pagination :paginator="$blogs" />
                    </div>
                @endif

                @if ($products->count() === 0 && $blogs->count() === 0)
                    <div class="text-center py-16 text-aluminium-400" data-aos="fade-in">
                        <svg class="w-20 h-20 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <p class="text-lg font-medium text-aluminium-500">Tidak ditemukan hasil untuk "{{ $q }}"</p>
                        <p class="text-sm mt-2">Coba gunakan kata kunci lain atau jelajahi kategori produk kami</p>
                        <div class="flex items-center justify-center gap-4 mt-6">
                            <a href="/produk" class="btn-primary">Lihat Semua Produk</a>
                            <a href="/kategori" class="btn-outline">Jelajahi Kategori</a>
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-16 text-aluminium-400" data-aos="fade-in">
                    <svg class="w-20 h-20 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <p class="text-lg font-medium text-aluminium-500">Masukkan kata kunci untuk mencari</p>
                    <p class="text-sm mt-2">Cari produk atau artikel yang Anda butuhkan</p>
                </div>
            @endif
        </div>
    </section>
@endsection
