<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Jadwal Praktik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @error('waktu')
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                        <p class="font-bold">Jadwal Bentrok:</p>
                        <p class="text-sm">{{ $message }}</p>
                    </div>
                @enderror

                <form action="{{ route('jadwal.store') }}" method="POST">
                    @csrf 

                    <!-- Pilih Dokter -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Dokter</label>
                        <select name="dokter_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                            <option value="">-- Pilih Dokter --</option>
                            @foreach($dokters as $dokter)
                                @php
                                    $spec = is_object($dokter->spesialisasi) ? $dokter->spesialisasi->nama_spesialisasi : $dokter->spesialisasi;
                                @endphp
                                <option value="{{ $dokter->id }}" {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>
                                    {{ $dokter->nama_dokter }} {{ $spec ? '('.$spec.')' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Hari Praktik -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Hari Praktik</label>
                        <select name="hari" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                            <option value="">-- Pilih Hari --</option>
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jam Mulai & Selesai -->
                    <div class="flex space-x-4 mb-4">
                        <div class="w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                        </div>
                        <div class="w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                            <p id="error_jam_realtime" class="text-red-500 text-xs italic mt-1 hidden">Jam selesai tidak boleh lebih cepat atau sama dengan jam mulai!</p>
                        </div>
                    </div>

                    <!-- Kuota Pasien -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kuota Pasien</label>
                        <input type="number" name="kuota_pasien" value="{{ old('kuota_pasien') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" placeholder="Contoh: 20" min="1" required>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-between">
                        <button id="btn_simpan" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all" type="submit">
                            Simpan Jadwal
                        </button>
                        <a href="{{ route('jadwal.index') }}" class="text-sm text-gray-500 hover:text-gray-800 font-bold">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Script JavaScript Validasi Jam -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jamMulai = document.getElementById('jam_mulai');
            const jamSelesai = document.getElementById('jam_selesai');
            const btnSimpan = document.getElementById('btn_simpan');
            const errorJam = document.getElementById('error_jam_realtime');

            function validasiJam() {
                if (jamMulai.value && jamSelesai.value) {
                    if (jamSelesai.value <= jamMulai.value) {
                        errorJam.classList.remove('hidden');
                        btnSimpan.disabled = true;
                        btnSimpan.classList.add('opacity-50', 'cursor-not-allowed');
                        jamSelesai.classList.add('border-red-500');
                    } else {
                        errorJam.classList.add('hidden');
                        btnSimpan.disabled = false;
                        btnSimpan.classList.remove('opacity-50', 'cursor-not-allowed');
                        jamSelesai.classList.remove('border-red-500');
                    }
                }
            }

            jamMulai.addEventListener('input', validasiJam);
            jamSelesai.addEventListener('input', validasiJam);
        });
    </script>
</x-app-layout>