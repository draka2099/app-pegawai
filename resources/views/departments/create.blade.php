{{-- Wrapper Modal --}}
{{-- <div x-show="createModalOpen" x-transition ... > --}}



        {{-- Header Modal --}}
        <div class="flex justify-between items-center border-b p-5">
            <h3 class="text-xl font-semibold text-gray-800">Tambah Departemen Baru</h3>
            <button @click="createModalOpen = false" class="text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
        </div>

        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            
            {{-- Konten Form yang Scrollable --}}
            <div class="p-5 space-y-6 max-h-[65vh] overflow-y-auto">
                
                {{-- Baris Nama Departemen --}}
                <div>
                    <label for="nama_departemen" class="block mb-2 text-sm font-medium text-gray-700">Nama Departemen</label>
                    <select id="nama_departemen" name="nama_departemen" required 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                        <option value="" disabled selected>-- Pilih Nama Departemen --</option>
                        @php
                            $departmentOptions = [
                                'Departemen Ilmu Ekonomi', 'Departemen Manajemen', 'Departemen Akuntansi', 
                                'Departemen Teknik Sipil', 'Departemen Teknik Mesin', 'Departemen Teknik Komputer',
                                'Departemen Arsitektur', 'Departemen Elektro', 'Departemen Hukum'
                            ];
                        @endphp
                        @foreach ($departmentOptions as $option)
                            <option value="{{ $option }}" {{ old('nama_departemen') == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Baris Deskripsi --}}
                <div>
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" 
                              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3" 
                              placeholder="Jelaskan secara singkat fungsi dan tanggung jawab dari departemen ini">{{ old('deskripsi') }}</textarea>
                </div>
            </div>

            {{-- Footer Modal dengan Tombol Aksi --}}
            <div class="flex justify-end items-center border-t p-5 space-x-2 bg-gray-50 rounded-b-lg">
                <button type="button" @click="createModalOpen = false" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg">Batal</button>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
            </div>
        </form>


{{-- </div> --}}