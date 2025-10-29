<div x-show="detailsModalId === {{ $employee->id }}" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="detailsModalId = null" style="display: none;">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4" @click.stop>
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-xl font-semibold">Detail Employees</h3>
            <button @click="detailsModalId = null" class="text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
        </div>
        <div class="space-y-4 text-sm">
            <div class="grid grid-cols-3 gap-4"><span class="font-semibold text-gray-600">Nama Lengkap</span><span class="col-span-2">{{ $employee->nama_lengkap }}</span></div>
            <div class="grid grid-cols-3 gap-4"><span class="font-semibold text-gray-600">Email</span><span class="col-span-2">{{ $employee->email }}</span></div>
            <div class="grid grid-cols-3 gap-4"><span class="font-semibold text-gray-600">Nomor Telepon</span><span class="col-span-2">{{ $employee->nomor_telepon }}</span></div>
            <div class="grid grid-cols-3 gap-4"><span class="font-semibold text-gray-600">Departemen</span><span class="col-span-2">{{ $employee->department->nama_departemen ?? 'N/A' }}</span></div>
            <div class="grid grid-cols-3 gap-4"><span class="font-semibold text-gray-600">Jabatan</span><span class="col-span-2">{{ $employee->position->nama_jabatan ?? 'N/A' }}</span></div>
            <div class="grid grid-cols-3 gap-4"><span class="font-semibold text-gray-600">Alamat</span><span class="col-span-2">{{ $employee->alamat }}</span></div>
            <div class="grid grid-cols-3 gap-4"><span class="font-semibold text-gray-600">Tanggal Masuk</span><span class="col-span-2">{{ \Carbon\Carbon::parse($employee->tanggal_masuk)->isoFormat('D MMMM Y') }}</span></div>
            <div class="grid grid-cols-3 gap-4"><span class="font-semibold text-gray-600">Status</span><span class="col-span-2 capitalize">{{ $employee->status }}</span></div>
        </div>
        <div class="flex justify-end items-center border-t pt-4 mt-6 space-x-2">
            <button @click="detailsModalId = null; editModalId = {{ $employee->id }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit</button>
            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Hapus</button>
            </form>
        </div>
    </div>
</div>