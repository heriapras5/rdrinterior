@php
    $_siteSettings = $_globalSettings ?? [];
    $_favicon = $_globalFavicon ?? asset('favicon.png');
    $_logo = $_globalLogo ?? asset('images/logo.png');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $_siteSettings['site_name'] ?? 'RDR Interior Aluminium')</title>
    <meta name="description" content="@yield('meta_description', $_siteSettings['site_description'] ?? 'RDR Interior Aluminium - Solusi interior aluminium berkualitas untuk hunian dan komersial. Pintu, jendela, partisi, kitchen set, dan berbagai produk aluminium premium.')">
    <meta property="og:title" content="@yield('og_title', $_siteSettings['site_name'] ?? 'RDR Interior Aluminium')">
    <meta property="og:description" content="@yield('og_description', $_siteSettings['site_description'] ?? 'RDR Interior Aluminium - Solusi interior aluminium berkualitas untuk hunian dan komersial.')">
    <meta property="og:image" content="@yield('og_image', $_logo)">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ $_siteSettings['site_name'] ?? 'RDR Interior Aluminium' }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', $_siteSettings['site_name'] ?? 'RDR Interior Aluminium')">
    <meta name="twitter:description" content="@yield('og_description', $_siteSettings['site_description'] ?? 'RDR Interior Aluminium - Solusi interior aluminium berkualitas.')">
    <meta name="twitter:image" content="@yield('og_image', $_logo)">

    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/x-icon" href="{{ $_favicon }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
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
                        navy: {
                            50: '#f0f4ff', 100: '#dbe4ff', 200: '#bac8ff', 300: '#91a7ff',
                            400: '#748ffc', 500: '#5c7cfa', 600: '#4c6ef5', 700: '#4263eb',
                            800: '#3b5bdb', 900: '#364fc7',
                        },
                    },
                },
            },
        };
    </script>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background: #ffffff; color: #1e293b; }

        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }

        .animate-on-scroll { opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease-out, transform 0.6s ease-out; }
        .animate-on-scroll.animate-visible { opacity: 1; transform: translateY(0); }

        .animate-delay-1 { transition-delay: 0.1s; }
        .animate-delay-2 { transition-delay: 0.2s; }
        .animate-delay-3 { transition-delay: 0.3s; }
        .animate-delay-4 { transition-delay: 0.4s; }
        .animate-delay-5 { transition-delay: 0.5s; }
        .animate-delay-6 { transition-delay: 0.6s; }
        .animate-delay-7 { transition-delay: 0.7s; }
        .animate-delay-8 { transition-delay: 0.8s; }
        [x-cloak] { display: none !important; }

        .swiper-pagination-bullet { background: rgba(255,255,255,0.5) !important; opacity: 1 !important; }
        .swiper-pagination-bullet-active { background: #fff !important; }
        .hero-swiper .hero-bullet { width: 1.5rem !important; height: 0.25rem !important; border-radius: 9999px !important; background: rgba(255,255,255,0.4) !important; opacity: 1 !important; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important; }
        .hero-swiper .hero-bullet.swiper-pagination-bullet-active { width: 3.5rem !important; background: #fff !important; }
        .swiper-button-next, .swiper-button-prev { color: #fff !important; }

        .product-gallery-main .swiper-button-next,
        .product-gallery-main .swiper-button-prev {
            width: 44px; height: 44px;
            background: rgba(255,255,255,0.92);
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.18);
            color: #475569 !important;
            transition: all 0.2s ease;
        }
        .product-gallery-main .swiper-button-next:hover,
        .product-gallery-main .swiper-button-prev:hover {
            background: #fff;
            box-shadow: 0 4px 14px rgba(0,0,0,0.25);
            transform: scale(1.08);
        }
        .product-gallery-main .swiper-button-next::after,
        .product-gallery-main .swiper-button-prev::after {
            font-size: 18px;
            font-weight: 700;
        }
        .product-gallery-main .swiper-button-disabled {
            opacity: 0.35 !important;
            cursor: not-allowed;
        }

        .fancybox-caption { background: linear-gradient(0deg, rgba(0,0,0,0.7) 0%, transparent 100%) !important; padding: 20px 24px !important; }
        .fancybox-caption__body { color: #fff !important; font-family: 'Inter', system-ui, sans-serif !important; font-size: 14px !important; line-height: 1.5 !important; }
        .fancybox-button--close { background: rgba(0,0,0,0.3) !important; border-radius: 50% !important; }
        .fancybox-button--close:hover { background: rgba(71,85,105,0.8) !important; }
        .fancybox-button--arrow { background: rgba(0,0,0,0.3) !important; border-radius: 50% !important; width: 44px !important; height: 44px !important; }
        .fancybox-button--arrow:hover { background: rgba(71,85,105,0.8) !important; }
        @media (max-width: 767px) {
            .fancybox-toolbar { padding: 4px !important; }
            .fancybox-toolbar .fancybox-button { width: 36px !important; height: 36px !important; }
            .fancybox-slide--image { padding: 0 !important; }
            .fancybox-stage { padding: 0 !important; }
            .fancybox-bg { background: #1a1a1a !important; }
        }

        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 0.75rem 1.5rem; background-color: #1e293b; color: #fff;
            font-weight: 500; border-radius: 0.75rem;
            transition: all 0.2s ease;
        }
        .btn-primary:hover { background-color: #0f172a; }

        .btn-outline {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 0.75rem 1.5rem; border: 2px solid #cbd5e1; color: #475569;
            font-weight: 500; border-radius: 0.75rem; transition: all 0.3s ease;
        }
        .btn-outline:hover { background-color: #1e293b; color: #fff; border-color: #1e293b; }

        .btn-secondary {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 0.75rem 1.5rem; border: 2px solid rgba(255,255,255,0.5); color: #fff;
            font-weight: 500; border-radius: 0.75rem; transition: all 0.3s ease;
        }
        .btn-secondary:hover { background-color: #fff; color: #1e293b; border-color: #fff; }

        .btn-wa {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 0.75rem 1.5rem; background-color: #059669; color: #fff;
            font-weight: 500; border-radius: 0.75rem;
            transition: all 0.2s ease;
        }
        .btn-wa:hover { background-color: #047857; }

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
        .btn-ecommerce {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 0.625rem 1rem; color: #fff; font-weight: 500;
            border-radius: 0.75rem; font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .card {
            background: #fff; border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            overflow: hidden; border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card:hover { box-shadow: 0 10px 25px -5px rgba(0,0,0,0.08), 0 8px 10px -6px rgba(0,0,0,0.02); border-color: #94a3b8; }

        .section-title { font-size: 1.875rem; font-weight: 700; color: #0f172a; text-align: center; }
        @media (min-width: 768px) { .section-title { font-size: 2.25rem; } }

        .section-subtitle { color: #64748b; text-align: center; margin-top: 0.5rem; max-width: 36rem; margin-left: auto; margin-right: auto; }

        .text-balance { text-wrap: balance; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

        @media (max-width: 767px) {
            .product-gallery-next, .product-gallery-prev { display: none !important; }
        }
        .product-gallery-thumbs .swiper-slide-thumb-active div {
            border-color: #475569 !important;
            box-shadow: 0 0 0 2px #475569;
        }

        [data-aos] { opacity: 0; }
        .animate-fade-in { animation: fadeIn 0.6s ease-out both; }
        .animate-slide-up { animation: slideUp 0.6s ease-out both; }
        .animate-slide-left { animation: slideLeft 0.6s ease-out both; }
        .animate-slide-right { animation: slideRight 0.6s ease-out both; }
        .animate-scale-in { animation: scaleIn 0.4s ease-out both; }
        .animate-stagger > * { animation: slideUp 0.5s ease-out both; animation-delay: calc(var(--i, 0) * 80ms); }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideLeft { from { opacity: 0; transform: translateX(-30px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes slideRight { from { opacity: 0; transform: translateX(30px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }

        .animate-pulse-slow { animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }

        .gradient-hero { background: linear-gradient(to bottom right, #0f172a, #1e293b, #334155); }
    </style>

    @stack('styles')
</head>
<body class="bg-white text-aluminium-800 antialiased" x-data="{ searchOpen: false, mobileOpen: false }">

    @include('components.navbar')

    <main class="min-h-screen pt-20">
        @yield('content')
    </main>

    @include('components.footer')
    @include('components.floating-wa')
    @include('components.back-to-top')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        const anim = el.dataset.aos || 'slide-up';
                        el.classList.add('animate-' + anim);
                        el.style.opacity = '1';
                        observer.unobserve(el);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
            document.querySelectorAll('[data-aos]').forEach((el) => observer.observe(el));
            document.querySelectorAll('.animate-stagger').forEach((grid) => {
                grid.querySelectorAll(':scope > *').forEach((child, i) => {
                    child.style.setProperty('--i', i);
                });
            });
            const navbar = document.getElementById('navbar');
            const backToTop = document.getElementById('back-to-top');

            if (navbar) {
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 50) {
                        navbar.classList.add('shadow-lg', 'bg-white/95', 'backdrop-blur-md');
                    } else {
                        navbar.classList.remove('shadow-lg', 'bg-white/95', 'backdrop-blur-md');
                    }
                });
            }

            if (backToTop) {
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 300) {
                        backToTop.classList.remove('opacity-0', 'invisible');
                        backToTop.classList.add('opacity-100', 'visible');
                    } else {
                        backToTop.classList.remove('opacity-100', 'visible');
                        backToTop.classList.add('opacity-0', 'invisible');
                    }
                });
                backToTop.addEventListener('click', function () {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            if (document.querySelector('.hero-swiper')) {
                new Swiper('.hero-swiper', {
                    loop: true,
                    speed: 1200,
                    parallax: false,
                    autoplay: {
                        delay: 6000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        renderBullet: function (index, className) {
                            return '<span class="' + className + ' hero-bullet"></span>';
                        },
                    },
                    on: {
                        slideChangeTransitionEnd: function () {
                            const el = document.querySelector('.hero-current-slide');
                            if (el) el.textContent = String(this.realIndex + 1).padStart(2, '0');
                        },
                    },
                });
            }

            if (document.querySelector('.product-gallery-main')) {
                const galleryThumbs = new Swiper('.product-gallery-thumbs', {
                    spaceBetween: 12,
                    slidesPerView: 4,
                    watchSlidesProgress: true,
                    preventClicks: false,
                    preventClicksPropagation: false,
                });
                new Swiper('.product-gallery-main', {
                    spaceBetween: 10,
                    preventClicks: false,
                    preventClicksPropagation: false,
                    navigation: {
                        nextEl: '.product-gallery-next',
                        prevEl: '.product-gallery-prev',
                    },
                    thumbs: {
                        swiper: galleryThumbs,
                    },
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
