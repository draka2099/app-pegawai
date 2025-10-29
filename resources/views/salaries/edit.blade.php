
        <div class="flex justify-between items-center border-b p-5">
            <h3 class="text-xl font-semibold text-gray-800">Edit Salaries</h3>
            <button @click="editModalId = null" class="text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
        </div>

        <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Konten Form yang Scrollable --}}
            <div class="p-5 space-y-6 max-h-[65vh] overflow-y-auto">
                @php
                    $employees = \App\Models\Employee::orderBy('nama_lengkap')->get();
                @endphp

                <div>
                    <label for="karyawan_id_{{ $salary->id }}" class="block mb-2 text-sm font-medium text-gray-700">Pilih Karyawan</label>
                    <select id="karyawan_id_{{ $salary->id }}" name="karyawan_id" required 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('karyawan_id', $salary->karyawan_id) == $employee->id ? 'selected' : '' }}>
                                {{ $employee->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="bulan_{{ $salary->id }}" class="block mb-2 text-sm font-medium text-gray-700">Periode Gaji (Bulan & Tahun)</label>
                    <input type="month" id="bulan_{{ $salary->id }}" name="bulan" value="{{ old('bulan', $salary->bulan) }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="gaji_pokok_{{ $salary->id }}" class="block mb-2 text-sm font-medium text-gray-700">Gaji Pokok</label>
                        <input type="number" step="any" id="gaji_pokok_{{ $salary->id }}" name="gaji_pokok" value="{{ old('gaji_pokok', $salary->gaji_pokok) }}" placeholder="e.g., 5000000" required
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                    </div>
                    <div>
                        <label for="tunjangan_{{ $salary->id }}" class="block mb-2 text-sm font-medium text-gray-700">Tunjangan</label>
                        <input type="number" step="any" id="tunjangan_{{ $salary->id }}" name="tunjangan" value="{{ old('tunjangan', $salary->tunjangan) }}" placeholder="e.g., 500000" 
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                    </div>
                    <div>
                        <label for="potongan_{{ $salary->id }}" class="block mb-2 text-sm font-medium text-gray-700">Potongan</label>
                        <input type="number" step="any" id="potongan_{{ $salary->id }}" name="potongan" value="{{ old('potongan', $salary->potongan) }}" placeholder="e.g., 150000" 
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3">
                    </div>
                </div>
            </div>

            <div class="flex justify-end items-center border-t p-5 space-x-2 bg-gray-50 rounded-b-lg">
                <button type="button" @click="editModalId = null" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg">Batal</button>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">Update</button>
            </div>
        </form>
    