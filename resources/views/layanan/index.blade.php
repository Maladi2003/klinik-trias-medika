<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Layanan Medis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <a href="{{ route('layanan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 inline-block mb-6">
                    + Tambah Layanan Baru
                </a>
                
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-100 border-b-2 border-gray-200">
                                <th class="p-3 text-sm font-semibold tracking-wide">No</th>
                                <th class="p-3 text-sm font-semibold tracking-wide">Nama Tindakan/Layanan</th>
                                <th class="p-3 text-sm font-semibold tracking-wide">Estimasi Biaya</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($layanans as $index => $layanan)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="p-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                                <td class="p-3 text-sm text-gray-700 font-bold">{{ $layanan->nama_layanan }}</td>
                                <td class="p-3 text-sm text-gray-700">Rp {{ number_format($layanan->estimasi_biaya, 0, ',', '.') }}</td>
                                <td class="p-3 text-sm text-center">
                                    <form action="{{ route('layanan.destroy', $layanan->id) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-bold shadow">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-3 text-center text-gray-500">Belum ada data layanan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>