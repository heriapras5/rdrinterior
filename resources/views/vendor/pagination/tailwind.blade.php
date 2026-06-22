@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-between">
        <div class="flex-1 flex items-center gap-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-aluminium-300 text-sm cursor-default">
                    <i class="fas fa-chevron-left text-xs"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-aluminium-600 hover:bg-aluminium-100 transition-colors text-sm">
                    <i class="fas fa-chevron-left text-xs"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-aluminium-400 text-sm cursor-default">...</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-aluminium-800 text-white text-sm font-medium shadow-sm">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-aluminium-600 hover:bg-aluminium-100 transition-colors text-sm">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-aluminium-600 hover:bg-aluminium-100 transition-colors text-sm">
                    <i class="fas fa-chevron-right text-xs"></i>
                </a>
            @else
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-aluminium-300 text-sm cursor-default">
                    <i class="fas fa-chevron-right text-xs"></i>
                </span>
            @endif
        </div>

        <div class="hidden sm:block text-sm text-aluminium-400">
            Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}
        </div>
    </nav>
@endif
