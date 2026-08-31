@extends('layouts.admin')
@section('title', 'Hero Slider')

@section('content')
<x-admin-table-header title="Hero Slider" create-route="admin.hero.create" create-label="Tambah Slide"/>

<div class="bg-white rounded-xl border border-gray-200/80 overflow-hidden divide-y divide-gray-100 shadow-sm">
    @if($slides->count())
        @foreach($slides as $slide)
            <div class="flex items-center gap-3 p-3.5 hover:bg-gray-50 transition-colors">
                <div class="w-16 h-10 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100">
                    @if(Storage::disk('public')->exists($slide->image_path))
                        <img src="{{ asset('storage/'.$slide->image_path) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-[#1B2B5E]/5 flex items-center justify-center text-[#1B2B5E]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01"/></svg>
                        </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-gray-800 text-xs truncate">{{ $slide->title }}</p>
                    <p class="text-gray-400 text-[11px] mt-0.5 truncate font-normal">{{ $slide->subtitle }}</p>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <span class="text-[10px] font-normal px-2 py-0.5 rounded-full {{ $slide->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $slide->is_active ? 'Aktif' : 'Non-aktif' }}
                    </span>
                    <a href="{{ route('admin.hero.edit', $slide) }}" class="p-1.5 text-gray-400 hover:text-[#1B2B5E] hover:bg-gray-100 rounded-md transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </a>
                    <form action="{{ route('admin.hero.destroy', $slide) }}" method="POST" class="delete-form">
                        @csrf @method('DELETE')
                        <button class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-md transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center py-12 text-gray-400">
            <svg class="w-10 h-10 mx-auto mb-2 opacity-40 text-[#1B2B5E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <p class="text-xs font-normal">Belum ada slide. Tambahkan yang pertama!</p>
        </div>
    @endif
</div>
@endsection

