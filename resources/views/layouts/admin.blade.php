<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'JADISATU')</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 antialiased font-normal text-gray-700 text-xs" x-data="{ sidebarOpen: false }">

<div class="flex h-screen overflow-hidden">
    {{-- Sidebar --}}
    <aside class="fixed inset-y-0 left-0 z-50 w-56 bg-[#1B2B5E] transform transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-0 flex flex-col justify-between"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div>
            <div class="flex items-center justify-between h-13 px-4 border-b border-white/10">
                <div class="flex items-center gap-2.5">
                    <img src="{{ asset('images/logo.png') }}" alt="JADISATU" class="h-7 w-7 object-contain rounded-lg overflow-hidden shadow-sm">
                    <span class="text-white font-medium text-sm tracking-wider uppercase">JADISATU</span>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden text-white/60 hover:text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="mt-3 px-2.5 space-y-0.5">
                @php
                    $unreadMessagesCount = \App\Models\ContactMessage::where('is_read', false)->count();
                    $navItems = [
                        ['route' => 'admin.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Dashboard'],
                        ['route' => 'admin.messages.index', 'prefix' => 'admin.messages.', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'Pesan Masuk', 'badge' => $unreadMessagesCount],
                        ['route' => 'admin.hero.index', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'label' => 'Hero Slider'],
                        ['route' => 'admin.gallery.index', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'label' => 'Event Gallery'],
                        ['route' => 'admin.services.index', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'label' => 'Layanan'],
                        ['route' => 'admin.stats.index', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'label' => 'Statistik'],
                        ['route' => 'admin.testimonials.index', 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'label' => 'Testimoni'],
                        ['route' => 'admin.team.index', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'label' => 'Tim'],
                        ['route' => 'admin.settings.index', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', 'label' => 'Pengaturan'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php $active = request()->routeIs($item['route']) || (isset($item['prefix']) && request()->routeIs($item['prefix'].'*')); @endphp
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center justify-between px-3 py-2 rounded-lg text-xs transition-all
                              {{ $active ? 'bg-white/15 text-white font-medium' : 'text-white/65 hover:bg-white/10 hover:text-white font-normal' }}">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 flex-shrink-0 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/>
                            </svg>
                            <span>{{ $item['label'] }}</span>
                        </div>
                        @if(!empty($item['badge']) && $item['badge'] > 0)
                            <span class="px-1.5 py-0.5 text-[10px] font-medium bg-[#FF6B35] text-white rounded-full">
                                {{ $item['badge'] }}
                            </span>
                        @endif
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="p-3 border-t border-white/10">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-white/60 hover:text-white text-xs transition-colors mb-2 px-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Lihat Website
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-white/60 hover:text-red-400 text-xs transition-colors w-full px-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Overlay --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/50 lg:hidden"></div>

    {{-- Main --}}
    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="h-13 bg-white border-b border-gray-200 flex items-center justify-between px-5 flex-shrink-0">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-xs uppercase tracking-wider font-medium text-gray-700">@yield('title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-2.5">
                <div class="text-xs text-gray-500 font-normal">{{ auth()->user()?->name ?? 'Admin' }}</div>
                <div class="w-7 h-7 rounded-full bg-[#1B2B5E] flex items-center justify-center text-white text-xs font-normal">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-5">
            @yield('content')
        </main>
    </div>
</div>

{{-- SweetAlert2 Notifications & Delete Confirmation --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Success Notification
    @if(session('success') || session('status'))
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'BERHASIL',
                text: @json(session('success') ?? session('status')),
                icon: 'success',
                iconColor: '#FF6B35',
                confirmButtonText: 'OKE, MENGERTI',
                confirmButtonColor: '#1B2B5E',
                background: '#ffffff',
                color: '#1B2B5E',
                customClass: {
                    popup: 'rounded-none shadow-2xl border border-gray-200',
                    confirmButton: 'rounded-none px-6 py-2.5 font-normal text-xs tracking-wider uppercase shadow-none',
                    icon: 'rounded-none'
                }
            });
        }
    @endif

    // 2. Failed / Error Notification
    @if(session('error') || (isset($errors) && $errors->any()))
        if (typeof Swal !== 'undefined') {
            @php
                $errorMsg = session('error') ?? ($errors->any() ? implode("\n", $errors->all()) : 'Terjadi kesalahan pada sistem.');
            @endphp
            Swal.fire({
                title: 'GAGAL',
                text: @json($errorMsg),
                icon: 'error',
                iconColor: '#ef4444',
                confirmButtonText: 'TUTUP',
                confirmButtonColor: '#1B2B5E',
                background: '#ffffff',
                color: '#1B2B5E',
                customClass: {
                    popup: 'rounded-none shadow-2xl border border-gray-200',
                    confirmButton: 'rounded-none px-6 py-2.5 font-normal text-xs tracking-wider uppercase shadow-none',
                    icon: 'rounded-none'
                }
            });
        }
    @endif

    // 3. Delete Confirmation Modal (Catch both submit and button click)
    function handleConfirmDelete(form, e) {
        if (!form || form.dataset.confirmed === "true") return;
        const methodInput = form.querySelector('input[name="_method"]');
        const isDelete = (methodInput && methodInput.value.toUpperCase() === 'DELETE') || form.dataset.confirm === 'delete' || form.classList.contains('delete-form');
        
        if (isDelete) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'KONFIRMASI HAPUS',
                    text: 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.',
                    icon: 'warning',
                    iconColor: '#dc2626',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#1B2B5E',
                    confirmButtonText: 'YA, HAPUS',
                    cancelButtonText: 'BATAL',
                    background: '#ffffff',
                    color: '#1B2B5E',
                    customClass: {
                        popup: 'rounded-none shadow-2xl border border-gray-200',
                        confirmButton: 'rounded-none px-6 py-2.5 font-normal text-xs tracking-wider uppercase shadow-none',
                        cancelButton: 'rounded-none px-6 py-2.5 font-normal text-xs tracking-wider uppercase shadow-none',
                        icon: 'rounded-none'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.dataset.confirmed = "true";
                        form.submit();
                    }
                });
            } else {
                if (confirm('Yakin ingin menghapus data ini?')) {
                    form.dataset.confirmed = "true";
                    form.submit();
                }
            }
        }
    }

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('button, input[type="submit"]');
        if (!btn) return;
        const form = btn.closest('form');
        if (form && form.dataset.confirmed !== "true") {
            const methodInput = form.querySelector('input[name="_method"]');
            if ((methodInput && methodInput.value.toUpperCase() === 'DELETE') || form.classList.contains('delete-form')) {
                handleConfirmDelete(form, e);
            }
        }
    });

    document.addEventListener('submit', function(e) {
        handleConfirmDelete(e.target, e);
    });
});
</script>

</body>
</html>
