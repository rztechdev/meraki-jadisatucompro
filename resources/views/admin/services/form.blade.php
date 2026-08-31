@extends('layouts.admin')
@section('title', $service->exists ? 'Edit Layanan' : 'Tambah Layanan')

@section('content')
<div class="max-w-xl">
    <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-500 hover:text-gray-700 mb-4">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>
    <div class="bg-white rounded-xl border border-gray-200/80 p-4 sm:p-5 shadow-sm">
        <h2 class="text-xs uppercase tracking-wider font-medium text-gray-800 mb-4 pb-3 border-b border-gray-100">{{ $service->exists ? 'Edit Layanan' : 'Tambah Layanan' }}</h2>
        <form action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST" class="space-y-4">
            @csrf
            @if($service->exists) @method('PUT') @endif
            <div>
                <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Nama Layanan *</label>
                <input type="text" name="title" value="{{ old('title', $service->title) }}" required class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs">
            </div>
            <div>
                <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Deskripsi *</label>
                <textarea name="description" rows="3" required class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs resize-none">{{ old('description', $service->description) }}</textarea>
            </div>
            <div class="grid sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Icon (nama)</label>
                    <select name="icon" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs bg-white">
                        @foreach(['trophy','building','users','star','camera','clipboard'] as $icon)
                            <option value="{{ $icon }}" {{ old('icon', $service->icon) === $icon ? 'selected' : '' }}>{{ ucfirst($icon) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Urutan</label>
                    <input type="number" name="order" value="{{ old('order', $service->order ?? 0) }}" min="0" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs">
                </div>
            </div>
            <div>
                <label class="flex items-center gap-2.5 cursor-pointer pt-1">
                    <div class="relative">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
                        <div class="w-8 h-4 bg-gray-200 rounded-full peer-checked:bg-[#1B2B5E] transition-colors"></div>
                        <div class="absolute top-0.5 left-0.5 w-3 h-3 bg-white rounded-full shadow peer-checked:translate-x-4 transition-transform"></div>
                    </div>
                    <span class="text-xs font-normal text-gray-700">Aktif</span>
                </label>
            </div>
            <div class="flex gap-2.5 pt-2">
                <button type="submit" class="bg-[#1B2B5E] hover:bg-[#243d7a] text-white font-normal px-4 py-2 rounded-lg text-xs transition-colors shadow-sm">
                    {{ $service->exists ? 'Simpan Perubahan' : 'Tambah Layanan' }}
                </button>
                <a href="{{ route('admin.services.index') }}" class="px-4 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-normal">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

