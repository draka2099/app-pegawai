@extends('layouts.master')
@section('title', 'Daftar Departemen')

@section('content')
    <div x-data="{ detailsModalId: null, editModalId: null, createModalOpen: false }">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-700">Department List</h1>
            
            <button @click="createModalOpen = true" class="inline-block bg-gray-800 text-white font-bold py-2 px-6 shadow-lg transform -skew-x-12 hover:bg-gray-700 transition duration-300">
                <span class="inline-block transform skew-x-12">
                    + Add Department
                </span>
            </button>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-800 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                            <th class="px-5 py-3">No</th>
                            <th class="px-5 py-3">Nama Departemen</th>
                            <th class="px-5 py-3">Deskripsi</th>
                            <th class="px-5 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($departments as $key => $department)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-5 py-4 text-sm align-top">{{ $departments->firstItem() + $key }}</td>
                                <td class="px-5 py-4 text-sm align-top font-semibold">{{ $department->nama_departemen }}</td>
                                <td class="px-5 py-4 text-sm align-top">{{ Str::limit($department->deskripsi, 70) }}</td>
                                <td class="px-5 py-4 text-sm text-center align-top">
                                    <button @click="detailsModalId = {{ $department->id }}" class=>
                                        Details
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">Data departemen belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $departments->links() }}
        </div>

        {{-- ====================================================== --}}
        {{--                KUMPULAN SEMUA MODAL                    --}}
        {{-- ====================================================== --}}

        <div x-show="createModalOpen" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="createModalOpen = false" style="display: none;">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4" @click.stop>
                {{-- Kita akan include form dari create.blade.php --}}
                @include('departments.create')
            </div>
        </div>
        
        {{-- Modal Details dan Edit --}}
        @foreach ($departments as $department)
            <div x-show="detailsModalId === {{ $department->id }}" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="detailsModalId = null" style="display: none;">
                <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4" @click.stop>
                    @include('departments.show', ['department' => $department])
                </div>
            </div>

            <div x-show="editModalId === {{ $department->id }}" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="editModalId = null" style="display: none;">
                <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4" @click.stop>
                    @include('departments.edit', ['department' => $department])
                </div>
            </div>
        @endforeach
    </div>
@endsection