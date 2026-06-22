@extends('layouts.app')

@section('title', 'Kategori Produk - ' . ($_globalSiteName ?? 'RDR Interior Aluminium'))
@section('meta_description', 'Jelajahi berbagai kategori produk interior aluminium dari RDR Interior Aluminium.')

@section('content')
    <section class="py-16 gradient-hero text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-in">
            <h1 class="text-4xl md:text-5xl font-bold">Kategori Produk</h1>
            <p class="text-white/70 mt-3 max-w-2xl mx-auto">Pilih kategori untuk menemukan produk interior aluminium yang Anda cari</p>
        </div>
    </section>

    <section class="py-14 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($categories->count() > 0)
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 animate-stagger">
                    @foreach ($categories as $cat)
                        <x-category-card :image="$cat->image" :name="$cat->name" :slug="$cat->slug" :description="$cat->description" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 text-aluminium-400">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <p class="text-lg font-medium">Belum ada kategori</p>
                </div>
            @endif
        </div>
    </section>
@endsection
