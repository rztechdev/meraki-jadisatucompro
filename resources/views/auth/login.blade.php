<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — JADISATU Admin</title>
    {{-- Favicons --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}?v=2">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}?v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon-180x180.png') }}?v=2">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=2">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-[#1B2B5E] flex">

    {{-- Left panel — branding --}}
    <div class="hidden lg:flex lg:w-1/2 flex-col justify-between p-12 relative overflow-hidden bg-[#1B2B5E]">
        {{-- Ambient decorative background circles --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/4 rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-white/4 rounded-full -translate-x-1/3 translate-y-1/4"></div>
            <div class="absolute top-1/2 right-1/4 w-60 h-60 bg-[#FF6B35]/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="JADISATU" class="h-10 w-10 object-contain rounded-xl overflow-hidden shadow-sm">
            <span class="text-white font-extrabold text-xl tracking-wide">JADISATU</span>
        </div>

        <div class="relative">
            <p class="text-white/40 text-xs font-semibold uppercase tracking-widest mb-4">Admin Panel</p>
            <h1 class="text-5xl font-black text-white leading-tight mb-5">
                Kelola Event<br>Dengan Mudah
            </h1>
            <p class="text-white/60 leading-relaxed max-w-sm">
                Dashboard terpusat untuk mengelola hero slides, galeri event, layanan, testimoni, dan seluruh konten website JADISATU.
            </p>

            <div class="mt-12 flex gap-8">
                <div>
                    <div class="text-3xl font-black text-white">10+</div>
                    <div class="text-white/45 text-xs mt-1">Event Sukses</div>
                </div>
                <div>
                    <div class="text-3xl font-black text-white">5.000+</div>
                    <div class="text-white/45 text-xs mt-1">Peserta Terlibat</div>
                </div>
                <div>
                    <div class="text-3xl font-black text-white">100%</div>
                    <div class="text-white/45 text-xs mt-1">Dedikasi</div>
                </div>
            </div>
        </div>

        <div class="relative text-white/30 text-xs">
            © {{ date('Y') }} JADISATU. All rights reserved. | Developed by RZ Digital Creative
        </div>
    </div>

    {{-- Right panel — form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-16 bg-white">
        <div class="w-full max-w-md">
            {{-- Mobile logo --}}
            <div class="lg:hidden flex items-center gap-3 mb-10">
                <img src="{{ asset('images/logo.png') }}" alt="JADISATU" class="h-9 w-9 object-contain rounded-xl overflow-hidden shadow-sm">
                <span class="text-[#1B2B5E] font-extrabold text-xl tracking-wide">JADISATU</span>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-black text-[#1B2B5E]">Selamat Datang</h2>
                <p class="text-gray-400 mt-2 text-sm">Masuk ke panel admin JADISATU</p>
            </div>

            @if (session('status'))
                <div class="mb-5 rounded-xl bg-green-50 border border-green-100 px-4 py-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 rounded-xl bg-red-50 border border-red-100 px-4 py-3 text-sm text-red-600">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:outline-none focus:border-[#1B2B5E] focus:ring-2 focus:ring-[#1B2B5E]/8 text-sm text-gray-800 placeholder-gray-300 transition-all"
                           placeholder="info@jadisatukreatif.com">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:outline-none focus:border-[#1B2B5E] focus:ring-2 focus:ring-[#1B2B5E]/8 text-sm text-gray-800 placeholder-gray-300 transition-all"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="remember" id="remember_me"
                               class="w-4 h-4 rounded border-gray-300 text-[#1B2B5E] focus:ring-[#1B2B5E]/20">
                        <span class="text-sm text-gray-500">Ingat saya</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-[#1B2B5E] hover:bg-[#243d7a] text-white font-bold py-4 rounded-xl transition-all text-sm hover:shadow-lg hover:shadow-[#1B2B5E]/20 mt-2">
                    Masuk ke Admin Panel
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-[#1B2B5E] text-xs transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Website
                </a>
            </div>
        </div>
    </div>

</body>
</html>
