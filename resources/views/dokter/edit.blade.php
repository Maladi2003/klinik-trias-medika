<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('dokter.update', $dokter->id) }}" method="POST">
                    @csrf 
                    @method('PUT') <!-- Wajib untuk proses update di Laravel -->

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Dokter</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="nama_dokter" value="{{ $dokter->nama_dokter }}" required>
                    </div>

                    <!-- DROPDOWN -->
                    <div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="spesialisasi">
        Spesialisasi
    </label>
    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-white leading-tight focus:outline-none focus:shadow-outline" id="spesialisasi" name="spesialisasi" required>
        <option value="" disabled>-- Pilih Spesialisasi --</option>
        
        @foreach($spesialisasis as $item)
            <option value="{{ $item->nama_spesialisasi }}" {{ $dokter->spesialisasi == $item->nama_spesialisasi ? 'selected' : '' }}>
                {{ $item->nama_spesialisasi }}
            </option>
        @endforeach
        
    </select>
</div>

                    <div class="flex items-center justify-between">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Perbarui Data</button>
                        <a href="{{ route('dokter.index') }}" class="text-sm text-gray-500 hover:text-gray-800 font-bold">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>