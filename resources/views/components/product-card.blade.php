@props(['image' => '', 'name' => '', 'slug' => '', 'category' => '', 'material' => '', 'color' => '', 'dimensions' => ''])

@php $src = $image ? (Str::startsWith($image, 'http') ? $image : asset('storage/' . $image)) : ''; @endphp

<div class="card group animate-on-scroll hover:-translate-y-1 transition-all duration-300" data-aos="slide-up">
    <a href="/produk/{{ $slug }}" class="block">
        <div class="aspect-[4/3] overflow-hidden bg-aluminium-100 relative">
            @if ($src)
                <img src="{{ $src }}" alt="{{ $name }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                <div class="w-full h-full flex items-center justify-center bg-aluminium-100 text-aluminium-300">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
            @endif
            <span class="absolute top-3 left-3 inline-block px-2.5 py-1 text-[11px] font-semibold text-aluminium-700 bg-white/90 backdrop-blur-sm rounded-lg tracking-wide uppercase shadow-sm">{{ $category }}</span>
        </div>
        <div class="p-4 md:p-5">
            <h3 class="text-sm md:text-[15px] font-bold text-aluminium-900 group-hover:text-aluminium-700 transition-colors duration-200 leading-snug">{{ $name }}</h3>
            @if ($material || $color || $dimensions)
                <div class="mt-2.5 space-y-1.5">
                    @if ($material && $color)
                        <div class="grid grid-cols-2 gap-x-2">
                            <p class="text-aluminium-500 text-xs flex items-center gap-1.5">
                                <i class="fas fa-cubes text-aluminium-400 w-3.5 text-center"></i>
                                <span class="truncate">{{ $material }}</span>
                            </p>
                            <p class="text-aluminium-500 text-xs flex items-center gap-1.5">
                                <i class="fas fa-palette text-aluminium-400 w-3.5 text-center"></i>
                                <span class="truncate">{{ $color }}</span>
                            </p>
                        </div>
                    @else
                        @if ($material)
                            <p class="text-aluminium-500 text-xs flex items-center gap-1.5">
                                <i class="fas fa-cubes text-aluminium-400 w-3.5 text-center"></i>
                                <span>{{ $material }}</span>
                            </p>
                        @endif
                        @if ($color)
                            <p class="text-aluminium-500 text-xs flex items-center gap-1.5">
                                <i class="fas fa-palette text-aluminium-400 w-3.5 text-center"></i>
                                <span>{{ $color }}</span>
                            </p>
                        @endif
                    @endif
                    @if ($dimensions)
                        <p class="text-aluminium-500 text-xs flex items-center gap-1.5">
                            <i class="fas fa-ruler-combined text-aluminium-400 w-3.5 text-center"></i>
                            <span>{{ $dimensions }}</span>
                        </p>
                    @endif
                </div>
            @endif
            <div class="mt-3 pt-3 border-t border-aluminium-100">
                <span class="inline-flex items-center text-xs font-semibold text-aluminium-600 group-hover:text-aluminium-800 transition-colors duration-200">
                    Lihat Detail
                    <svg class="w-3.5 h-3.5 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </div>
        </div>
    </a>
</div>
