@extends('layouts.app')

@section('title', $_globalSiteName ?? 'RDR Interior Aluminium')
@section('og_title', $_globalSiteName ?? 'RDR Interior Aluminium')
@section('og_type', 'website')

@push('styles')
<style>
    .hero-slide-img {
        transform: scale(1);
        transition: transform 8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .swiper-slide-active .hero-slide-img {
        transform: scale(1.12);
    }
    .hero-swiper .hero-title {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hero-swiper .swiper-slide-active .hero-title {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.3s;
    }
    .hero-swiper .hero-subtitle {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hero-swiper .swiper-slide-active .hero-subtitle {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.5s;
    }
    .hero-swiper .hero-btn-group {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hero-swiper .swiper-slide-active .hero-btn-group {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.7s;
    }
    .hero-swiper .hero-badge {
        opacity: 0;
    }
    .hero-swiper .swiper-slide-active .hero-badge {
        animation: heroFadeInDown 0.6s ease-out 0.1s forwards;
    }
    @keyframes heroFadeInDown {
        from { opacity: 0; transform: translateY(-15px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
    @php
        if (empty($slides)) {
            $slides = [
                ['image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=1600&q=80', 'title' => 'Interior Aluminium Premium', 'subtitle' => 'Solusi interior aluminium berkualitas tinggi untuk hunian dan komersial Anda. Pintu, jendela, partisi, dan kitchen set aluminium modern.', 'button_url' => '/produk', 'button_text' => 'Lihat Koleksi'],
                ['image' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=1600&q=80', 'title' => 'Desain Modern & Elegan', 'subtitle' => 'Temukan berbagai pilihan desain interior aluminium terbaru dengan kualitas terbaik dan harga kompetitif.', 'button_url' => '/produk', 'button_text' => 'Lihat Koleksi'],
                ['image' => 'https://images.unsplash.com/photo-1578301978693-85fa9c0320b9?w=1600&q=80', 'title' => 'Kualitas Terjamin', 'subtitle' => 'Bahan aluminium berkualitas tinggi, dikerjakan oleh tenaga ahli berpengalaman, dengan garansi kepuasan.', 'button_url' => '/produk', 'button_text' => 'Lihat Koleksi'],
            ];
        }
    @endphp

    <section class="relative">
        <x-hero-slider :slides="$slides" />
    </section>

    @php
        $_aboutDesc = strip_tags($_globalSettings['about_description'] ?? '');
        $_aboutImg = $_globalSettings['about_image'] ?? '';
        if ($_aboutImg && !Str::startsWith($_aboutImg, 'http')) {
            $_aboutImg = asset('storage/' . $_aboutImg);
        }
    @endphp
    @if (!empty($_aboutDesc) || !empty($_aboutImg))
        <section class="py-20 md:py-28 bg-aluminium-50" data-aos="slide-up">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-14">
                    <span class="inline-block text-xs font-semibold text-aluminium-500 uppercase tracking-[0.2em] mb-3">Tentang Kami</span>
                    <h2 class="section-title" data-aos="fade-in">{{ $_globalSiteName ?? 'RDR Interior Aluminium' }}</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-start">
                    <div class="text-left @if (empty($_aboutImg)) md:col-span-2 text-center @endif">
                        @if (!empty($_aboutDesc))
                            <p class="text-aluminium-600 leading-relaxed line-clamp-4" data-aos="fade-in">{{ $_aboutDesc }}</p>
                        @endif
                        <div class="mt-6" data-aos="fade-in">
                            <a href="/tentang" class="btn-outline">Selengkapnya <i class="fas fa-arrow-right ml-1.5"></i></a>
                        </div>
                    </div>
                    @if (!empty($_aboutImg))
                        <div data-aos="slide-up">
                            <img src="{{ $_aboutImg }}" alt="Tentang {{ $_globalSiteName ?? 'RDR Interior Aluminium' }}"
                                 class="w-full rounded-2xl shadow-lg object-cover aspect-[4/3]">
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <section class="py-20 md:py-28 bg-white" data-aos="slide-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <span class="inline-block text-xs font-semibold text-aluminium-500 uppercase tracking-[0.2em] mb-3">Highlight Produk</span>
                <h2 class="section-title" data-aos="fade-in">Produk Pilihan</h2>
                <p class="section-subtitle" data-aos="fade-in">Koleksi produk interior aluminium pilihan dari {{ $_globalSiteName }}</p>
            </div>
            @if ($highlights->count() > 0)
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 animate-stagger">
                    @foreach ($highlights as $product)
                        <x-product-card :image="$product->images->first()?->image ?? ''" :name="$product->name" :slug="$product->slug" :category="$product->category?->name ?? ''" :material="$product->material" :color="$product->color" :dimensions="$product->dimensions" />
                    @endforeach
                </div>
                <div class="text-center mt-10" data-aos="fade-in">
                    <a href="/produk" class="btn-primary">Lihat Semua Produk</a>
                </div>
            @else
                <div class="text-center py-12 text-aluminium-400">
                    <i class="fas fa-box text-3xl mb-3 block"></i>
                    <p class="text-sm">Belum ada produk yang dipilih untuk ditampilkan di beranda.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="py-20 md:py-24 bg-gradient-to-r from-aluminium-800 to-aluminium-900 text-white text-center" data-aos="slide-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-bold">Tertarik dengan Produk Kami?</h2>
                <p class="text-white/70 mt-3 leading-relaxed">Hubungi kami untuk konsultasi gratis dan dapatkan penawaran terbaik untuk kebutuhan interior aluminium Anda.</p>
                <div class="flex flex-wrap justify-center gap-3 mt-8">
                    @php $_waCta = $_globalSettings['whatsapp_number'] ?? ''; @endphp
                    @if ($_waCta)
                        <a href="https://wa.me/{{ $_waCta }}?text=Halo%20{{ urlencode($_globalSiteName ?? 'RDR Interior Aluminium') }}%2C%20saya%20tertarik%20dengan%20produk%20Anda" target="_blank" rel="noopener noreferrer" class="btn-wa text-sm">
                            <i class="fab fa-whatsapp mr-1.5"></i> Hubungi WhatsApp
                        </a>
                    @endif
                    <a href="/kontak" class="btn-secondary text-sm">
                        <i class="fas fa-envelope mr-1.5"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    <x-seo-head type="Organization" name="{{ $_globalSiteName ?? 'RDR Interior Aluminium' }}" />
@endsection
