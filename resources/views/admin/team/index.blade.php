@extends('layouts.admin')
@section('title', 'Tim')

@section('content')
<x-admin-table-header title="Anggota Tim" create-route="admin.team.create" create-label="Tambah Anggota"/>

<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
    @forelse($members as $member)
        <div class="bg-white rounded-xl border border-gray-200/80 p-3.5 text-center shadow-sm">
            <div class="w-12 h-12 rounded-full mx-auto mb-2 overflow-hidden bg-[#1B2B5E]/10 flex items-center justify-center text-[#1B2B5E]">
                @if($member->photo && Storage::disk('public')->exists($member->photo))
                    <img src="{{ asset('storage/'.$member->photo) }}" class="w-full h-full object-cover">
                @else
                    <span class="font-normal text-sm">{{ strtoupper(substr($member->name,0,1)) }}</span>
                @endif
            </div>
            <p class="font-medium text-gray-800 text-xs truncate">{{ $member->name }}</p>
            <p class="text-gray-400 text-[11px] font-normal mb-2.5 truncate">{{ $member->position }}</p>
            <div class="flex gap-1.5 pt-2 border-t border-gray-100">
                <a href="{{ route('admin.team.edit', $member) }}" class="flex-1 text-center text-[11px] bg-gray-100 hover:bg-[#1B2B5E] hover:text-white text-gray-700 font-normal py-1 rounded-md transition-all">Edit</a>
                <form action="{{ route('admin.team.destroy', $member) }}" method="POST" class="flex-1 delete-form">
                    @csrf @method('DELETE')
                    <button class="w-full text-[11px] bg-red-50 hover:bg-red-500 hover:text-white text-red-500 font-normal py-1 rounded-md transition-all">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12 text-gray-400"><p class="text-xs font-normal">Belum ada anggota tim.</p></div>
    @endforelse
</div>
@endsection

