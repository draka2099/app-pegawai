@extends('layouts.master')
@section('title', 'Daftar Gaji Karyawan')

@section('content')
    <div x-data="{ detailsModalId: null, editModalId: null, createModalOpen: false }">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-700">Employee Salary History</h1>
            
            {{-- Tombol miring (skewed) dengan ikon --}}
            <button @click="createModalOpen = true" class="inline-block bg-gray-800 text-white font-bold py-2 px-6 shadow-lg transform -skew-x-12 hover:bg-gray-700 transition duration-300">
                <span class="inline-block transform skew-x-12">
                    + Add Salary
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
                            <th class="px-5 py-3">Nama Karyawan</th>
                            <th class="px-5 py-3">Periode Gaji</th>
                            <th class="px-5 py-3">Gaji Pokok</th>
                            <th class="px-5 py-3">Total Gaji</th>
                            <th class="px-5 py-3 text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($salaries as $key => $salary)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-5 py-4 text-sm align-top">{{ $salaries->firstItem() + $key }}</td>
                                <td class="px-5 py-4 text-sm align-top">{{ $salary->employee->nama_lengkap ?? 'Karyawan Dihapus' }}</td>
                                <td class="px-5 py-4 text-sm align-top">{{ \Carbon\Carbon::parse($salary->bulan . '-01')->isoFormat('MMMM Y') }}</td>
                                <td class="px-5 py-4 text-sm align-top">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                                <td class="px-5 py-4 text-sm align-top font-bold">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
                                <td class="px-5 py-4 text-sm text-center align-top">
                                    <button @click="detailsModalId = {{ $salary->id }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-1 px-3 rounded text-xs">
                                        Details
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">Belum ada data gaji yang tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $salaries->links() }}
        </div>
        

        <div x-show="createModalOpen" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="createModalOpen = false" style="display: none;">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4" @click.stop>
                @include('salaries.create')
            </div>
        </div>
        
        @foreach ($salaries as $salary)
            <div x-show="detailsModalId === {{ $salary->id }}" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="detailsModalId = null" style="display: none;">
                <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4" @click.stop>
                    @include('salaries.show', ['salary' => $salary])
                </div>
            </div>

            <div x-show="editModalId === {{ $salary->id }}" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="editModalId = null" style="display: none;">
                <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4" @click.stop>
                    @include('salaries.edit', ['salary' => $salary])
                </div>
            </div>
        @endforeach
    </div>
@endsection