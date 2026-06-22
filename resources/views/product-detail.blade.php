@extends('layouts.app')

@php
    $_firstImg = $product->images->first()?->image ?? '';
    $_ogImg = $_firstImg ? (Str::startsWith($_firstImg, 'http') ? $_firstImg : asset('storage/' . $_firstImg)) : '';
@endphp

@section('title', $product->name . ' - ' . ($_globalSiteName ?? 'RDR Interior Aluminium'))
@section('meta_description', 'Detail produk ' . $product->name . ' dari RDR Interior Aluminium. ' . strip_tags($product->description ?? ''))
@section('og_image', $_ogImg)
@section('og_type', 'product')

@section('content')
    <section class="py-16 gradient-hero text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-in">
            <x-breadcrumb dark hideHome :items="[['label' => $product->category?->name ?? '', 'url' => '/kategori/' . ($product->category?->slug ?? '#')], ['label' => $product->name]]" />
            @if ($product->category)
                <span class="inline-block mt-6 px-3 py-1 text-sm font-medium bg-white/15 text-white rounded-lg">{{ $product->category->name }}</span>
            @endif
            <h1 class="text-4xl md:text-5xl font-bold mt-4">{{ $product->name }}</h1>
        </div>
    </section>

    <section class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12">
                <div data-aos="slide-left">
                    <div class="swiper product-gallery-main rounded-xl overflow-hidden bg-aluminium-100 shadow-sm">
                        <div class="swiper-wrapper">
                            @foreach ($product->images as $index => $img)
                                @php $_src = Str::startsWith($img->image, 'http') ? $img->image : asset('storage/' . $img->image); @endphp
                                <div class="swiper-slide">
                                    <a href="{{ $_src }}" data-fancybox="gallery" data-caption="{{ $product->name }} - Gambar {{ $index + 1 }}" class="block aspect-[4/3]">
                                        <img src="{{ $_src }}" alt="{{ $product->name }} - Gambar {{ $index + 1 }}" class="w-full h-full object-cover">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next product-gallery-next"></div>
                        <div class="swiper-button-prev product-gallery-prev"></div>
                    </div>
                    @if ($product->images->count() > 1)
                        <div class="swiper product-gallery-thumbs mt-4">
                            <div class="swiper-wrapper">
                                @foreach ($product->images as $index => $img)
                                    @php $_src = Str::startsWith($img->image, 'http') ? $img->image : asset('storage/' . $img->image); @endphp
                                    <div class="swiper-slide">
                                        <div class="aspect-square rounded-lg overflow-hidden bg-aluminium-100 border-2 border-transparent transition-all duration-200">
                                            <img src="{{ $_src }}" alt="{{ $product->name }} - Gambar {{ $index + 1 }}" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div data-aos="slide-right">
                    <div class="bg-aluminium-50 rounded-xl p-5 space-y-3">
                        @if (!empty($product->material))
                            <div class="flex items-center gap-3 text-aluminium-700">
                                <i class="fas fa-cubes w-4 text-aluminium-500 text-center"></i>
                                <div>
                                    <p class="text-[11px] text-aluminium-400 uppercase tracking-wider">Material</p>
                                    <p class="text-sm font-medium">{{ $product->material }}</p>
                                </div>
                            </div>
                        @endif
                        @if (!empty($product->color))
                            <div class="flex items-center gap-3 text-aluminium-700">
                                <i class="fas fa-palette w-4 text-aluminium-500 text-center"></i>
                                <div>
                                    <p class="text-[11px] text-aluminium-400 uppercase tracking-wider">Warna</p>
                                    <p class="text-sm font-medium">{{ $product->color }}</p>
                                </div>
                            </div>
                        @endif
                        @if (!empty($product->dimensions))
                            <div class="flex items-center gap-3 text-aluminium-700 pt-3 border-t border-aluminium-200">
                                <i class="fas fa-ruler-combined w-4 text-aluminium-500 text-center"></i>
                                <div>
                                    <p class="text-[11px] text-aluminium-400 uppercase tracking-wider">Dimensi</p>
                                    <p class="text-sm font-medium">{{ $product->dimensions }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    @php $_waPd = ($_globalSettings['whatsapp_number'] ?? null) ?: ''; @endphp
                    @if ($_waPd || $product->tokopedia_url || $product->shopee_url || $product->tiktokshop_url)
                        <div class="mt-6 space-y-3">
                            <p class="text-xs font-semibold text-aluminium-500 uppercase tracking-wider">Beli Produk Ini</p>
                            <div class="flex flex-wrap gap-3">
                                @if ($product->tokopedia_url)
                                    <a href="{{ $product->tokopedia_url }}" target="_blank" rel="noopener noreferrer" class="btn-ecommerce bg-green-600 hover:bg-green-700">
                                        <svg class="w-4 h-4 mr-1.5" viewBox="0 0 24 24" fill="currentColor"><rect x="2" y="2" width="20" height="20" rx="5" opacity=".25"/><rect x="5" y="5.5" width="14" height="3.5" rx="1"/><rect x="10" y="9" width="4" height="10" rx="2"/></svg>
                                        Tokopedia
                                    </a>
                                @endif
                                @if ($product->shopee_url)
                                    <a href="{{ $product->shopee_url }}" target="_blank" rel="noopener noreferrer" class="btn-ecommerce bg-orange-500 hover:bg-orange-600">
                                        <svg class="w-4 h-4 mr-1.5" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="11" opacity=".25"/><path d="M6 9.5h12v11c0 .6-.4 1-1 1H7c-.6 0-1-.4-1-1v-11z"/><path d="M9.5 9.5V7.5c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                                        Shopee
                                    </a>
                                @endif
                                @if ($product->tiktokshop_url)
                                    <a href="{{ $product->tiktokshop_url }}" target="_blank" rel="noopener noreferrer" class="btn-ecommerce bg-black hover:bg-aluminium-900">
                                        <i class="fab fa-tiktok mr-1.5"></i>
                                        TikTok Shop
                                    </a>
                                @endif
                            </div>
                            @if ($_waPd)
                                <a href="https://wa.me/{{ $_waPd }}?text=Halo%20{{ urlencode($_globalSiteName) }}%2C%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}%20({{ urlencode(url()->current()) }})" target="_blank" rel="noopener noreferrer" class="btn-wa text-sm">
                                    <i class="fab fa-whatsapp mr-1.5"></i>
                                    Pesan via WhatsApp
                                </a>
                            @endif
                        </div>
                    @endif

                    @if (!empty($product->description))
                        <div class="mt-8" x-data="{ expanded: false }">
                            <h2 class="text-lg md:text-xl font-bold text-aluminium-900 mb-3">Deskripsi Produk</h2>
                            <div class="relative">
                                <div x-show="!expanded" class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent z-10 pointer-events-none"></div>
                                <div :class="expanded ? '' : 'max-h-[320px] overflow-hidden'">
                                    <div class="text-sm md:text-base text-aluminium-600 leading-relaxed [&_h2]:text-lg [&_h2]:font-bold [&_h2]:text-aluminium-800 [&_h2]:mt-5 [&_h2]:mb-3 [&_h3]:font-semibold [&_h3]:text-aluminium-800 [&_h3]:mt-4 [&_h3]:mb-2 [&_p]:mb-3 [&_p]:leading-relaxed [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:space-y-1 [&_ul]:mb-3 [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:space-y-1 [&_ol]:mb-3">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                            </div>
                            <button @click="if(expanded) { $el.closest('[x-data]').scrollIntoView({ behavior: 'smooth', block: 'start' }) }; expanded = !expanded" type="button"
                                    class="mt-3 text-sm font-semibold text-aluminium-600 hover:text-aluminium-900 transition-colors">
                                <span x-text="expanded ? 'Kecilkan' : 'Baca Selengkapnya'"></span>
                                <i :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'" class="fas ml-1.5"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if ($relatedProducts->count() > 0)
        <section class="py-14 bg-aluminium-50 border-t border-aluminium-200" data-aos="slide-up">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <span class="inline-block text-xs font-semibold text-aluminium-500 uppercase tracking-[0.2em] mb-2">Produk Terkait</span>
                    <h2 class="text-2xl font-bold text-aluminium-900">Produk Terkait</h2>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 animate-stagger">
                    @foreach ($relatedProducts as $rp)
                        <x-product-card :image="$rp->images->first()?->image ?? ''" :name="$rp->name" :slug="$rp->slug" :category="$rp->category?->name ?? ''" :material="$rp->material" :color="$rp->color" :dimensions="$rp->dimensions" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @push('scripts')
    <script>
        $('[data-fancybox="gallery"]').fancybox({
            buttons: ['zoom', 'slideShow', 'download', 'close'],
            smallBtn: false,
            touch: { vertical: true },
            infobar: true,
            animationEffect: 'zoom',
            transitionEffect: 'slide',
        });
    </script>
    @endpush

    @if ($product->images->isNotEmpty())
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": {!! json_encode($product->name) !!},
        "description": {!! json_encode(strip_tags($product->description ?? '')) !!},
        "image": {!! json_encode($_ogImg) !!},
        "material": {!! json_encode($product->material ?? '') !!},
        "category": {!! json_encode($product->category?->name ?? '') !!},
        "brand": {
            "@type": "Brand",
            "name": {{ json_encode($_globalSiteName ?? 'RDR Interior Aluminium') }}
        }
    }
    </script>
    @endif
@endsection
