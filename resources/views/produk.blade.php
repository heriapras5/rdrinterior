@extends('layouts.app')

@section('title', 'Semua Produk - ' . ($_globalSiteName ?? 'RDR Interior Aluminium'))
@section('meta_description', 'Katalog lengkap produk interior aluminium dari RDR Interior Aluminium. Temukan berbagai pilihan pintu, jendela, partisi, dan kitchen set aluminium.')

@section('content')
    <section class="py-16 gradient-hero text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-in">
            <h1 class="text-4xl md:text-5xl font-bold">Semua Produk</h1>
            <p class="text-white/70 mt-3 max-w-2xl mx-auto">Koleksi lengkap produk interior aluminium berkualitas untuk hunian dan komersial Anda</p>
        </div>
    </section>

    <section class="py-14 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($products->count() > 0)
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 animate-stagger">
                    @foreach ($products as $product)
                        <x-product-card :image="$product->images->first()?->image ?? ''" :name="$product->name" :slug="$product->slug" :category="$product->category?->name ?? ''" :material="$product->material" :color="$product->color" :dimensions="$product->dimensions" />
                    @endforeach
                </div>
                <x-pagination :paginator="$products" />
            @else
                <div class="text-center py-20 text-aluminium-400">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <p class="text-lg font-medium">Belum ada produk</p>
                    <p class="text-sm mt-1">Produk akan segera tersedia. Silakan kunjungi kembali nanti.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
