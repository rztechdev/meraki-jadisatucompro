@extends('layouts.admin')
@section('title', 'Statistik')

@section('content')
<x-admin-table-header title="Statistik" create-route="admin.stats.create" create-label="Tambah Statistik"/>

<div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-5">
    @foreach($stats as $stat)
        <div class="bg-white rounded-xl border border-gray-200/80 p-3.5 sm:p-4">
            <div class="text-xl font-normal text-[#1B2B5E]">{{ $stat->value }}<span class="text-sm font-normal">{{ $stat->suffix }}</span></div>
            <div class="text-gray-500 text-xs font-normal mt-0.5 truncate">{{ $stat->label }}</div>
            <div class="flex gap-1.5 mt-3">
                <a href="{{ route('admin.stats.edit', $stat) }}" class="flex-1 text-center text-[11px] bg-gray-100 hover:bg-[#1B2B5E] hover:text-white text-gray-700 font-normal py-1 rounded-md transition-all">Edit</a>
                <form action="{{ route('admin.stats.destroy', $stat) }}" method="POST" class="flex-1 delete-form">
                    @csrf @method('DELETE')
                    <button class="w-full text-[11px] bg-red-50 hover:bg-red-500 hover:text-white text-red-500 font-normal py-1 rounded-md transition-all">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection

