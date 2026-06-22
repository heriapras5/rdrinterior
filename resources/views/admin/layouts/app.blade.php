@php
    $_admFavicon = $_globalFavicon ?? asset('favicon.png');
    $_admLogoUrl = $_globalLogo;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - ' . ($_globalSiteName ?? 'RDR Interior Aluminium'))</title>
    <link rel="icon" type="image/x-icon" href="{{ $_admFavicon }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        aluminium: {
                            50: '#f8fafc', 100: '#f1f5f9', 200: '#e2e8f0', 300: '#cbd5e1',
                            400: '#94a3b8', 500: '#64748b', 600: '#475569', 700: '#334155',
                            800: '#1e293b', 900: '#0f172a',
                        },
                    },
                },
            },
        };
    </script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }

        .sidebar-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            color: #cbd5e1;
        }
        .sidebar-link:hover {
            color: #ffffff;
            background-color: rgba(51, 65, 85, 0.4);
        }
        .sidebar-link i {
            width: 1.25rem;
            text-align: center;
            font-size: 15px;
        }
        .sidebar-link.active {
            color: #ffffff;
            background-color: rgba(51, 65, 85, 0.6);
        }
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 1.25rem;
            background: #ffffff;
            border-radius: 0 9999px 9999px 0;
        }

        .sidebar-section {
            position: relative;
            padding: 1.25rem 1rem 0.375rem;
        }
        .sidebar-section::before {
            content: '';
            position: absolute;
            top: 0.75rem;
            left: 1rem;
            right: 1rem;
            height: 1px;
            background: rgba(51, 65, 85, 0.4);
        }
        .sidebar-section span {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #94a3b8;
        }

        .btn-admin-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            background-color: #1e293b;
            color: #ffffff;
            font-weight: 500;
            border-radius: 0.75rem;
            transition: background-color 0.2s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        .btn-admin-primary:hover { background-color: #0f172a; }

        .btn-admin-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            background-color: #f1f5f9;
            color: #334155;
            font-weight: 500;
            border-radius: 0.75rem;
            transition: background-color 0.2s ease;
        }
        .btn-admin-secondary:hover { background-color: #e2e8f0; }

        .btn-admin-danger {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            background-color: #ef4444;
            color: #ffffff;
            font-weight: 500;
            border-radius: 0.75rem;
            transition: background-color 0.2s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        .btn-admin-danger:hover { background-color: #dc2626; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }

        .logo-3d {
            border-radius: 50%;
            object-fit: cover;
            box-shadow:
                0 4px 6px -1px rgba(0,0,0,0.15),
                0 2px 4px -2px rgba(0,0,0,0.1),
                inset 0 3px 6px rgba(255,255,255,0.25),
                inset 0 -3px 6px rgba(0,0,0,0.15);
            border: 2px solid rgba(255,255,255,0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .logo-3d:hover {
            transform: scale(1.06);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-aluminium-50 antialiased" x-data="{ sidebarOpen: true, imgPopup: null }">

    <div class="flex h-screen overflow-hidden">

        {{-- Backdrop (mobile only) --}}
        <div x-show="sidebarOpen"
             x-transition:enter="transition-opacity duration-300"
             x-transition:leave="transition-opacity duration-200"
             class="fixed inset-0 z-40 bg-black/50 lg:hidden"
             @click="sidebarOpen = false"></div>

        {{-- Sidebar --}}
        <aside x-show="sidebarOpen"
               x-transition:enter="transform transition ease-out duration-300"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transform transition ease-in duration-200"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full"
               class="fixed lg:relative inset-y-0 left-0 z-50 w-64 bg-aluminium-800 text-white flex flex-col shrink-0">

            <div class="flex items-center justify-between gap-3 px-5 h-16 border-b border-aluminium-700/50 shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 min-w-0 hover:opacity-80 transition-opacity">
                    @if ($_admLogoUrl)
                        <img src="{{ $_admLogoUrl }}" alt="{{ $_globalSiteName }}" class="w-11 h-11 logo-3d shrink-0">
                    @else
                        <div class="w-11 h-11 bg-gradient-to-br from-aluminium-400 to-aluminium-700 rounded-full flex items-center justify-center text-white font-bold text-lg shrink-0 shadow-md">R</div>
                    @endif
                    <span class="text-sm font-bold tracking-wide truncate">{{ $_globalSiteName }}</span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-aluminium-400 hover:text-white transition-colors p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto scrollbar-hide px-3 py-4 space-y-0.5">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> Dashboard
                </a>

                <div class="mx-3 my-2 h-px bg-aluminium-700/20"></div>

                <div class="sidebar-section"><span>Konten</span></div>

                <a href="{{ route('admin.slides.index') }}" class="sidebar-link {{ request()->routeIs('admin.slides.*') ? 'active' : '' }}">
                    <i class="fas fa-images"></i> Slider
                </a>
                <a href="{{ route('admin.product-categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.product-categories.*') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i> Kategori Produk
                </a>
                <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i> Produk
                </a>

                <div class="sidebar-section"><span>Lainnya</span></div>

                <a href="{{ route('admin.messages.index') }}" class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> Pesan Masuk
                </a>
                <a href="{{ route('admin.about-settings.edit') }}" class="sidebar-link {{ request()->routeIs('admin.about-settings.*') ? 'active' : '' }}">
                    <i class="fas fa-info-circle"></i> Tentang
                </a>
                <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-w-0 transition-all duration-300">
            <header class="h-16 bg-white border-b border-aluminium-200 flex items-center justify-between px-4 lg:px-6 shrink-0">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-aluminium-500 hover:text-aluminium-700 transition-colors p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="text-lg font-semibold text-aluminium-800">@yield('header')</h1>
                </div>
                <div class="flex items-center gap-3">
                    <a href="/" target="_blank" class="text-aluminium-500 hover:text-aluminium-700 transition-colors text-sm" title="Lihat Website">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 text-aluminium-600 hover:text-aluminium-800 transition-colors">
                            @php $u = auth()->user(); @endphp
                            @if ($u->avatar_url)
                                <img src="{{ $u->avatar_url }}" alt="{{ $u->name }}" class="w-9 h-9 logo-3d">
                            @else
                                <div class="w-9 h-9 bg-gradient-to-br from-aluminium-200 to-aluminium-400 rounded-full flex items-center justify-center text-sm font-medium text-aluminium-700 shadow-md">
                                    {{ substr($u->name, 0, 1) }}
                                </div>
                            @endif
                            <span class="text-sm font-medium hidden md:block">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="profileOpen" x-cloak @click.away="profileOpen = false" class="absolute right-0 top-full mt-2 w-52 bg-white rounded-xl shadow-lg border border-aluminium-100 py-2 z-50">
                            <div class="px-4 py-2 border-b border-aluminium-100">
                                <p class="text-sm font-medium text-aluminium-800 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-aluminium-500 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ route('admin.admins.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-aluminium-600 hover:bg-aluminium-50 transition-colors">
                                <i class="fas fa-users-cog w-4 text-center"></i> Kelola Admin
                            </a>
                            <a href="{{ route('admin.admins.edit', auth()->user()) }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-aluminium-600 hover:bg-aluminium-50 transition-colors">
                                <i class="fas fa-user-edit w-4 text-center"></i> Edit Profil
                            </a>
                            <hr class="border-aluminium-100 my-1">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors">
                                    <i class="fas fa-sign-out-alt w-4 text-center"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-xl">
                        <i class="fas fa-check-circle text-emerald-500"></i>
                        <span class="flex-1 text-sm font-medium">{{ session('success') }}</span>
                        <button @click="show = false" class="text-emerald-400 hover:text-emerald-600"><i class="fas fa-times"></i></button>
                    </div>
                @endif
                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                        <span class="flex-1 text-sm font-medium">{{ session('error') }}</span>
                        <button @click="show = false" class="text-red-400 hover:text-red-600"><i class="fas fa-times"></i></button>
                    </div>
                @endif
                @yield('content')
            </main>

            <footer class="px-6 py-3 border-t border-aluminium-200 text-center text-xs text-aluminium-400">
                &copy; {{ date('Y') }} {{ $_globalSiteName }}. All rights reserved.
            </footer>
        </div>
    </div>

    <div x-show="imgPopup" x-cloak class="fixed inset-0 z-[100] bg-black/80 flex items-center justify-center p-4" @click.away="imgPopup = null" @keydown.escape.window="imgPopup = null">
        <button @click="imgPopup = null" class="absolute top-4 right-4 text-white/70 hover:text-white text-2xl"><i class="fas fa-times"></i></button>
        <img :src="imgPopup" class="max-w-full max-h-[85vh] rounded-xl shadow-2xl">
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function loadSummernote() {
            if (typeof $ !== 'undefined' && typeof $.fn !== 'undefined' && typeof $.fn.summernote !== 'undefined') { return; }
            var ss = document.createElement('script'); ss.src = 'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js'; ss.onload = function() { $(document).trigger('summernoteLoaded'); }; document.head.appendChild(ss);
            var sc = document.createElement('link'); sc.rel = 'stylesheet'; sc.href = 'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css'; document.head.appendChild(sc);
        }
        document.addEventListener('alpine:init', () => {
            Alpine.store('confirm', {
                show(title, message, callback) {
                    Swal.fire({
                        title: title || 'Konfirmasi',
                        text: message || 'Apakah Anda yakin?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#1e293b',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal',
                    }).then((r) => { if (r.isConfirmed) callback(); });
                }
            });
        });
        function confirmDelete(formId) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then((r) => { if (r.isConfirmed) document.getElementById(formId).submit(); });
        }
    </script>
    @stack('scripts')
</body>
</html>
