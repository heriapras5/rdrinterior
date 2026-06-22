@extends('layouts.app')

@section('title', 'Tentang Kami - ' . ($_globalSiteName ?? 'RDR Interior Aluminium'))
@section('meta_description', 'Kenali lebih dekat RDR Interior Aluminium, solusi interior aluminium berkualitas untuk hunian dan komersial.')

@section('content')
    @php
        $_aboutTitle   = $_globalSettings['about_title'] ?? 'Tentang ' . ($_globalSiteName ?? 'RDR Interior Aluminium');
        $_aboutDesc    = $_globalSettings['about_description'] ?? '';
        $_aboutVision  = $_globalSettings['about_vision'] ?? '';
        $_aboutMission = $_globalSettings['about_mission'] ?? '';
        $_aboutImgRaw  = $_globalSettings['about_image'] ?? '';
        $_aboutImg     = $_aboutImgRaw ? (\Illuminate\Support\Str::startsWith($_aboutImgRaw, 'http') ? $_aboutImgRaw : asset('storage/' . $_aboutImgRaw)) : null;
        $_waNumber     = $_globalSettings['whatsapp_number'] ?? '6281234567890';
    @endphp

    <section class="py-16 gradient-hero text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-in">
            <h1 class="text-4xl md:text-5xl font-bold">Tentang Kami</h1>
            <p class="text-white/70 mt-3 max-w-2xl mx-auto">Kenali lebih dekat {{ $_globalSiteName }}, solusi interior aluminium berkualitas untuk hunian dan komersial.</p>
        </div>
    </section>

    @if ($_aboutImg || $_aboutDesc)
    <section class="py-20 md:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div data-aos="fade-in">
                    <span class="inline-block text-xs font-semibold text-aluminium-500 uppercase tracking-[0.2em] mb-3">Tentang Kami</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-aluminium-900 mb-6 leading-tight">{{ $_aboutTitle }}</h2>
                    <div class="text-aluminium-600 text-base md:text-lg leading-relaxed prose prose-aluminium max-w-none">
                        {!! $_aboutDesc !!}
                    </div>
                </div>
                @if ($_aboutImg)
                <div class="relative group" data-aos="slide-up">
                    <div class="overflow-hidden rounded-xl shadow-lg shadow-aluminium-200/50">
                        <img src="{{ $_aboutImg }}" alt="{{ $_aboutTitle }}" loading="lazy" class="w-full aspect-[4/3] object-cover group-hover:scale-[1.02] transition-transform duration-700">
                    </div>
                    <div class="absolute -bottom-3 -right-3 w-24 h-24 bg-aluminium-800/5 rounded-xl -z-10"></div>
                    <div class="absolute -top-3 -left-3 w-16 h-16 bg-aluminium-800/5 rounded-xl -z-10"></div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    @if ($_aboutVision || $_aboutMission)
    <section class="py-20 md:py-28 bg-aluminium-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-in">
                <span class="inline-block text-xs font-semibold text-aluminium-500 uppercase tracking-[0.2em]">Arah & Tujuan</span>
                <h2 class="text-3xl md:text-4xl font-bold text-aluminium-900 mt-3">Visi & Misi</h2>
                <p class="text-aluminium-500 mt-3 max-w-2xl mx-auto">Komitmen kami dalam memberikan produk dan pelayanan terbaik</p>
            </div>
            <div class="max-w-3xl mx-auto space-y-8" data-aos="slide-up">
                @if ($_aboutVision)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border border-aluminium-200 border-t-[3px] border-t-aluminium-800">
                    <div class="p-8 md:p-10">
                        <div class="w-12 h-12 bg-aluminium-800 rounded-lg flex items-center justify-center mb-6">
                            <i class="fas fa-eye text-white text-lg"></i>
                        </div>
                        <h3 class="text-xl font-bold text-aluminium-900 mb-4">Visi</h3>
                        <div class="text-aluminium-600 leading-relaxed prose prose-aluminium max-w-none">
                            {!! $_aboutVision !!}
                        </div>
                    </div>
                </div>
                @endif
                @if ($_aboutMission)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border border-aluminium-200 border-t-[3px] border-t-aluminium-800">
                    <div class="p-8 md:p-10">
                        <div class="w-12 h-12 bg-aluminium-800 rounded-lg flex items-center justify-center mb-6">
                            <i class="fas fa-list-check text-white text-lg"></i>
                        </div>
                        <h3 class="text-xl font-bold text-aluminium-900 mb-4">Misi</h3>
                        <div class="text-aluminium-600 leading-relaxed prose prose-aluminium max-w-none">
                            {!! $_aboutMission !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <section class="py-16 text-center gradient-hero text-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Mewujudkan Interior Impian Anda?</h2>
            <p class="text-lg text-white/70 mb-10 max-w-xl mx-auto">Hubungi kami untuk konsultasi dan pemesanan produk interior aluminium</p>
            <a href="https://wa.me/{{ $_waNumber }}?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20produk%20interior%20aluminium" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-8 py-4 bg-white text-aluminium-800 font-semibold rounded-xl shadow-md hover:bg-aluminium-50 transition-all duration-300">
                <i class="fab fa-whatsapp text-lg mr-2"></i>
                Hubungi via WhatsApp
            </a>
        </div>
    </section>
@endsection
