<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - {{ $_globalSiteName ?? 'Admin RDR Interior Aluminium' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ $_globalFavicon ?? asset('favicon.png') }}">
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
                        }
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="min-h-screen bg-gradient-to-br from-aluminium-900 to-aluminium-800 flex items-center justify-center px-4 py-6 font-sans antialiased">

    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8">

            @php $_loginLogoSrc = $_globalLogo; @endphp
            @php $_loginSiteName = $_globalSiteName; @endphp
            {{-- Logo --}}
            <div class="text-center mb-6">
                @if ($_loginLogoSrc)
                    <img src="{{ $_loginLogoSrc }}" alt="{{ $_loginSiteName }}" class="w-14 h-14 sm:w-16 sm:h-16 logo-3d mx-auto mb-3">
                    <h2 class="text-xl sm:text-2xl font-bold text-aluminium-800">{{ $_loginSiteName }} Admin</h2>
                @else
                    <div class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-gradient-to-br from-aluminium-400 to-aluminium-700 text-white text-2xl sm:text-3xl mb-3 shadow-md">
                        <i class="fas fa-store"></i>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold text-aluminium-800">{{ $_loginSiteName }} Admin</h2>
                @endif
                <p class="text-sm text-aluminium-400 mt-1">Silakan login untuk melanjutkan</p>
            </div>

            {{-- Error Messages --}}
            @if($errors->any())
                <div class="mb-4 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('status'))
                <div class="mb-4 flex items-center gap-3 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-xl text-sm">
                    <i class="fas fa-info-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-aluminium-700 mb-1">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-aluminium-400">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full pl-10 pr-4 py-2.5 border border-aluminium-300 rounded-xl text-sm focus:ring-2 focus:ring-aluminium-500 focus:border-aluminium-500 outline-none transition-colors"
                               placeholder="admin@jif.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-aluminium-700 mb-1">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-aluminium-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input id="password" type="password" name="password" required
                               class="w-full pl-10 pr-4 py-2.5 border border-aluminium-300 rounded-xl text-sm focus:ring-2 focus:ring-aluminium-500 focus:border-aluminium-500 outline-none transition-colors"
                               placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-aluminium-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-aluminium-300 text-aluminium-600 focus:ring-aluminium-500">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-aluminium-800 hover:bg-aluminium-900 text-white font-semibold py-2.5 px-4 rounded-xl transition-colors duration-200 shadow-sm">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>
            </form>

            {{-- Register Link --}}
            <div class="text-center mt-5">
                <p class="text-sm text-aluminium-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-aluminium-700 hover:text-aluminium-800 font-semibold">Daftar</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
