<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Form mengarah ke route dokter.store untuk menyimpan data -->
                <form action="{{ route('dokter.store') }}" method="POST">
                    @csrf <!-- Wajib ada di Laravel untuk keamanan form -->

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_dokter">
                            Nama Dokter
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama_dokter" type="text" name="nama_dokter" placeholder="Contoh: dr. Budi Santoso" required>
                    </div>

                    <!-- DROPDOWN -->
                    <div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="spesialisasi">
        Spesialisasi
    </label>
    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-white leading-tight focus:outline-none focus:shadow-outline" id="spesialisasi" name="spesialisasi" required>
        <option value="" disabled selected>-- Pilih Spesialisasi --</option>
        
        <!-- Looping data dari database -->
        @foreach($spesialisasis as $item)
            <option value="{{ $item->nama_spesialisasi }}">{{ $item->nama_spesialisasi }}</option>
        @endforeach
        
    </select>
</div>

                    <div class="flex items-center justify-between">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Simpan Data
                        </button>
                        <a href="{{ route('dokter.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>