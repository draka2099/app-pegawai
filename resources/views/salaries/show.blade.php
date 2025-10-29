<div class="flex justify-between items-center border-b pb-3 mb-4">
    <h3 class="text-xl font-semibold">Salaries Details</h3>
    <button @click="detailsModalId = null" class="text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
</div>
<div>
    <h5 class="font-bold">
        Gaji untuk: {{ $salary->employee->nama_lengkap ?? 'Karyawan Dihapus' }}
    </h5>
    <p class="text-sm text-gray-500 mb-4">
        Periode: {{ \Carbon\Carbon::parse($salary->bulan . '-01')->isoFormat('MMMM Y') }}
    </p>

    <div class="space-y-2 text-sm">
        <div class="flex justify-between border-b py-2">
            <span class="text-gray-600">Gaji Pokok</span>
            <span>Rp {{ number_format($salary->gaji_pokok, 2, ',', '.') }}</span>
        </div>
        <div class="flex justify-between border-b py-2">
            <span class="text-gray-600">Tunjangan</span>
            <span>Rp {{ number_format($salary->tunjangan, 2, ',', '.') }}</span>
        </div>
        <div class="flex justify-between border-b py-2 font-semibold">
            <span>Total Penerimaan</span>
            <span>Rp {{ number_format($salary->gaji_pokok + $salary->tunjangan, 2, ',', '.') }}</span>
        </div>
        <div class="flex justify-between py-2 text-red-600">
            <span>Potongan</span>
            <span>- Rp {{ number_format($salary->potongan, 2, ',', '.') }}</span>
        </div>
    </div>

    <div class="mt-4 bg-gray-100 p-4 rounded-lg text-center">
        <p class="text-sm font-medium text-gray-700">Total Gaji Diterima (Take Home Pay)</p>
        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($salary->total_gaji, 2, ',', '.') }}</p>
    </div>
</div>
<div class="flex justify-end items-center border-t pt-4 mt-6 space-x-2">
    <button @click="detailsModalId = null; editModalId = {{ $salary->id }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit</button>
    <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data gaji ini?')">
        @csrf @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Hapus</button>
    </form>
</div>