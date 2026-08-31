@extends('layouts.admin')
@section('title', 'Pesan Masuk')

@section('content')
<div class="mb-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
    <div>
        <h2 class="text-sm sm:text-base font-medium text-gray-800 uppercase tracking-wide">Pesan Masuk (Inbox)</h2>
        <p class="text-gray-400 text-xs mt-0.5">Kelola dan respons pesan dari formulir kontak website.</p>
    </div>
    @if($unreadCount > 0)
        <form method="POST" action="{{ route('admin.messages.mark-all-read') }}">
            @csrf
            <button type="submit" class="px-3 py-1.5 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 rounded-lg text-xs font-normal transition-all shadow-sm">
                Tandai Semua Sudah Dibaca
            </button>
        </form>
    @endif
</div>

{{-- Filter Tabs & Search --}}
<div class="flex flex-wrap items-center justify-between gap-3 mb-5">
    <div class="flex items-center gap-1.5 bg-white p-1 rounded-lg border border-gray-200/80 shadow-sm text-xs font-normal">
        <a href="{{ route('admin.messages.index') }}" class="px-2.5 py-1 rounded-md {{ !request('status') ? 'bg-[#1B2B5E] text-white font-medium' : 'text-gray-500 hover:text-gray-800' }}">
            Semua ({{ $totalCount }})
        </a>
        <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}" class="px-2.5 py-1 rounded-md {{ request('status') === 'unread' ? 'bg-[#1B2B5E] text-white font-medium' : 'text-gray-500 hover:text-gray-800' }}">
            Belum Dibaca ({{ $unreadCount }})
        </a>
        <a href="{{ route('admin.messages.index', ['status' => 'read']) }}" class="px-2.5 py-1 rounded-md {{ request('status') === 'read' ? 'bg-[#1B2B5E] text-white font-medium' : 'text-gray-500 hover:text-gray-800' }}">
            Sudah Dibaca ({{ $totalCount - $unreadCount }})
        </a>
    </div>

    <form method="GET" action="{{ route('admin.messages.index') }}" class="relative w-full sm:w-60">
        @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
        @endif
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, email, pesan..."
               class="w-full px-3 py-1.5 pl-8 rounded-lg border border-gray-200 bg-white text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#1B2B5E]">
        <svg class="w-3.5 h-3.5 text-gray-400 absolute left-2.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    </form>
</div>

{{-- Message List --}}
<div class="bg-white rounded-xl border border-gray-200/80 overflow-hidden shadow-sm divide-y divide-gray-100">
    @forelse($messages as $msg)
        <div class="p-3.5 sm:p-4 hover:bg-gray-50/70 transition-colors {{ !$msg->is_read ? 'bg-orange-50/20' : '' }}">
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-start gap-3 min-w-0">
                    <div class="w-8 h-8 rounded-lg {{ !$msg->is_read ? 'bg-[#1B2B5E] text-white' : 'bg-gray-100 text-gray-600' }} flex items-center justify-center font-normal text-xs flex-shrink-0">
                        {{ strtoupper(substr($msg->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <a href="{{ route('admin.messages.show', $msg) }}" class="font-medium text-gray-900 text-xs hover:text-[#1B2B5E] hover:underline">
                                {{ $msg->name }}
                            </a>
                            @if($msg->company)
                                <span class="text-[11px] text-gray-400 font-normal">({{ $msg->company }})</span>
                            @endif
                            @if(!$msg->is_read)
                                <span class="px-1.5 py-0.5 rounded text-[9px] font-normal bg-[#FF6B35] text-white">Baru</span>
                            @endif
                            @if($msg->event_type)
                                <span class="px-1.5 py-0.5 rounded text-[9px] font-normal bg-gray-100 text-gray-700">
                                    {{ $msg->event_type }}
                                </span>
                            @endif
                        </div>
                        <p class="text-gray-500 text-xs mt-1 line-clamp-2 leading-relaxed font-normal">{{ $msg->message }}</p>
                        <div class="flex flex-wrap items-center gap-3 mt-1.5 text-[10px] text-gray-400">
                            <span>✉ {{ $msg->email }}</span>
                            @if($msg->phone)
                                <span>📞 {{ $msg->phone }}</span>
                            @endif
                            <span>🕒 {{ $msg->created_at ? $msg->created_at->diffForHumans() : '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-1.5 flex-shrink-0">
                    <a href="{{ route('admin.messages.show', $msg) }}" class="px-2.5 py-1 rounded-md bg-gray-100 hover:bg-[#1B2B5E] hover:text-white text-xs font-normal text-gray-700 transition-colors">
                        Buka
                    </a>
                    @if($msg->phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}?text={{ urlencode('Halo ' . $msg->name . ', terima kasih telah menghubungi JADISATU.') }}"
                           target="_blank"
                           class="p-1.5 text-[#1B2B5E] hover:bg-gray-100 rounded-md transition-colors" title="Chat WhatsApp">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        </a>
                    @endif
                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="delete-form">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-1 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-md transition-colors" title="Hapus Pesan">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-12 text-gray-400">
            <svg class="w-10 h-10 mx-auto mb-2 opacity-40 text-[#1B2B5E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <p class="text-xs font-normal">Tidak ada pesan masuk.</p>
        </div>
    @endforelse
</div>

@if($messages->hasPages())
    <div class="mt-6">
        {{ $messages->links() }}
    </div>
@endif
@endsection
