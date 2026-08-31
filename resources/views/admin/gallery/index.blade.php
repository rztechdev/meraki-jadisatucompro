@extends('layouts.admin')
@section('title', 'Event Gallery')

@section('content')
<x-admin-table-header title="Event Gallery" create-route="admin.gallery.create" create-label="Upload Foto"/>

<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
    @forelse($galleries as $item)
        <div class="bg-white rounded-xl border border-gray-200/80 overflow-hidden group shadow-sm">
            <div class="aspect-video sm:aspect-square overflow-hidden bg-gray-100 relative">
                @if(Storage::disk('public')->exists($item->image_path))
                    <img src="{{ asset('storage/'.$item->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="w-full h-full bg-[#1B2B5E]/5 flex items-center justify-center text-[#1B2B5E]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/></svg>
                    </div>
                @endif
                @if($item->is_featured)
                    <div class="absolute top-2 right-2 bg-[#FF6B35] text-white text-[10px] font-normal px-1.5 py-0.5 rounded">★ Featured</div>
                @endif
            </div>
            <div class="p-2.5">
                <p class="text-xs font-medium text-gray-800 truncate">{{ $item->title }}</p>
                <div class="flex items-center justify-between mt-1 text-[10px]">
                    <span class="text-gray-400 uppercase tracking-wider">{{ $item->category }}</span>
                    <span class="px-1.5 py-0.5 rounded-full {{ $item->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-400' }}">
                        {{ $item->is_active ? 'Aktif' : 'Non-aktif' }}
                    </span>
                </div>
                <div class="flex gap-1.5 mt-2 pt-2 border-t border-gray-100">
                    <a href="{{ route('admin.gallery.edit', $item) }}" class="flex-1 text-center text-[11px] bg-gray-100 hover:bg-[#1B2B5E] hover:text-white text-gray-700 font-normal py-1 rounded-md transition-all">Edit</a>
                    <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" class="flex-1 delete-form">
                        @csrf @method('DELETE')
                        <button class="w-full text-[11px] bg-red-50 hover:bg-red-500 hover:text-white text-red-500 font-normal py-1 rounded-md transition-all">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12 text-gray-400">
            <svg class="w-10 h-10 mx-auto mb-2 opacity-40 text-[#1B2B5E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16"/></svg>
            <p class="text-xs font-normal">Belum ada foto event.</p>
        </div>
    @endforelse
</div>
@endsection

