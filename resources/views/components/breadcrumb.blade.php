@props(['items' => [], 'hideHome' => false, 'dark' => false])
@php
    $tLink = $dark ? 'text-white/60 hover:text-white' : 'text-aluminium-500 hover:text-aluminium-700';
    $tSep  = $dark ? 'text-white/40' : 'text-aluminium-300';
    $tCur  = $dark ? 'text-white font-medium' : 'text-aluminium-800 font-medium';
@endphp

<nav aria-label="Breadcrumb" class="flex items-center text-sm {{ $dark ? 'text-white/60' : 'text-aluminium-500' }}">
    <ol class="flex items-center flex-wrap gap-1.5">
        @if (!$hideHome)
            <li><a href="/" class="transition-colors duration-200 {{ $dark ? 'text-white/60 hover:text-white' : 'text-aluminium-500 hover:text-aluminium-700' }}">Beranda</a></li>
            <li class="{{ $tSep }}">/</li>
        @endif
        @foreach ($items as $item)
            @if ($loop->last)
                <li class="{{ $tCur }} truncate max-w-[200px]" aria-current="page">{{ $item['label'] }}</li>
            @else
                <li><a href="{{ $item['url'] }}" class="transition-colors duration-200 truncate max-w-[200px] {{ $tLink }}">{{ $item['label'] }}</a></li>
                <li class="{{ $tSep }}">/</li>
            @endif
        @endforeach
    </ol>
</nav>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        @if (!$hideHome)
        {"@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
        @endif
        @foreach ($items as $i => $item)
        {"@type": "ListItem", "position": {{ $loop->index + ($hideHome ? 1 : 2) }}, "name": {{ json_encode($item['label']) }} @if (!$loop->last), "item": "{{ url($item['url']) }}" @endif }@if (!$loop->last),@endif
        @endforeach
    ]
}
</script>
