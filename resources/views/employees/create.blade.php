<div x-show="createModalOpen" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" @click.away="createModalOpen = false" style="display: none;">
    
    <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl mx-4 flex flex-col" @click.stop>
        <div class="flex justify-between items-center border-b p-5">
            <h3 class="text-xl font-semibold text-gray-800">Add Employees</h3>
            <button @click="createModalOpen = false" class="text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
        </div>

        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            
            <div class="p-5 space-y-6 max-h-[65vh] overflow-y-auto">
                <div>
                    <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3"
                           placeholder="Sayyidhina Raka Maulana">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3"
                               placeholder="raka.maulana@example.com">
                    </div>
                    <div>
                        <label for="nomor_telepon" class="block mb-2 text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" 
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3"
                               placeholder="081234567890">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tanggal_masuk" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Masuk</label>
                        <input type="date" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required 
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                    </div>
                </div>

                <div>
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-700">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" 
                              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3"
                              placeholder="Jl. Tegal timur No. 5, Keputih, Surabaya">{{ old('alamat') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="departemen_id" class="block mb-2 text-sm font-medium text-gray-700">Departemen</label>
                        <select id="departemen_id" name="departemen_id" required 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                            <option value="" disabled selected>Pilih Departemen</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ old('departemen_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->nama_departemen }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="jabatan_id" class="block mb-2 text-sm font-medium text-gray-700">Jabatan</label>
                        <select id="jabatan_id" name="jabatan_id" required 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                            <option value="" disabled selected>Pilih Jabatan</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}" {{ old('jabatan_id') == $position->id ? 'selected' : '' }}>
                                    {{ $position->nama_jabatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                        <option value="aktif" selected>Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end items-center border-t p-5 space-x-2">
                <button type="button" @click="createModalOpen = false" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg">Batal</button>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>