
        <div class="flex justify-between items-center border-b p-5">
            <h3 class="text-xl font-semibold text-gray-800">Add New Positions</h3>
            <button @click="createModalOpen = false" class="text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
        </div>

        <form action="{{ route('positions.store') }}" method="POST">
            @csrf
            <div class="p-5 space-y-6 max-h-[65vh] overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_jabatan" class="block mb-2 text-sm font-medium text-gray-700">Nama Jabatan</label>
                        <input type="text" id="nama_jabatan" name="nama_jabatan" value="{{ old('nama_jabatan') }}" required 
                               placeholder="Manajer"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                    </div>
                    <div>
                        <label for="gaji_pokok" class="block mb-2 text-sm font-medium text-gray-700">Gaji Pokok</label>
                        <input type="number" step="any" id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok') }}" required 
                               placeholder="7500000"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" 
                              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3"
                              placeholder="tanggung jawab untuk jabatan ini">{{ old('deskripsi') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end items-center border-t p-5 space-x-2 bg-gray-50 rounded-b-lg">
                <button type="button" @click="createModalOpen = false" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg">Batal</button>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
            </div>
        </form>

