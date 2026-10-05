<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pemeriksaan Pasien: ') }} <span class="text-blue-600">{{ $janjiTemu->pasien->nama_pasien ?? 'Nama Pasien' }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                        <ul class="list-disc ml-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('rekam-medis.store') }}" method="POST">
                    @csrf 
                    <!-- ID Janji Temu disembunyikan karena dikirim otomatis -->
                    <input type="hidden" name="janji_temu_id" value="{{ $janjiTemu->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- BAGIAN KIRI: DIAGNOSA DOKTER -->
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                            <h3 class="font-bold text-lg text-blue-800 mb-4 border-b border-blue-200 pb-2">📋 Hasil Pemeriksaan</h3>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Keluhan Pasien</label>
                                <textarea name="keluhan" rows="2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required placeholder="Contoh: Demam 3 hari, pusing..."></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Diagnosa (Penyakit)</label>
                                <textarea name="diagnosa" rows="2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required placeholder="Contoh: Gejala Tipes"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Tindakan Medis (Opsional)</label>
                                <textarea name="tindakan" rows="2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" placeholder="Contoh: Cek Darah Rutin"></textarea>
                            </div>
                        </div>

                        <!-- BAGIAN KANAN: RESEP OBAT -->
                        <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                            <div class="flex justify-between items-center border-b border-green-200 pb-2 mb-4">
                                <h3 class="font-bold text-lg text-green-800">💊 Resep Obat</h3>
                                <button type="button" id="btn-tambah-obat" class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-1 px-3 rounded">
                                    + Tambah Obat
                                </button>
                            </div>

                            <!-- Wadah untuk baris-baris obat -->
                            <div id="wadah-resep">
                                <!-- Baris Obat Pertama (Default) -->
                                <div class="baris-obat flex space-x-2 mb-3 items-end">
                                    <div class="w-1/2">
                                        <label class="block text-gray-700 text-xs font-bold mb-1">Pilih Obat</label>
                                        <select name="obat_id[]" class="shadow border rounded w-full py-1 px-2 text-sm text-gray-700">
                                            <option value="">-- Pilih --</option>
                                            @foreach($obats as $obat)
                                                <option value="{{ $obat->id }}">{{ $obat->nama_obat }} (Stok: {{ $obat->stok }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-1/4">
                                        <label class="block text-gray-700 text-xs font-bold mb-1">Jml</label>
                                        <input type="number" name="jumlah[]" class="shadow appearance-none border rounded w-full py-1 px-2 text-sm text-gray-700" min="1" placeholder="Qty">
                                    </div>
                                    <div class="w-1/4">
                                        <label class="block text-gray-700 text-xs font-bold mb-1">Dosis</label>
                                        <input type="text" name="dosis[]" class="shadow appearance-none border rounded w-full py-1 px-2 text-sm text-gray-700" placeholder="3x1">
                                    </div>
                                    <div>
                                        <button type="button" class="btn-hapus-obat bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm mb-0.5">X</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg shadow-lg transition-transform transform hover:scale-105">
                            💾 Simpan & Terbitkan Tagihan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Script untuk menduplikasi baris resep obat -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnTambah = document.getElementById('btn-tambah-obat');
            const wadahResep = document.getElementById('wadah-resep');

            // Fungsi untuk menghapus baris obat
            wadahResep.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-hapus-obat')) {
                    // Jangan hapus jika hanya tersisa 1 baris
                    if (wadahResep.children.length > 1) {
                        e.target.closest('.baris-obat').remove();
                    } else {
                        alert('Minimal harus ada 1 baris (kosongkan isian jika tidak ada obat).');
                    }
                }
            });

            // Fungsi untuk menambah baris obat baru
            btnTambah.addEventListener('click', function() {
                const barisPertama = wadahResep.querySelector('.baris-obat');
                const barisBaru = barisPertama.cloneNode(true);
                
                // Kosongkan nilai input di baris baru
                barisBaru.querySelector('select').value = '';
                const inputs = barisBaru.querySelectorAll('input');
                inputs.forEach(input => input.value = '');

                wadahResep.appendChild(barisBaru);
            });
        });
    </script>
</x-app-layout>