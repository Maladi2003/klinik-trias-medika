<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Antrean Pasien (Janji Temu)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <a href="{{ route('janji-temu.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 inline-block mb-6">
                    + Daftar Antrean
                </a>
                
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-100 border-b-2 border-gray-200">
                                <th class="p-3 text-sm font-semibold tracking-wide">No</th>
                                <th class="p-3 text-sm font-semibold tracking-wide">Nama Pasien</th>
                                <th class="p-3 text-sm font-semibold tracking-wide">Dokter Dituju</th>
                                <th class="p-3 text-sm font-semibold tracking-wide">Tanggal Periksa</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Aksi (Dokter)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($janjiTemus as $index => $jt)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="p-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                                <td class="p-3 text-sm text-gray-700 font-bold">{{ $jt->pasien->nama_pasien ?? '-' }}</td>
                                <td class="p-3 text-sm text-gray-700">{{ $jt->jadwal->dokter->nama_dokter ?? '-' }}</td>
                                <td class="p-3 text-sm text-gray-700">{{ date('d M Y, H:i', strtotime($jt->tanggal_berobat)) }}</td>
                                <td class="p-3 text-sm text-center flex justify-center space-x-2">
                                    
                                    <!-- TOMBOL SAKTI: Mengirim janji_temu_id ke Rekam Medis -->
                                    <a href="{{ route('rekam-medis.create', ['janji_temu_id' => $jt->id]) }}" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-bold shadow">
                                        🩺 Periksa Pasien
                                    </a>

                                    <form action="{{ route('janji-temu.destroy', $jt->id) }}" method="POST" onsubmit="return confirm('Batalkan antrean ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-bold shadow">Batal</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-3 text-center text-gray-500">Belum ada antrean pasien.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>