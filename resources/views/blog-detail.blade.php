@extends('layouts.app')

@php
    $_blogImg = $blog->thumbnail ? (Str::startsWith($blog->thumbnail, 'http') ? $blog->thumbnail : asset('storage/' . $blog->thumbnail)) : '';
@endphp

@section('title', $blog->title . ' - ' . ($_globalSiteName ?? 'RDR Interior Aluminium'))
@section('meta_description', strip_tags($blog->excerpt ?? Str::limit($blog->content ?? '', 160)))
@section('og_image', $_blogImg)
@section('og_type', 'article')

@section('content')
    <section class="py-16 gradient-hero text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-in">
            <x-breadcrumb dark :items="[['label' => 'Blog', 'url' => '/blog'], ['label' => $blog->title]]" />
            <h1 class="text-4xl md:text-5xl font-bold mt-6">{{ $blog->title }}</h1>
        </div>
    </section>

    <article class="py-14 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <header class="mb-10" data-aos="fade-in">
                <div class="flex items-center gap-3 text-sm text-aluminium-500 mb-4">
                    @if ($blog->category)
                        <span class="px-3 py-1 bg-aluminium-100 text-aluminium-600 rounded-lg font-medium">{{ $blog->category->name }}</span>
                    @endif
                    <span>{{ $blog->created_at->format('d F Y') }}</span>
                    @if ($blog->author)
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $blog->author }}
                        </span>
                    @endif
                </div>
                @if ($blog->excerpt)
                    <p class="text-lg text-aluminium-500 mt-4 leading-relaxed">{{ $blog->excerpt }}</p>
                @endif
            </header>

            @if ($_blogImg)
                <div class="rounded-xl overflow-hidden mb-10 shadow-sm" data-aos="fade-in">
                    <img src="{{ $_blogImg }}" alt="{{ $blog->title }}" class="w-full aspect-[16/9] object-cover">
                </div>
            @endif

            <div class="prose prose-aluminium max-w-none prose-lg" data-aos="fade-in">
                {!! $blog->content !!}
            </div>

            <div class="mt-12 pt-8 border-t border-aluminium-200" data-aos="fade-in">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <span class="text-sm font-medium text-aluminium-500">Bagikan artikel ini:</span>
                    <div class="flex items-center gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke Facebook" class="w-10 h-10 bg-aluminium-100 rounded-lg flex items-center justify-center text-aluminium-600 hover:bg-aluminium-200 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke Twitter" class="w-10 h-10 bg-aluminium-100 rounded-lg flex items-center justify-center text-aluminium-600 hover:bg-aluminium-200 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($blog->title) }}" target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke LinkedIn" class="w-10 h-10 bg-aluminium-100 rounded-lg flex items-center justify-center text-aluminium-600 hover:bg-aluminium-200 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($blog->title . ' - ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke WhatsApp" class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600 hover:bg-emerald-200 transition-colors duration-200">
                            <i class="fab fa-whatsapp text-lg"></i>
                        </a>
                    </div>
                </div>
            </div>

            @if ($relatedBlogs->count() > 0)
                <section class="mt-14 pt-10 border-t border-aluminium-200" data-aos="slide-up">
                    <h2 class="text-2xl font-bold text-aluminium-900 mb-8">Artikel Terkait</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($relatedBlogs as $rb)
                            <x-blog-card
                                :thumbnail="$rb->thumbnail"
                                :title="$rb->title"
                                :slug="$rb->slug"
                                :category="$rb->category?->name ?? ''"
                                :date="$rb->created_at->format('d M Y')"
                                :excerpt="$rb->excerpt ?? strip_tags(Str::limit($rb->content, 120))"
                            />
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </article>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BlogPosting",
        "headline": {!! json_encode($blog->title) !!},
        "description": {!! json_encode(strip_tags($blog->excerpt ?? Str::limit($blog->content ?? '', 160))) !!},
        "image": {!! json_encode($_blogImg) !!},
        "datePublished": "{{ $blog->created_at->toIso8601String() }}",
        "author": {
            "@type": "Person",
            "name": {{ json_encode($blog->author ?? $_globalSiteName) }}
        },
        "publisher": {
            "@type": "Organization",
            "name": {{ json_encode($_globalSiteName ?? 'RDR Interior Aluminium') }}
        }
    }
    </script>
@endsection
