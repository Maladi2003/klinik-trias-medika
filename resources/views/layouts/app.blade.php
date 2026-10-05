<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Klinik Trias Medika') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900">
        <!-- Perubahan utama: flex-col untuk HP, md:flex-row untuk Laptop -->
        <div class="min-h-screen bg-gray-100 flex flex-col md:flex-row">
            
            <!-- Sidebar: Lebar penuh (w-full) di HP, lebar tetap (md:w-64) di Laptop -->
            <aside class="bg-gray-800 text-white w-full md:w-64 flex-shrink-0 flex flex-col shadow-lg transition-all duration-300">
                <div class="p-4 md:p-6 text-center border-b border-gray-700">
                    <h2 class="text-xl md:text-2xl font-bold text-white uppercase tracking-wider">Klinik Trias</h2>
                </div>
                <!-- Menu: Fleksibel dan bisa di-scroll menyamping jika di HP -->
                <nav class="flex md:flex-col overflow-x-auto md:overflow-visible flex-nowrap p-4 gap-2 md:space-y-2 flex-1">
                    <a href="{{ route('dashboard') }}" class="whitespace-nowrap block py-2 md:py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white font-bold' : 'text-gray-300' }}">
                        🏠 Dashboard
                    </a>
                    
                    <a href="{{ route('dokter.index') }}" class="whitespace-nowrap block py-2 md:py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('dokter.*') ? 'bg-gray-700 text-white font-bold' : 'text-gray-300' }}">
                        👨‍⚕️ Dokter
                    </a>

                    <!-- MENU SPESIALISASI BARU DITAMBAHKAN DI SINI -->
                    <a href="{{ route('spesialisasi.index') }}" class="whitespace-nowrap block py-2 md:py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('spesialisasi.*') ? 'bg-gray-700 text-white font-bold' : 'text-gray-300' }}">
                        🏷️ Spesialisasi
                    </a>
                    
                    <a href="{{ route('layanan.index') }}" class="whitespace-nowrap block py-2 md:py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('layanan.*') ? 'bg-gray-700 text-white font-bold' : 'text-gray-300' }}">
                        💉 Layanan
                    </a>
                    
                    <a href="{{ route('pasien.index') }}" class="whitespace-nowrap block py-2 md:py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('pasien.*') ? 'bg-gray-700 text-white font-bold' : 'text-gray-300' }}">
                        🤕 Pasien
                    </a>
                    <a href="{{ route('jadwal.index') }}" class="whitespace-nowrap block py-2 md:py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('jadwal.*') ? 'bg-gray-700 text-white font-bold' : 'text-gray-300' }}">
                        📅 Jadwal
                    </a>
                    <a href="{{ route('janji-temu.index') }}" class="whitespace-nowrap block py-2 md:py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('janji-temu.*') ? 'bg-gray-700 text-white font-bold' : 'text-gray-300' }}">
                        🏥 Antrean / Janji Temu
                    </a>
                    <a href="{{ route('obat.index') }}" class="whitespace-nowrap block py-2 md:py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('obat.*') ? 'bg-gray-700 text-white font-bold' : 'text-gray-300' }}">
                        💊 Obat & Farmasi
                    </a>
                    <a href="{{ route('transaksi.index') }}" class="whitespace-nowrap block py-2 md:py-3 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('transaksi.*') ? 'bg-gray-700 text-white font-bold' : 'text-gray-300' }}">
                        💳 Kasir
                    </a>
                </nav>
            </aside>

            <!-- Konten Utama Kanan: Pastikan tidak melebihi layar di HP (overflow-hidden) -->
            <div class="flex-1 flex flex-col min-h-screen overflow-hidden w-full">
                
                @include('layouts.navigation')

                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-4 md:py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-2 md:p-0">
                    {{ $slot }}
                </main>

            </div>
        </div>
    </body>
</html>