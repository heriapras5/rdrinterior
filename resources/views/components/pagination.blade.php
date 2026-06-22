@props(['paginator'])

@if ($paginator->hasPages())
    <div class="flex items-center justify-center gap-2 mt-8">
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-sm text-aluminium-300 bg-aluminium-50 rounded-lg cursor-not-allowed">Sebelumnya</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-sm text-aluminium-600 bg-white border border-aluminium-200 rounded-lg hover:bg-aluminium-50 hover:text-aluminium-800 transition-all duration-200">Sebelumnya</a>
        @endif

        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($page == $paginator->currentPage())
                <span class="px-3.5 py-2 text-sm font-medium text-white bg-aluminium-800 rounded-lg">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="px-3.5 py-2 text-sm text-aluminium-600 bg-white border border-aluminium-200 rounded-lg hover:bg-aluminium-50 hover:text-aluminium-800 transition-all duration-200">{{ $page }}</a>
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-sm text-aluminium-600 bg-white border border-aluminium-200 rounded-lg hover:bg-aluminium-50 hover:text-aluminium-800 transition-all duration-200">Selanjutnya</a>
        @else
            <span class="px-4 py-2 text-sm text-aluminium-300 bg-aluminium-50 rounded-lg cursor-not-allowed">Selanjutnya</span>
        @endif
    </div>
@endif
