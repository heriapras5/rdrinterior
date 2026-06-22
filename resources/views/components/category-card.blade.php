@props(['image' => '', 'name' => '', 'slug' => '', 'description' => ''])

@php $src = $image ? (Str::startsWith($image, 'http') ? $image : asset('storage/' . $image)) : 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=600&q=80'; @endphp

<a href="/kategori/{{ $slug }}" class="card group animate-on-scroll block overflow-hidden relative aspect-[4/3] hover:-translate-y-1 transition-all duration-300">
    <img src="{{ $src }}" alt="{{ $name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
    <div class="absolute inset-0 bg-gradient-to-t from-aluminium-900/95 via-aluminium-900/40 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 p-5">
        <h3 class="text-lg font-bold text-white" style="text-shadow:0 2px 8px rgba(0,0,0,0.5)">{{ $name }}</h3>
        @if ($description)
            <p class="text-white/70 text-sm mt-1 line-clamp-2">{{ $description }}</p>
        @endif
        <span class="inline-flex items-center text-xs font-semibold text-white/80 group-hover:text-white mt-2 transition-colors duration-200">
            Lihat Produk
            <svg class="w-3.5 h-3.5 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </span>
    </div>
</a>
