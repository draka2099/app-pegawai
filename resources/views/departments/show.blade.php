<div class="flex justify-between items-center border-b pb-3 mb-4">
    <h3 class="text-xl font-semibold">Detail Departemen</h3>
    <button @click="detailsModalId = null" class="text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
</div>
<div class="space-y-4 text-sm">
    <div class="grid grid-cols-3 gap-4">
        <span class="font-semibold text-gray-600">Nama Departemen</span>
        <span class="col-span-2">{{ $department->nama_departemen }}</span>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <span class="font-semibold text-gray-600">Deskripsi</span>
        <span class="col-span-2">{{ $department->deskripsi ?? 'Tidak ada deskripsi.' }}</span>
    </div>
</div>
<div class="flex justify-end items-center border-t pt-4 mt-6 space-x-2">
    {{-- Tombol ini akan menutup modal details dan membuka modal edit --}}
    <button @click="detailsModalId = null; editModalId = {{ $department->id }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit</button>
    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus departemen ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Hapus</button>
    </form>
</div>