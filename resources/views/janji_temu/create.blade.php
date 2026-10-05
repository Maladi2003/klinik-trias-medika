<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Antrean Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- Kotak Pesan Error -->
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                        <ul class="list-disc ml-5 text-sm font-bold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('janji-temu.store') }}" method="POST">
                    @csrf 

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Pasien</label>
                        <select name="pasien_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('pasien_id') border-red-500 @enderror" required>
                            <option value="">-- Cari Pasien --</option>
                            @foreach($pasiens as $pasien)
                                <option value="{{ $pasien->id }}" {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>{{ $pasien->nama_pasien }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Jadwal Dokter</label>
                        <select name="jadwal_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('jadwal_id') border-red-500 @enderror" required>
                            <option value="">-- Pilih Jadwal --</option>
                            @foreach($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}" {{ old('jadwal_id') == $jadwal->id ? 'selected' : '' }}>
                                    {{ $jadwal->dokter->nama_dokter }} ({{ $jadwal->hari }}, {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Layanan</label>
                        <select name="layanan_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('layanan_id') border-red-500 @enderror" required>
                            <option value="">-- Pilih Layanan --</option>
                            @foreach($layanans as $layanan)
                                <option value="{{ $layanan->id }}" {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}>
                                    {{ $layanan->nama_layanan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Periksa</label>
                        <!-- Mengubah type menjadi date agar user hanya memilih tanggal -->
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('tanggal') border-red-500 @enderror" required>
                        <p class="text-xs text-gray-500 mt-1 italic">*Pastikan memilih tanggal yang sesuai dengan hari praktik dokter di atas. Waktu (jam) akan menyesuaikan jadwal secara otomatis.</p>
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                            Daftarkan
                        </button>
                        <a href="{{ route('janji-temu.index') }}" class="text-sm text-gray-500 hover:text-gray-800 font-bold">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>