@extends('layouts.master')
@section('title', 'Absensi')

@section('content')
<div x-data="{ 
    detailsModalId: null, 
    editModalId: @json(session('error_modal_id')), 
    createModalOpen: {{ $errors->any() && !session('error_modal_id') ? 'true' : 'false' }} 
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-700">Employee Attendance List</h1>
        <button @click="createModalOpen = true" class="inline-block bg-gray-800 text-white font-bold py-2 px-6 shadow-lg transform -skew-x-12 hover:bg-gray-700 transition duration-300">
            <span class="inline-block transform skew-x-12">
                + Record New Attendance
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
                        <th class="px-5 py-3">Tanggal</th>
                        <th class="px-5 py-3">Jam Kerja</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendances as $key => $attendance)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-5 py-4 text-sm align-top">{{ $attendances->firstItem() + $key }}</td>
                        <td class="px-5 py-4 text-sm align-top">{{ $attendance->employee->nama_lengkap ?? 'Karyawan Dihapus' }}</td>
                        <td class="px-5 py-4 text-sm align-top">{{ \Carbon\Carbon::parse($attendance->tanggal)->isoFormat('D MMM YYYY') }}</td>
                        <td class="px-5 py-4 text-sm align-top">
                            @if($attendance->status_absensi == 'hadir')
                                {{ \Carbon\Carbon::parse($attendance->waktu_masuk)->format('H:i') }} -
                                @if($attendance->waktu_keluar)
                                    {{ \Carbon\Carbon::parse($attendance->waktu_keluar)->format('H:i') }}
                                @else
                                    <span class="text-gray-400 italic text-xs">Belum Absen Pulang</span>
                                @endif
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-sm align-top">
                            @if($attendance->status_absensi == 'hadir')
                                <span class="capitalize px-2 py-1 text-xs font-semibold rounded-full bg-green-200 text-green-800">{{ $attendance->status_absensi }}</span>
                            @elseif(in_array($attendance->status_absensi, ['izin', 'sakit']))
                                <span class="capitalize px-2 py-1 text-xs font-semibold rounded-full bg-yellow-200 text-yellow-800">{{ $attendance->status_absensi }}</span>
                            @else
                                <span class="capitalize px-2 py-1 text-xs font-semibold rounded-full bg-red-200 text-red-800">{{ $attendance->status_absensi }}</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-sm text-center align-top">
                            <button @click="detailsModalId = {{ $attendance->id }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-1 px-3 rounded text-xs">
                                Details
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Tidak ada data absensi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $attendances->links() }}
    </div>

    <div x-show="createModalOpen" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="createModalOpen = false" style="display: none;">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4" @click.stop>
            @include('attendances.create')
        </div>
    </div>

    @foreach ($attendances as $attendance)
    <div x-show="detailsModalId === {{ $attendance->id }}" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="detailsModalId = null" style="display: none;">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4" @click.stop>
            @include('attendances.show', ['attendance' => $attendance])
        </div>
    </div>

    <div x-show="editModalId === {{ $attendance->id }}" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="editModalId = null" style="display: none;">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4" @click.stop>
            @include('attendances.edit', ['attendance' => $attendance])
        </div>
    </div>
    @endforeach
</div>
@endsection