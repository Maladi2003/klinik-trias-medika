<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <a href="{{ route('pasien.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 inline-block mb-6">
                    + Tambah Pasien
                </a>
                
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-100 border-b-2 border-gray-200">
                            <th class="p-3 text-sm font-semibold tracking-wide">No</th>
                            <th class="p-3 text-sm font-semibold tracking-wide">Nama Pasien</th>
                            <th class="p-3 text-sm font-semibold tracking-wide">No. WA</th>
                            <th class="p-3 text-sm font-semibold tracking-wide">Alamat</th>
                            <th class="p-3 text-sm font-semibold tracking-wide">No. BPJS</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pasiens as $index => $pasien)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="p-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                            <td class="p-3 text-sm text-gray-700 font-bold">{{ $pasien->nama_pasien }}</td>
                            <td class="p-3 text-sm text-gray-700">{{ $pasien->no_wa }}</td>
                            <td class="p-3 text-sm text-gray-700">{{ $pasien->alamat }}</td>
                            <td class="p-3 text-sm text-gray-700">{{ $pasien->no_bpjs ?? '-' }}</td>
                            <td class="p-3 text-sm text-gray-700 text-center flex justify-center space-x-4">
                                <a href="{{ route('pasien.edit', $pasien->id) }}" class="text-yellow-600 hover:text-yellow-800 font-bold">Edit</a>
                                <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" onsubmit="return confirm('Hapus data pasien {{ $pasien->nama_pasien }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center text-gray-500">Belum ada data pasien.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>