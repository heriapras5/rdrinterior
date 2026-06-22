@php
    $_footerSettings = $_globalSettings;
    $_footerLogoUrl = $_globalLogo;
    $_footerWa = $_footerSettings['whatsapp_number'] ?? '';
    $_footerFb = $_footerSettings['facebook_url'] ?? '';
    $_footerIg = $_footerSettings['instagram_url'] ?? '';
    $_footerTt = $_footerSettings['tiktok_url'] ?? '';
    $_footerEmail = $_footerSettings['email'] ?? '';
@endphp
<footer class="bg-aluminium-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <div class="lg:col-span-1">
                <div class="flex items-center space-x-2.5 mb-4">
                    @if ($_footerLogoUrl)
                        <img src="{{ $_footerLogoUrl }}" alt="{{ $_globalSiteName }}" class="w-11 h-11 logo-3d">
                    @else
                        <div class="w-11 h-11 bg-gradient-to-br from-aluminium-400 to-aluminium-700 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md">R</div>
                    @endif
                    <span class="text-xl font-bold text-white">{{ $_globalSiteName }}</span>
                </div>
                <p class="text-aluminium-400 leading-relaxed text-sm">
                    {{ $_footerSettings['footer_description'] ?? 'Solusi interior aluminium berkualitas untuk hunian dan komersial. Pintu, jendela, partisi, kitchen set, dan berbagai produk aluminium premium.' }}
                </p>
                <p class="text-sm text-aluminium-300 font-medium mt-4">{{ $_footerSettings['company_name'] ?? 'RDR Interior Aluminium' }}</p>
                <div class="flex space-x-3 mt-6">
                    @if ($_footerFb)
                    <a href="{{ $_footerFb }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="w-9 h-9 bg-aluminium-800 rounded-full flex items-center justify-center text-aluminium-400 hover:bg-aluminium-700 hover:text-white transition-all duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    @endif
                    @if ($_footerIg)
                    <a href="{{ $_footerIg }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="w-9 h-9 bg-aluminium-800 rounded-full flex items-center justify-center text-aluminium-400 hover:bg-aluminium-700 hover:text-white transition-all duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if ($_footerTt)
                    <a href="{{ $_footerTt }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok" class="w-9 h-9 bg-aluminium-800 rounded-full flex items-center justify-center text-aluminium-400 hover:bg-aluminium-700 hover:text-white transition-all duration-300">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    @endif
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-aluminium-400 mb-5">Tautan Cepat</h3>
                <ul class="space-y-3">
                    <li><a href="/" class="text-aluminium-300 hover:text-white transition-colors duration-200 text-sm">Beranda</a></li>
                    <li><a href="/produk" class="text-aluminium-300 hover:text-white transition-colors duration-200 text-sm">Semua Produk</a></li>
                    <li><a href="/kategori" class="text-aluminium-300 hover:text-white transition-colors duration-200 text-sm">Kategori</a></li>
                    <li><a href="/blog" class="text-aluminium-300 hover:text-white transition-colors duration-200 text-sm">Blog</a></li>
                    <li><a href="/tentang" class="text-aluminium-300 hover:text-white transition-colors duration-200 text-sm">Tentang Kami</a></li>
                    <li><a href="/kontak" class="text-aluminium-300 hover:text-white transition-colors duration-200 text-sm">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-aluminium-400 mb-5">Produk</h3>
                <ul class="space-y-3">
                    @php $footerCategories = ($_globalNavCategories ?? collect())->take(5); @endphp
                    @foreach ($footerCategories as $fc)
                        <li><a href="/kategori/{{ $fc['slug'] ?? $fc->slug }}" class="text-aluminium-300 hover:text-white transition-colors duration-200 text-sm">{{ $fc['name'] ?? $fc->name }}</a></li>
                    @endforeach
                    <li><a href="/produk" class="text-aluminium-300 hover:text-white transition-colors duration-200 text-sm">Lihat Semua &rarr;</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-aluminium-400 mb-5">Hubungi Kami</h3>
                <ul class="space-y-4 text-aluminium-300">
                    <li class="flex items-start space-x-3">
                        <svg class="w-5 h-5 mt-0.5 text-aluminium-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-sm">{{ $_footerSettings['address'] ?? 'Alamat perusahaan' }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fab fa-whatsapp text-lg text-aluminium-400 shrink-0"></i>
                        <a href="https://wa.me/{{ $_footerWa }}" target="_blank" rel="noopener noreferrer" class="text-sm hover:text-white transition-colors duration-200">{{ $_footerWa }}</a>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-aluminium-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span class="text-sm">{{ $_footerSettings['email'] ?? 'email@perusahaan.com' }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-aluminium-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @php $_footerHours = explode("\n", $_footerSettings['operational_hours'] ?? "Senin - Sabtu: 08:00 - 17:00"); @endphp
                        <div class="text-sm">
                            @foreach ($_footerHours as $_h)
                                @if (trim($_h))<p>{{ trim($_h) }}</p>@endif
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-aluminium-800 mt-12 pt-8 text-center text-aluminium-500 text-sm">
            <p>&copy; {{ date('Y') }} {{ $_globalSiteName }}. All rights reserved.</p>
        </div>
    </div>
</footer>
