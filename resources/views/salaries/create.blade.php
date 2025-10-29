
        <div class="flex justify-between items-center border-b p-5">
            <h3 class="text-xl font-semibold text-gray-800">Add New Salaries</h3>
            <button @click="createModalOpen = false" class="text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
        </div>

        <form action="{{ route('salaries.store') }}" method="POST">
            @csrf
            <div class="p-5 space-y-6 max-h-[65vh] overflow-y-auto">
                @php
                    // Catatan: Query ini sebaiknya ada di Controller, bukan di view.
                    $employees = \App\Models\Employee::orderBy('nama_lengkap')->get();
                @endphp
                <div>
                    <label for="karyawan_id" class="block mb-2 text-sm font-medium text-gray-700">Pilih Karyawan</label>
                    <select id="karyawan_id" name="karyawan_id" required 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                        <option value="" disabled selected>Pilih dari daftar employees </option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('karyawan_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="bulan" class="block mb-2 text-sm font-medium text-gray-700">Periode Gaji (Bulan & Tahun)</label>
                    <input type="month" id="bulan" name="bulan" value="{{ old('bulan', date('Y-m')) }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="gaji_pokok" class="block mb-2 text-sm font-medium text-gray-700">Gaji Pokok</label>
                        <input type="number" step="any" id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok') }}" placeholder="5000000" required
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                    </div>
                    <div>
                        <label for="tunjangan" class="block mb-2 text-sm font-medium text-gray-700">Tunjangan</label>
                        <input type="number" step="any" id="tunjangan" name="tunjangan" value="{{ old('tunjangan', 0) }}" placeholder="500000" 
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                    </div>
                    <div>
                        <label for="potongan" class="block mb-2 text-sm font-medium text-gray-700">Potongan</label>
                        <input type="number" step="any" id="potongan" name="potongan" value="{{ old('potongan', 0) }}" placeholder="150000" 
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                    </div>
                </div>
            </div>

            <div class="flex justify-end items-center border-t p-5 space-x-2 bg-gray-50 rounded-b-lg">
                <button type="button" @click="createModalOpen = false" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg">Batal</button>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
            </div>
        </form>
    