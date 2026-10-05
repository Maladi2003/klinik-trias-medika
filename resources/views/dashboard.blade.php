<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Banner -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-indigo-500">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-indigo-700 mb-1">Selamat Datang di Sistem Informasi Klinik Trias Medika!</h3>
                    <p class="text-sm text-gray-600">Anda masuk sebagai Administrator. Berikut adalah ringkasan operasional klinik secara real-time.</p>
                </div>
            </div>

            <!-- Statistics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card 1: Antrean -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Antrean Hari Ini</p>
                        <h4 class="text-3xl font-extrabold text-gray-800">{{ $antreanHariIni }}</h4>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-2xl">
                        🏥
                    </div>
                </div>

                <!-- Card 2: Pasien -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Pasien</p>
                        <h4 class="text-3xl font-extrabold text-gray-800">{{ $totalPasien }}</h4>
                    </div>
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-2xl">
                        👥
                    </div>
                </div>

                <!-- Card 3: Dokter -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Tenaga Dokter</p>
                        <h4 class="text-3xl font-extrabold text-gray-800">{{ $totalDokter }}</h4>
                    </div>
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-2xl">
                        👨‍⚕️
                    </div>
                </div>

                <!-- Card 4: Layanan -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Pilihan Layanan</p>
                        <h4 class="text-3xl font-extrabold text-gray-800">{{ $totalLayanan }}</h4>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-2xl">
                        💉
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat Resepsionis</h3>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('janji-temu.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Kelola Antrean Pasien
                        </a>
                        <a href="{{ route('pasien.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Lihat Database Pasien
                        </a>
                        <a href="{{ route('layanan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Update Harga Layanan
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>