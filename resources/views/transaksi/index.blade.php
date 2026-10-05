<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meja Kasir & Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-100 border-b-2 border-gray-200">
                                <th class="p-3 text-sm font-semibold tracking-wide">ID</th>
                                <th class="p-3 text-sm font-semibold tracking-wide">Nama Pasien</th>
                                <th class="p-3 text-sm font-semibold tracking-wide">Tanggal</th>
                                <th class="p-3 text-sm font-semibold tracking-wide">Total Tagihan</th>
                                <th class="p-3 text-sm font-semibold tracking-wide">Status</th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksis as $trx)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="p-3 text-sm text-gray-700">TRX-{{ $trx->id }}</td>
                                <!-- Relasi beruntun: Transaksi -> Rekam Medis -> Janji Temu -> Pasien -->
                                <td class="p-3 text-sm text-gray-700 font-bold">
                                    {{ $trx->rekamMedis->janjiTemu->pasien->nama_pasien ?? 'Unknown' }}
                                </td>
                                <td class="p-3 text-sm text-gray-700">{{ $trx->created_at->format('d M Y') }}</td>
                                <td class="p-3 text-sm text-gray-700 font-bold text-blue-600">
                                    Rp {{ number_format($trx->total_biaya, 0, ',', '.') }}
                                </td>
                                <td class="p-3 text-sm">
                                    @if($trx->status_pembayaran == 'Belum Lunas')
                                        <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-xs font-bold">Belum Lunas</span>
                                    @else
                                        <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs font-bold">Lunas</span>
                                    @endif
                                </td>
                                <td class="p-3 text-sm text-center">
                                    @if($trx->status_pembayaran == 'Belum Lunas')
                                    <form action="{{ route('transaksi.update', $trx->id) }}" method="POST" onsubmit="return confirm('Konfirmasi pasien sudah membayar lunas?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-bold">Lunasi</button>
                                    </form>
                                    @else
                                    <span class="text-gray-400 text-xs font-bold">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-3 text-center text-gray-500">Belum ada data transaksi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>