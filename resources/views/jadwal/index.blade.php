<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Jadwal Praktik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <a href="{{ route('jadwal.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 inline-block mb-6">
                    + Tambah Jadwal
                </a>
                
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-100 border-b-2 border-gray-200">
                            <th class="p-3 text-sm font-semibold tracking-wide">No</th>
                            <th class="p-3 text-sm font-semibold tracking-wide">Nama Dokter</th>
                            <th class="p-3 text-sm font-semibold tracking-wide">Hari</th>
                            <th class="p-3 text-sm font-semibold tracking-wide">Jam Praktik</th>
                            <th class="p-3 text-sm font-semibold tracking-wide">Kuota</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwals as $index => $jadwal)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="p-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                            <!-- Ini adalah fitur relasi, memanggil nama_dokter dari tabel dokters -->
                            <td class="p-3 text-sm text-gray-700 font-bold">{{ $jadwal->dokter->nama_dokter }}</td>
                            <td class="p-3 text-sm text-gray-700">{{ $jadwal->hari }}</td>
                            <td class="p-3 text-sm text-gray-700">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                            <td class="p-3 text-sm text-gray-700">{{ $jadwal->kuota_pasien }}</td>
                            <td class="p-3 text-sm text-gray-700 text-center flex justify-center space-x-4">
                                <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="text-yellow-600 hover:text-yellow-800 font-bold">Edit</a>
                                <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-bold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center text-gray-500">Belum ada data jadwal.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>