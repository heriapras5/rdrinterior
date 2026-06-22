@props(['thumbnail' => '', 'title' => '', 'slug' => '', 'category' => '', 'date' => '', 'excerpt' => ''])

@php $src = $thumbnail ? (Str::startsWith($thumbnail, 'http') ? $thumbnail : asset('storage/' . $thumbnail)) : ''; @endphp

<a href="/blog/{{ $slug }}" class="card group animate-on-scroll block hover:-translate-y-1 transition-all duration-300">
    <div class="aspect-[4/3] overflow-hidden bg-aluminium-100">
        @if ($src)
            <img src="{{ $src }}" alt="{{ $title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full flex items-center justify-center bg-aluminium-100 text-aluminium-300">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
        @endif
    </div>
    <div class="p-5">
        <div class="flex items-center gap-2.5 text-xs text-aluminium-500 mb-2.5">
            @if ($category)
                <span class="px-2 py-0.5 bg-aluminium-100 text-aluminium-600 rounded-md font-medium">{{ $category }}</span>
            @endif
            @if ($date)
                <span>{{ $date }}</span>
            @endif
        </div>
        <h3 class="font-bold text-aluminium-900 group-hover:text-aluminium-700 transition-colors duration-200 leading-snug line-clamp-2">{{ $title }}</h3>
        @if ($excerpt)
            <p class="text-aluminium-500 text-sm mt-2 line-clamp-2 leading-relaxed">{{ $excerpt }}</p>
        @endif
        <span class="inline-flex items-center text-xs font-semibold text-aluminium-600 group-hover:text-aluminium-800 mt-3 transition-colors duration-200">
            Baca Selengkapnya
            <svg class="w-3.5 h-3.5 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </span>
    </div>
</a>
