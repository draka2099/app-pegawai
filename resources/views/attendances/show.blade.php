<div class="flex justify-between items-center border-b pb-3 mb-4">
    <h3 class="text-xl font-semibold">Detail Absensi</h3>
    <button @click="detailsModalId = null" class="text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
</div>
<div class="space-y-4 text-sm">
    <div class="grid grid-cols-3 gap-4">
        <span class="font-semibold text-gray-600">Nama Karyawan</span>
        <span class="col-span-2">{{ $attendance->employee->nama_lengkap ?? 'Karyawan Dihapus' }}</span>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <span class="font-semibold text-gray-600">Tanggal</span>
        <span class="col-span-2">{{ \Carbon\Carbon::parse($attendance->tanggal)->isoFormat('dddd, D MMMM Y') }}</span>
    </div>


    <div class="grid grid-cols-3 gap-4">
        <span class="font-semibold text-gray-600">Jam Kerja</span>
        <span class="col-span-2">
            @if($attendance->waktu_keluar)
            @else
            <span class="italic text-gray-500">Belum Tercatat</span>
            @endif
        </span>
    </div>
    
    <div class="grid grid-cols-3 gap-4">
        <span class="font-semibold text-gray-600">Status</span>
        <span class="col-span-2 capitalize">{{ $attendance->status_absensi }}</span>
    </div>
</div>
<div class="flex justify-end items-center border-t pt-4 mt-6 space-x-2">
    <button @click="detailsModalId = null; editModalId = {{ $attendance->id }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit</button>
    <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
        @csrf @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Hapus</button>
    </form>
</div>