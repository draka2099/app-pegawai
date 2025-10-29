
<div class="flex justify-between items-center border-b p-5">
    <h3 class="text-xl font-semibold text-gray-800">Edit Data Absensi</h3>
    <button @click="editModalId = null" class="text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
</div>

<form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="p-5 space-y-6 max-h-[65vh] overflow-y-auto">
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Oops! Terjadi kesalahan:</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @php
        $employees = \App\Models\Employee::orderBy('nama_lengkap')->get();
        @endphp

        <div>
            <label for="karyawan_id_{{ $attendance->id }}" class="block mb-2 text-sm font-medium text-gray-700">Pilih Karyawan</label>
            <select id="karyawan_id_{{ $attendance->id }}" name="karyawan_id" required
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                @foreach ($employees as $employee)
                <option value="{{ $employee->id }}" {{ old('karyawan_id', $attendance->karyawan_id) == $employee->id ? 'selected' : '' }}>
                    {{ $employee->nama_lengkap }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="tanggal_{{ $attendance->id }}" class="block mb-2 text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" id="tanggal_{{ $attendance->id }}" name="tanggal" value="{{ old('tanggal', $attendance->tanggal) }}" required
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
            </div>
            <div>
                <label for="waktu_masuk_{{ $attendance->id }}" class="block mb-2 text-sm font-medium text-gray-700">Waktu Masuk</label>
                <input type="time" id="waktu_masuk_{{ $attendance->id }}" name="waktu_masuk"
                    value="{{ old('waktu_masuk', \Carbon\Carbon::parse($attendance->waktu_masuk)->format('H:i')) }}" required
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
            </div>
            <div>
                <label for="status_absensi_{{ $attendance->id }}" class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                <select id="status_absensi_{{ $attendance->id }}" name="status_absensi"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                    <option value="hadir" {{ old('status_absensi', $attendance->status_absensi) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="izin" {{ old('status_absensi', $attendance->status_absensi) == 'izin' ? 'selected' : '' }}>Izin</option>
                    <option value="sakit" {{ old('status_absensi', $attendance->status_absensi) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="alpha" {{ old('status_absensi', $attendance->status_absensi) == 'alpha' ? 'selected' : '' }}>Alpha</option>
                </select>
            </div>
            <div>
                <label for="waktu_keluar_{{ $attendance->id }}" class="block mb-2 text-sm font-medium text-gray-700">Waktu Keluar (Opsional)</label>
                <input type="time" id="waktu_keluar_{{ $attendance->id }}" name="waktu_keluar"
                 value="{{ old('waktu_keluar', $attendance->waktu_keluar ? \Carbon\Carbon::parse($attendance->waktu_keluar)->format('H:i') : '') }}"
                 class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
            </div>

        </div>
    </div>
    <div class="flex justify-end items-center border-t p-5 space-x-2 bg-gray-50 rounded-b-lg">
        <button type="button" @click="editModalId = null" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg">Batal</button>
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">Update</button>
    </div>
</form>

