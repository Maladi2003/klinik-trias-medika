<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Obat Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('obat.store') }}" method="POST">
                    @csrf 

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Obat</label>
                        <input type="text" name="nama_obat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Jenis Obat</label>
                        <select name="jenis_obat" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Tablet">Tablet</option>
                            <option value="Kapsul">Kapsul</option>
                            <option value="Sirup">Sirup</option>
                            <option value="Salep">Salep</option>
                            <option value="Injeksi">Injeksi</option>
                        </select>
                    </div>

                    <div class="flex space-x-4 mb-6">
                        <div class="w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Stok Awal</label>
                            <input type="number" name="stok" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" min="1" required>
                        </div>
                        <div class="w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Harga (Rp)</label>
                            <input type="number" name="harga" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" min="0" required>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                            Simpan Obat
                        </button>
                        <a href="{{ route('obat.index') }}" class="text-sm text-gray-500 hover:text-gray-800 font-bold">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>