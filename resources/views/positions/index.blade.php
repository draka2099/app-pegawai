@extends('layouts.master')
@section('title', 'Daftar Jabatan')

@section('content')
    <div x-data="{ detailsModalId: null, editModalId: null, createModalOpen: false }">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-700">List of Positions</h1>
            <button @click="createModalOpen = true" class="inline-block bg-gray-800 text-white font-bold py-2 px-6 shadow-lg transform -skew-x-12 hover:bg-gray-700 transition duration-300">
                <span class="inline-block transform skew-x-12">+ add executive</span>
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
                            <th class="px-5 py-3">Nama Jabatan</th>
                            <th class="px-5 py-3">Gaji Pokok</th>
                            <th class="px-5 py-3 text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($positions as $key => $position)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-5 py-4 text-sm align-top">{{ $positions->firstItem() + $key }}</td>
                                <td class="px-5 py-4 text-sm align-top font-semibold">{{ $position->nama_jabatan }}</td>
                                <td class="px-5 py-4 text-sm align-top">Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</td>
                                <td class="px-5 py-4 text-sm text-center align-top">
                                    <button @click="detailsModalId = {{ $position->id }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-1 px-3 rounded text-xs">
                                        Details
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">Data jabatan belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $positions->links() }}
        </div>

        <div x-show="createModalOpen" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="createModalOpen = false" style="display: none;">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4" @click.stop>
                @include('positions.create')
            </div>
        </div>

        @foreach ($positions as $position)
            <div x-show="detailsModalId === {{ $position->id }}" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="detailsModalId = null" style="display: none;">
                <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4" @click.stop>
                    @include('positions.show', ['position' => $position])
                </div>
            </div>

            <div x-show="editModalId === {{ $position->id }}" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="editModalId = null" style="display: none;">
                <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4" @click.stop>
                    @include('positions.edit', ['position' => $position])
                </div>
            </div>
        @endforeach
    </div>
@endsection