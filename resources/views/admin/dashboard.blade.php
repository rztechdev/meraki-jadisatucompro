@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-sm sm:text-base font-medium text-gray-800 uppercase tracking-wide">Selamat datang, {{ auth()->user()?->name ?? 'Admin' }}</h2>
    <p class="text-gray-400 text-xs mt-0.5">Kelola konten dan pesan masuk website JADISATU.</p>
</div>

{{-- Stats Grid --}}
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 mb-6">
    @php
        $cards = [
            ['label' => 'Pesan Masuk', 'count' => $totalMessagesCount, 'badge' => $unreadMessagesCount > 0 ? $unreadMessagesCount . ' Baru' : null, 'route' => 'admin.messages.index', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
            ['label' => 'Hero Slides', 'count' => $heroCount, 'badge' => null, 'route' => 'admin.hero.index', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
            ['label' => 'Event Gallery', 'count' => $galleryCount, 'badge' => null, 'route' => 'admin.gallery.index', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
            ['label' => 'Layanan', 'count' => $serviceCount, 'badge' => null, 'route' => 'admin.services.index', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
            ['label' => 'Testimoni', 'count' => $testimonialCount, 'badge' => null, 'route' => 'admin.testimonials.index', 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
        ];
    @endphp
    @foreach($cards as $card)
        <a href="{{ route($card['route']) }}" class="bg-white rounded-xl p-4 border border-gray-200/80 hover:border-[#1B2B5E]/40 hover:shadow-sm transition-all relative">
            <div class="flex items-center justify-between mb-2">
                <div class="w-8 h-8 rounded-lg bg-[#1B2B5E]/5 flex items-center justify-center text-[#1B2B5E]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $card['icon'] }}"/></svg>
                </div>
                @if($card['badge'])
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-normal bg-[#FF6B35] text-white">
                        {{ $card['badge'] }}
                    </span>
                @endif
            </div>
            <div class="text-xl font-normal text-gray-800 mb-0.5">{{ $card['count'] }}</div>
            <div class="text-[11px] font-normal text-gray-400 uppercase tracking-wider">{{ $card['label'] }}</div>
        </a>
    @endforeach
</div>

{{-- Recent Messages Widget --}}
@if($recentMessages->count() > 0)
<div class="bg-white rounded-xl p-4 sm:p-5 border border-gray-200/80 mb-6">
    <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100">
        <div>
            <h3 class="font-medium text-gray-800 text-xs uppercase tracking-wider">Pesan Masuk Terbaru</h3>
            <p class="text-[11px] text-gray-400 mt-0.5">Pengunjung website yang mengirimkan formulir kontak</p>
        </div>
        <a href="{{ route('admin.messages.index') }}" class="text-xs font-medium text-[#1B2B5E] hover:underline">Lihat Semua Pesan →</a>
    </div>

    <div class="divide-y divide-gray-100">
        @foreach($recentMessages as $rm)
            <div class="py-2.5 flex items-center justify-between gap-3">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-7 h-7 rounded-lg bg-[#1B2B5E]/8 text-[#1B2B5E] flex items-center justify-center text-xs font-normal flex-shrink-0">
                        {{ strtoupper(substr($rm->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="font-medium text-xs text-gray-800 truncate">{{ $rm->name }}</span>
                            @if(!$rm->is_read)
                                <span class="px-1.5 py-0.5 rounded text-[9px] font-normal bg-[#FF6B35] text-white">Baru</span>
                            @endif
                        </div>
                        <p class="text-[11px] text-gray-400 truncate max-w-sm sm:max-w-md">{{ $rm->message }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2.5 flex-shrink-0">
                    <span class="text-[11px] text-gray-400 hidden sm:inline">{{ $rm->created_at->diffForHumans() }}</span>
                    <a href="{{ route('admin.messages.show', $rm->id) }}" class="px-2.5 py-1 rounded-md bg-gray-50 hover:bg-[#1B2B5E] hover:text-white text-xs font-medium text-gray-700 transition-all">
                        Buka
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

{{-- Quick Actions --}}
<div class="bg-white rounded-xl p-4 sm:p-5 border border-gray-200/80">
    <h3 class="font-medium text-gray-800 text-xs uppercase tracking-wider mb-3">Aksi Cepat</h3>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-2.5">
        @php
            $actions = [
                ['label' => 'Tambah Slide Hero', 'route' => 'admin.hero.create'],
                ['label' => 'Upload Foto Event', 'route' => 'admin.gallery.create'],
                ['label' => 'Tambah Layanan', 'route' => 'admin.services.create'],
                ['label' => 'Tambah Testimoni', 'route' => 'admin.testimonials.create'],
                ['label' => 'Tambah Anggota Tim', 'route' => 'admin.team.create'],
                ['label' => 'Edit Pengaturan', 'route' => 'admin.settings.index'],
            ];
        @endphp
        @foreach($actions as $action)
            <a href="{{ route($action['route']) }}"
               class="flex items-center gap-2.5 p-2.5 rounded-lg border border-gray-100 hover:border-gray-300 hover:bg-gray-50 transition-all text-xs font-normal text-gray-700">
                <span class="w-1.5 h-1.5 rounded-full bg-[#1B2B5E]"></span>
                {{ $action['label'] }}
            </a>
        @endforeach
    </div>
</div>
@endsection

