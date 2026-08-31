@extends('layouts.admin')
@section('title', 'Detail Pesan')

@section('content')
<div class="max-w-3xl space-y-4">
    {{-- Header / Back & Actions --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
        <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-1.5 text-xs font-normal text-gray-500 hover:text-[#1B2B5E] transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar Pesan
        </a>

        <div class="flex items-center gap-2">
            <form method="POST" action="{{ route('admin.messages.toggle-read', $message) }}">
                @csrf
                <button type="submit" class="px-3 py-1.5 rounded-lg border border-gray-200 bg-white text-xs font-normal text-gray-700 hover:bg-gray-50 transition-all shadow-sm">
                    Tandai {{ $message->is_read ? 'Belum Dibaca' : 'Sudah Dibaca' }}
                </button>
            </form>

            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 text-xs font-normal transition-all">
                    Hapus Pesan
                </button>
            </form>
        </div>
    </div>

    {{-- Detail Card --}}
    <div class="bg-white rounded-xl border border-gray-200/80 shadow-sm overflow-hidden">
        {{-- Card Header --}}
        <div class="p-4 sm:p-5 border-b border-gray-100 bg-gray-50/40">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#1B2B5E] text-white flex items-center justify-center font-normal text-sm">
                        {{ strtoupper(substr($message->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="text-sm sm:text-base font-medium text-gray-900">{{ $message->name }}</h2>
                        @if($message->company)
                            <p class="text-xs font-normal text-gray-500 mt-0.5">{{ $message->company }}</p>
                        @endif
                        <p class="text-[11px] text-gray-400 mt-0.5">Diterima pada {{ $message->created_at ? $message->created_at->translatedFormat('l, d F Y, H:i') : '-' }} WIB</p>
                    </div>
                </div>

                <div>
                    @if($message->event_type)
                        <span class="px-2.5 py-1 rounded text-xs font-normal bg-gray-100 text-gray-700">
                            {{ $message->event_type }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Contact Info Bar --}}
        <div class="p-4 sm:p-5 border-b border-gray-100 grid grid-cols-1 sm:grid-cols-2 gap-3 bg-white">
            <div class="p-3 rounded-lg bg-gray-50 border border-gray-100">
                <span class="text-[10px] font-normal text-gray-400 uppercase tracking-wider block mb-0.5">Email Pengirim</span>
                <a href="mailto:{{ $message->email }}" class="text-xs font-medium text-[#1B2B5E] hover:underline">
                    {{ $message->email }}
                </a>
            </div>

            <div class="p-3 rounded-lg bg-gray-50 border border-gray-100">
                <span class="text-[10px] font-normal text-gray-400 uppercase tracking-wider block mb-0.5">Nomor WhatsApp / HP</span>
                @if($message->phone)
                    <span class="text-xs font-medium text-gray-800">{{ $message->phone }}</span>
                @else
                    <span class="text-xs text-gray-400 font-normal">Tidak dicantumkan</span>
                @endif
            </div>
        </div>

        {{-- Message Body --}}
        <div class="p-4 sm:p-5 bg-white space-y-3">
            <span class="text-[11px] font-normal text-gray-400 uppercase tracking-wider block">Kebutuhan / Isi Pesan:</span>
            <div class="p-4 rounded-xl bg-gray-50 border border-gray-200/80 text-gray-800 text-xs sm:text-sm leading-relaxed whitespace-pre-line font-normal">
                {{ $message->message }}
            </div>

            {{-- Quick Reply CTAs --}}
            <div class="pt-3 flex flex-wrap items-center gap-2.5">
                <a href="https://jadisatukreatif.com:2096/"
                   target="_blank"
                   class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-[#1B2B5E] text-white hover:bg-[#233777] text-xs font-normal shadow-sm transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Balas via Webmail Email
                </a>

                @if($message->phone)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}?text={{ urlencode('Halo ' . $message->name . ', terima kasih telah menghubungi JADISATU. Terkait kebutuhan event yang Anda konsultasikan:') }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-[#1B2B5E] text-white hover:bg-[#243d7a] text-xs font-normal shadow-sm transition-all">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Chat WhatsApp
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

