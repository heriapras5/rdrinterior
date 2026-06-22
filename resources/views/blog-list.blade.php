@extends('layouts.app')

@section('title', 'Blog - ' . ($_globalSiteName ?? 'RDR Interior Aluminium'))
@section('meta_description', 'Artikel dan informasi terbaru seputar interior aluminium, tips desain, dan inspirasi hunian dari RDR Interior Aluminium.')

@section('content')
    <section class="py-16 gradient-hero text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-in">
            <h1 class="text-4xl md:text-5xl font-bold">Blog</h1>
            <p class="text-white/70 mt-3 max-w-2xl mx-auto">Artikel dan informasi terbaru seputar interior aluminium, tips desain, dan inspirasi hunian</p>
        </div>
    </section>

    <section class="py-14 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center gap-2 mb-10" data-aos="fade-in">
                <a href="/blog" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ !request('category') ? 'bg-aluminium-800 text-white' : 'bg-aluminium-100 text-aluminium-600 hover:bg-aluminium-200' }}">Semua</a>
                @foreach ($categories as $cat)
                    <a href="/blog?category={{ $cat->slug }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request('category') == $cat->slug ? 'bg-aluminium-800 text-white' : 'bg-aluminium-100 text-aluminium-600 hover:bg-aluminium-200' }}">{{ $cat->name }}</a>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    @if ($blogs->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 animate-stagger">
                            @foreach ($blogs as $blog)
                                <x-blog-card
                                    :thumbnail="$blog->thumbnail"
                                    :title="$blog->title"
                                    :slug="$blog->slug"
                                    :category="$blog->category?->name ?? ''"
                                    :date="$blog->created_at->format('d M Y')"
                                    :excerpt="$blog->excerpt ?? strip_tags(Str::limit($blog->content, 150))"
                                />
                            @endforeach
                        </div>
                        <x-pagination :paginator="$blogs" />
                    @else
                        <div class="text-center py-20 text-aluminium-400">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            <p class="text-lg font-medium">Belum ada artikel</p>
                            <p class="text-sm mt-1">Artikel akan segera tersedia.</p>
                        </div>
                    @endif
                </div>

                <aside class="space-y-8">
                    <div class="bg-aluminium-50 rounded-xl p-6 border border-aluminium-200">
                        <h3 class="font-bold text-aluminium-900 mb-4">Kategori</h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="/blog" class="flex items-center justify-between text-aluminium-600 hover:text-aluminium-800 transition-colors duration-200 text-sm">
                                    <span>Semua Artikel</span>
                                    <span class="bg-aluminium-200 text-aluminium-600 px-2 py-0.5 rounded text-xs">{{ $categories->sum(fn($c) => $c->blogs_count ?? 0) }}</span>
                                </a>
                            </li>
                            @foreach ($categories as $cat)
                                <li>
                                    <a href="/blog?category={{ $cat->slug }}" class="flex items-center justify-between text-aluminium-600 hover:text-aluminium-800 transition-colors duration-200 text-sm">
                                        <span>{{ $cat->name }}</span>
                                        <span class="bg-aluminium-200 text-aluminium-600 px-2 py-0.5 rounded text-xs">{{ $cat->blogs_count ?? 0 }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @if ($recentBlogs->count() > 0)
                        <div class="bg-aluminium-50 rounded-xl p-6 border border-aluminium-200">
                            <h3 class="font-bold text-aluminium-900 mb-4">Artikel Terbaru</h3>
                            <ul class="space-y-4">
                                @foreach ($recentBlogs as $rb)
                                    <li>
                                        <a href="/blog/{{ $rb->slug }}" class="group">
                                            <p class="text-sm font-medium text-aluminium-700 group-hover:text-aluminium-800 transition-colors duration-200 line-clamp-2">{{ $rb->title }}</p>
                                            <p class="text-xs text-aluminium-500 mt-1">{{ $rb->created_at->format('d M Y') }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>
@endsection
