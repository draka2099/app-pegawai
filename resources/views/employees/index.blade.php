@extends('layouts.master')
@section('title', 'Campus University')

@section('content')
    <div x-data="{ createModalOpen: false, detailsModalId: null, editModalId: null }">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-700">List of Employees</h1>
            {{-- Tombol ini sekarang membuka modal, bukan halaman baru --}}
            <button @click="createModalOpen = true" class="inline-block bg-gray-800 text-white font-bold py-2 px-6 shadow-lg transform -skew-x-12 hover:bg-gray-700 transition duration-300">
                <span class="inline-block transform skew-x-12">+ Add Employee</span>
            </button>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-800 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                            <th class="px-5 py-3">No</th>
                            <th class="px-5 py-3">Nama Lengkap</th>
                            <th class="px-5 py-3">Email</th>
                            <th class="px-5 py-3">Nomor Telepon</th>
                            <th class="px-5 py-3">Alamat</th>
                            <th class="px-5 py-3">Tanggal Masuk</th>
                            <th class="px-5 py-3">Departemen</th>
                            <th class="px-5 py-3">Jabatan</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3 text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $key => $employee)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-5 py-4 text-sm align-top">{{ $employees->firstItem() + $key }}</td>
                                <td class="px-5 py-4 text-sm align-top">{{ $employee->nama_lengkap }}</td>
                                <td class="px-5 py-4 text-sm align-top">{{ $employee->email }}</td>
                                <td class="px-5 py-4 text-sm align-top">{{ $employee->nomor_telepon }}</td>
                                <td class="px-5 py-4 text-sm align-top">{{ $employee->alamat }}</td>
                                <td class="px-5 py-4 text-sm align-top">{{ \Carbon\Carbon::parse($employee->tanggal_masuk)->isoFormat('D MMM Y') }}</td>
                                <td class="px-5 py-4 text-sm align-top">{{ $employee->department->nama_departemen ?? 'N/A' }}</td>
                                <td class="px-5 py-4 text-sm align-top">{{ $employee->position->nama_jabatan ?? 'N/A' }}</td>
                                <td class="px-5 py-4 text-sm align-top">
                                    <span class="capitalize px-2 py-1 text-xs font-semibold rounded-full {{ $employee->status == 'aktif' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                        {{ $employee->status }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-sm text-center align-top">
                                    <button @click="detailsModalId = {{ $employee->id }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-1 px-3 rounded text-xs">
                                     Details
                                     </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center py-4">Data pegawai belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $employees->links() }}
        </div>
        @include('employees.create')

        @foreach ($employees as $employee)
            @include('employees.show', ['employee' => $employee])
            @include('employees.edit', ['employee' => $employee, 'departments' => $departments, 'positions' => $positions])
        @endforeach

    </div>
@endsection