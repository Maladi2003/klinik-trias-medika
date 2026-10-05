<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stok Obat & Farmasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <a href="{{ route('obat.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 inline-block mb-6">
                    + Tambah Obat Baru
                </a>
                
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-100 border-b-2 border-gray-200">
                                <th class="p-3 text-sm font-semibold tracking-wide">No</th>
                                <th class="p-3 text-sm font-semibold tracking-wide">Nama Obat</th>
                                <th class="p-3 text-sm font-semibold tracking-wide">Jenis</th>
                                <th class="p-3 text-sm font-semibold tracking-wide">Sisa Stok</th>
                                <th class="p-3 text-sm font-semibold tracking-wide">Harga</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($obats as $index => $obat)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="p-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                                <td class="p-3 text-sm text-gray-700 font-bold">{{ $obat->nama_obat }}</td>
                                <td class="p-3 text-sm text-gray-700">{{ $obat->jenis_obat }}</td>
                                <!-- Warna stok akan merah jika di bawah 10 -->
                                <td class="p-3 text-sm font-bold {{ $obat->stok < 10 ? 'text-red-600' : 'text-green-600' }}">
                                    {{ $obat->stok }}
                                </td>
                                <td class="p-3 text-sm text-gray-700">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                <td class="p-3 text-sm text-gray-700 text-center flex justify-center space-x-4">
                                    <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" onsubmit="return confirm('Hapus obat ini dari sistem?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-3 text-center text-gray-500">Belum ada data obat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>