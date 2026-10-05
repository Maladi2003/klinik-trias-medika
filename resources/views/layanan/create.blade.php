<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Layanan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('layanan.store') }}" method="POST">
                    @csrf 

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Layanan (Contoh: Suntik KB, Cabut Gigi)</label>
                        <input type="text" name="nama_layanan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Estimasi Biaya (Rp)</label>
                        <input type="number" name="estimasi_biaya" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required min="0">
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                            Simpan Layanan
                        </button>
                        <a href="{{ route('layanan.index') }}" class="text-sm text-gray-500 hover:text-gray-800 font-bold">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>