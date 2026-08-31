@extends('layouts.admin')
@section('title', isset($gallery) && $gallery->exists ? 'Edit Foto' : 'Upload Foto Event')

@section('content')
<div class="max-w-xl">
    <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-500 hover:text-gray-700 mb-4">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>

    <div class="bg-white rounded-xl border border-gray-200/80 p-4 sm:p-5 shadow-sm">
        <h2 class="text-xs uppercase tracking-wider font-medium text-gray-800 mb-4 pb-3 border-b border-gray-100">{{ isset($gallery) && $gallery->exists ? 'Edit Foto' : 'Upload Foto Event' }}</h2>

        <form action="{{ isset($gallery) && $gallery->exists ? route('admin.gallery.update', $gallery) : route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @if(isset($gallery) && $gallery->exists) @method('PUT') @endif

            <div>
                <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Judul *</label>
                <input type="text" name="title" value="{{ old('title', $gallery->title ?? '') }}" required
                       class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs">
            </div>
            <div>
                <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Deskripsi</label>
                <textarea name="description" rows="2" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs resize-none">{{ old('description', $gallery->description ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Foto {{ isset($gallery) && $gallery->exists ? '(kosongkan jika tidak ingin ganti)' : '*' }}</label>
                @if(isset($gallery) && $gallery->exists && $gallery->image_path && Storage::disk('public')->exists($gallery->image_path))
                    <img src="{{ asset('storage/'.$gallery->image_path) }}" class="w-32 h-20 object-cover rounded-lg mb-2">
                @endif
                <input type="file" name="image" accept="image/*" {{ !(isset($gallery) && $gallery->exists) ? 'required' : '' }}
                       class="w-full px-3 py-2 rounded-lg border border-gray-200 text-xs text-gray-600 file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:bg-[#1B2B5E] file:text-white file:text-xs cursor-pointer">
            </div>
            <div class="grid sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Kategori *</label>
                    <input type="text" name="category" value="{{ old('category', $gallery->category ?? 'sport') }}" required
                           placeholder="sport, corporate, festival..."
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Lokasi</label>
                    <input type="text" name="location" value="{{ old('location', $gallery->location ?? '') }}" placeholder="Kota, Venue"
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs">
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Tanggal Event</label>
                    <input type="date" name="event_date" value="{{ old('event_date', isset($gallery) ? optional($gallery->event_date)->format('Y-m-d') : '') }}"
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Urutan</label>
                    <input type="number" name="order" value="{{ old('order', $gallery->order ?? 0) }}" min="0"
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs">
                </div>
            </div>
            <div class="flex gap-5 pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured', $gallery->is_featured ?? false) ? 'checked' : '' }}>
                        <div class="w-8 h-4 bg-gray-200 rounded-full peer-checked:bg-[#FF6B35] transition-colors"></div>
                        <div class="absolute top-0.5 left-0.5 w-3 h-3 bg-white rounded-full shadow peer-checked:translate-x-4 transition-transform"></div>
                    </div>
                    <span class="text-xs font-normal text-gray-700">Featured</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $gallery->is_active ?? true) ? 'checked' : '' }}>
                        <div class="w-8 h-4 bg-gray-200 rounded-full peer-checked:bg-[#1B2B5E] transition-colors"></div>
                        <div class="absolute top-0.5 left-0.5 w-3 h-3 bg-white rounded-full shadow peer-checked:translate-x-4 transition-transform"></div>
                    </div>
                    <span class="text-xs font-normal text-gray-700">Aktif</span>
                </label>
            </div>
            <div class="flex gap-2.5 pt-2">
                <button type="submit" class="bg-[#1B2B5E] hover:bg-[#243d7a] text-white font-normal px-4 py-2 rounded-lg text-xs transition-colors shadow-sm">
                    {{ isset($gallery) && $gallery->exists ? 'Simpan Perubahan' : 'Upload Foto' }}
                </button>
                <a href="{{ route('admin.gallery.index') }}" class="px-4 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-normal">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

