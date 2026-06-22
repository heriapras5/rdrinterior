@props(['slides' => []])

<div class="hero-swiper swiper relative w-full h-[60vh] min-h-[400px] md:min-h-[500px] lg:h-[85vh] lg:min-h-[600px]">
    <div class="swiper-wrapper">
        @foreach ($slides as $slide)
            @php
                $_img = $slide['image'] ?? '';
                $_src = $_img ? (Str::startsWith($_img, 'http') ? $_img : asset('storage/'.$_img)) : 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=1600&q=80';
            @endphp
            <div class="swiper-slide relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-aluminium-900/90 via-aluminium-800/60 to-transparent z-10"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-aluminium-900/40 via-transparent to-transparent z-10"></div>
                <img src="{{ $_src }}" alt="{{ $slide['title'] }}"
                     class="w-full h-full object-cover hero-slide-img">
                <div class="absolute inset-0 z-20 flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="max-w-3xl text-left">
                            <span class="hero-badge inline-block px-4 py-1.5 mb-4 sm:mb-6 text-xs font-semibold uppercase tracking-[0.2em] text-white/80 bg-white/10 backdrop-blur-sm rounded-full border border-white/20">
                                {{ $_globalSiteName ?? 'RDR Interior Aluminium' }}
                            </span>
                            <h1 class="hero-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold text-white leading-[1.15] sm:leading-[1.1] mb-4 sm:mb-5 tracking-tight">
                                {{ $slide['title'] }}
                            </h1>
                            <p class="hero-subtitle text-sm sm:text-base md:text-lg lg:text-xl text-white/70 max-w-xl mb-6 sm:mb-8 leading-relaxed">
                                {{ $slide['subtitle'] }}
                            </p>
                            <div class="hero-btn-group flex flex-wrap gap-4">
                                <a href="{{ $slide['button_url'] }}"
                                   class="group relative inline-flex items-center gap-2 px-8 py-3.5 bg-white text-aluminium-800 font-semibold rounded-lg shadow-2xl hover:bg-aluminium-50 transition-all duration-300 overflow-hidden">
                                    <span class="relative z-10">{{ $slide['button_text'] }}</span>
                                    <svg class="relative z-10 w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                                @if ($slide['button_secondary_url'] ?? false)
                                    <a href="{{ $slide['button_secondary_url'] }}"
                                       class="inline-flex items-center gap-2 px-8 py-3.5 border-2 border-white/30 text-white font-semibold rounded-lg hover:bg-white/10 hover:border-white/50 transition-all duration-300 backdrop-blur-sm">
                                        {{ $slide['button_secondary_text'] }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="swiper-pagination !bottom-8 !flex !justify-center lg:!justify-start lg:!left-[calc((100%-80rem)/2+2rem)] lg:!bottom-10 gap-2 z-20"></div>

    <div class="absolute bottom-8 right-8 z-20 hidden lg:block">
        <div class="flex items-center gap-3 text-white/50 text-sm font-mono">
            <span class="hero-current-slide">01</span>
            <span class="w-8 h-px bg-white/30"></span>
            <span class="hero-total-slides">{{ str_pad(count($slides), 2, '0', STR_PAD_LEFT) }}</span>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 hidden md:block animate-bounce">
        <svg class="w-6 h-6 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>
</div>
