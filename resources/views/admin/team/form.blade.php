@extends('layouts.admin')
@section('title', $member->exists ? 'Edit Anggota Tim' : 'Tambah Anggota Tim')

@section('content')
<div class="max-w-xl">
    <a href="{{ route('admin.team.index') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-500 hover:text-gray-700 mb-4">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>
    <div class="bg-white rounded-xl border border-gray-200/80 p-4 sm:p-5 shadow-sm">
        <h2 class="text-xs uppercase tracking-wider font-medium text-gray-800 mb-4 pb-3 border-b border-gray-100">{{ $member->exists ? 'Edit Anggota' : 'Tambah Anggota Tim' }}</h2>
        <form action="{{ $member->exists ? route('admin.team.update', $member) : route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @if($member->exists) @method('PUT') @endif
            <div class="grid sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Nama *</label>
                    <input type="text" name="name" value="{{ old('name', $member->name) }}" required class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Jabatan *</label>
                    <input type="text" name="position" value="{{ old('position', $member->position) }}" required class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs">
                </div>
            </div>
            <div>
                <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Bio</label>
                <textarea name="bio" rows="2" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs resize-none">{{ old('bio', $member->bio) }}</textarea>
            </div>
            <div>
                <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Foto</label>
                @if($member->exists && $member->photo && Storage::disk('public')->exists($member->photo))
                    <img src="{{ asset('storage/'.$member->photo) }}" class="w-16 h-16 rounded-full object-cover mb-2">
                @endif
                <input type="file" name="photo" accept="image/*" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-xs text-gray-600 file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:bg-[#1B2B5E] file:text-white file:text-xs cursor-pointer">
            </div>
            <div class="grid sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">Instagram</label>
                    <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden focus-within:border-[#1B2B5E]">
                        <span class="px-2.5 text-gray-400 text-xs bg-gray-50 py-2 border-r border-gray-200">@</span>
                        <input type="text" name="instagram" value="{{ old('instagram', $member->instagram) }}" class="flex-1 px-2.5 py-2 text-xs focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">LinkedIn URL</label>
                    <input type="url" name="linkedin" value="{{ old('linkedin', $member->linkedin) }}" placeholder="https://..." class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs">
                </div>
            </div>
            <div class="flex gap-2.5 pt-2">
                <button type="submit" class="bg-[#1B2B5E] hover:bg-[#243d7a] text-white font-normal px-4 py-2 rounded-lg text-xs transition-colors shadow-sm">
                    {{ $member->exists ? 'Simpan' : 'Tambah' }}
                </button>
                <a href="{{ route('admin.team.index') }}" class="px-4 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-normal">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

