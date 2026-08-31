@extends('layouts.admin')
@section('title', 'Pengaturan Website')

@section('content')
<div class="max-w-2xl">
    <div class="mb-5">
        <h2 class="text-sm sm:text-base font-medium text-gray-800 uppercase tracking-wide">Pengaturan Website</h2>
        <p class="text-xs text-gray-400 mt-0.5">Edit konten dan informasi kontak yang tampil di website.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        @foreach($settings as $group => $groupSettings)
            <div class="bg-white rounded-xl border border-gray-200/80 p-4 sm:p-5 mb-4 shadow-sm">
                <h3 class="font-medium text-[#1B2B5E] text-xs uppercase tracking-wider mb-4 pb-2.5 border-b border-gray-100">
                    {{ ucfirst($group) }}
                </h3>
                <div class="space-y-3.5">
                    @foreach($groupSettings as $setting)
                        <div>
                            <label class="block text-[11px] font-normal text-gray-500 uppercase tracking-wider mb-1.5">{{ $setting->label }}</label>
                            @if($setting->type === 'textarea')
                                <textarea name="{{ $setting->key }}" rows="3" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs resize-none">{{ old($setting->key, $setting->value) }}</textarea>
                            @elseif($setting->type === 'image')
                                @if($setting->value && Storage::disk('public')->exists($setting->value))
                                    <img src="{{ asset('storage/'.$setting->value) }}" class="h-12 mb-2 rounded-lg">
                                @endif
                                <input type="file" name="{{ $setting->key }}" accept="image/*" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-xs text-gray-600 file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:bg-[#1B2B5E] file:text-white file:text-xs cursor-pointer">
                            @elseif($setting->type === 'boolean')
                                <label class="flex items-center gap-2.5 cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" name="{{ $setting->key }}" value="1" class="sr-only peer" {{ old($setting->key, $setting->value) == '1' ? 'checked' : '' }}>
                                        <div class="w-8 h-4 bg-gray-200 rounded-full peer-checked:bg-[#1B2B5E] transition-colors"></div>
                                        <div class="absolute top-0.5 left-0.5 w-3 h-3 bg-white rounded-full shadow peer-checked:translate-x-4 transition-transform"></div>
                                    </div>
                                    <span class="text-xs font-normal text-gray-700">Aktif</span>
                                </label>
                            @else
                                <input type="text" name="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#1B2B5E] text-xs">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="pt-1">
            <button type="submit" class="bg-[#1B2B5E] hover:bg-[#243d7a] text-white font-normal px-5 py-2.5 rounded-lg text-xs transition-colors shadow-sm uppercase tracking-wider">
                Simpan Semua Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

