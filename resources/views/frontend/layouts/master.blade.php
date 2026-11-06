<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- PRELOAD HERO IMAGE (BERANDA ONLY) -->
    @if(request()->is('/'))
    <link rel="preload" as="image" href="{{ asset('images/hero-klinik.webp') }}" type="image/webp" fetchpriority="high">
    @endif

    <!-- SEO & CANONICAL -->
    <title>Klinik Trias Medika - Pelayanan Kesehatan Terpadu Pasar Kemis</title>
    <meta name="description" content="Klinik Pratama Trias Medika menyediakan pendaftaran online, jadwal dokter, pelayanan UGD 24 jam, serta BPJS Kesehatan terpercaya di Pasar Kemis Tangerang.">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- INLINE ALL CSS (PERFORMA MAKSIMAL - 0 EXTERNAL REQUEST) -->
    <style>
        @layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}
        <?php 
            $cssPath = public_path('css/app.css');
            if (file_exists($cssPath)) {
                echo file_get_contents($cssPath);
            }
        ?>
    </style>
</head>
<body class="bg-surface font-body-md text-body-md text-on-surface antialiased">

    <!-- HEADER / NAVBAR -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
        <div class="h-20 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-6 relative">
            <div class="flex items-center gap-3 flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center" aria-label="Beranda Klinik Trias Medika">
                    <img alt="Logo Klinik Pratama Trias Medika" class="h-12 w-auto object-contain" src="{{ asset('images/logo.webp') }}" width="180" height="48">
                </a>
            </div>
            
            <!-- Menu Desktop -->
            <nav class="hidden lg:flex items-center gap-2 bg-surface-container-low px-2 py-1.5 rounded-2xl" aria-label="Navigasi Utama Desktop">
                <a href="{{ url('/') }}" class="px-4 py-2 font-label-lg text-label-lg transition-colors {{ request()->is('/') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">Beranda</a>
                <a href="{{ route('jadwal') }}" class="px-4 py-2 font-label-lg text-label-lg transition-colors {{ request()->routeIs('jadwal') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">Jadwal Dokter</a>
                <a href="{{ route('layanan') }}" class="px-4 py-2 font-label-lg text-label-lg transition-colors {{ request()->routeIs('layanan') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">Layanan &amp; Biaya</a>
                <a href="{{ route('kontak') }}" class="px-4 py-2 font-label-lg text-label-lg transition-colors {{ request()->routeIs('kontak') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">Kontak</a>
            </nav>

            <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                <a class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-on-primary font-label-lg text-label-lg hover:bg-primary-container hover:text-on-primary-container shadow-[0_4px_14px_rgba(0,105,72,0.25)] transition-all" href="{{ route('booking.create') }}">
                    <!-- IKON: calendar_month -->
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"/></svg>
                    <span>Buat Janji Temu</span>
                </a>
                
                <div class="w-10 h-10 sm:w-8 sm:h-8 rounded-full bg-primary flex items-center justify-center flex-shrink-0 text-on-primary shadow-sm">
                    <!-- IKON: person -->
                    <svg class="w-4.5 h-4.5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
                
                <button onclick="toggleMobileMenu()" class="lg:hidden flex items-center justify-center w-10 h-10 rounded-full text-on-surface hover:bg-surface-container transition-colors focus:outline-none relative z-[9999] cursor-pointer" aria-label="Buka atau Tutup Menu Navigasi">
                    <!-- IKON: menu -->
                    <svg class="w-6 h-6 fill-current transition-transform duration-300" id="menu-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
                </button>
            </div>
        </div>

        <!-- Menu Dropdown Mobile -->
        <div id="mobile-menu" class="lg:hidden bg-surface-container-lowest border-outline-variant/30 shadow-[0_4px_12px_rgba(0,0,0,0.05)] absolute w-full left-0 top-full overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0 border-t-0" aria-label="Navigasi Utama Mobile">
            <div class="px-6 py-4 flex flex-col gap-2">
                <a href="{{ url('/') }}" class="px-4 py-3 rounded-xl font-label-lg text-label-lg {{ request()->is('/') ? 'bg-primary-fixed/20 text-on-primary-fixed-variant font-bold' : 'text-on-surface-variant hover:bg-surface-container-low' }}">Beranda</a>
                <a href="{{ route('jadwal') }}" class="px-4 py-3 rounded-xl font-label-lg text-label-lg {{ request()->routeIs('jadwal') ? 'bg-primary-fixed/20 text-on-primary-fixed-variant font-bold' : 'text-on-surface-variant hover:bg-surface-container-low' }}">Jadwal Dokter</a>
                <a href="{{ route('layanan') }}" class="px-4 py-3 rounded-xl font-label-lg text-label-lg {{ request()->routeIs('layanan') ? 'bg-primary-fixed/20 text-on-primary-fixed-variant font-bold' : 'text-on-surface-variant hover:bg-surface-container-low' }}">Layanan &amp; Biaya</a>
                <a href="{{ route('kontak') }}" class="px-4 py-3 rounded-xl font-label-lg text-label-lg {{ request()->routeIs('kontak') ? 'bg-primary-fixed/20 text-on-primary-fixed-variant font-bold' : 'text-on-surface-variant hover:bg-surface-container-low' }}">Kontak</a>
                
                <a class="mt-2 inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-xl bg-primary text-on-primary font-label-lg text-label-lg hover:bg-primary-container hover:text-on-primary-container shadow-[0_4px_14px_rgba(0,105,72,0.25)] w-full" href="{{ route('booking.create') }}">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"/></svg>
                    <span>Buat Janji Temu</span>
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="w-full pt-20 bg-surface overflow-x-hidden">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="w-full bg-surface-container-lowest shadow-[0_-1px_12px_rgba(0,0,0,0.03)] mt-space-xl">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-12 lg:py-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            <div class="flex flex-col gap-4">
                <img alt="Logo Klinik Pratama Trias Medika" class="h-14 w-auto object-contain" src="{{ asset('images/logo.webp') }}" width="200" height="56" loading="lazy">
                <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Pusat pelayanan kesehatan primer terpercaya bagi keluarga di Pasar Kemis. Mengutamakan kenyamanan, ketelitian diagnosis klinis, dan pelayanan sepenuh hati.</p>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-fixed/30 text-on-primary-fixed-variant font-label-sm text-label-sm w-fit">
                    <!-- IKON: verified -->
                    <svg class="w-4 h-4 fill-primary" viewBox="0 0 24 24" aria-hidden="true"><path d="M23 12l-2.44-2.79.34-3.69-3.61-.82-1.89-3.2L12 2.96 8.6 1.5 6.71 4.69 3.1 5.5l.34 3.7L1 12l2.44 2.79-.34 3.7 3.61.82 1.89 3.2l3.4-1.46 3.4 1.46 1.89-3.2 3.61-.82-.34-3.69L23 12zm-12.91 4.72l-3.8-3.81 1.48-1.48 2.32 2.33 5.85-5.87 1.48 1.48-7.33 7.35z"/></svg>
                    <span>Terakreditasi Paripurna Kemenkes</span>
                </div>
            </div>
            
            <div class="flex flex-col gap-3">
                <h4 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2">
                    <!-- IKON: schedule -->
                    <svg class="w-5 h-5 fill-primary" viewBox="0 0 24 24" aria-hidden="true"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                    <span>Jam Operasional</span>
                </h4>
                <ul class="flex flex-col gap-2.5 font-body-sm text-body-sm text-on-surface-variant">
                    <li class="flex justify-between items-center py-1"><span class="font-semibold text-on-surface">Senin - Sabtu:</span><span>08.00 - 21.00 WIB</span></li>
                    <li class="flex justify-between items-center py-1"><span class="font-semibold text-on-surface">Minggu / Libur:</span><span>08.00 - 14.00 WIB</span></li>
                    <li class="flex justify-between items-center py-1.5 px-3 rounded-lg bg-primary-fixed/20 text-on-primary-fixed-variant font-semibold">
                        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>UGD &amp; Persalinan:</span><span>24 Jam Siaga</span>
                    </li>
                </ul>
            </div>
            
            <div class="flex flex-col gap-3">
                <h4 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2">
                    <!-- IKON: call -->
                    <svg class="w-5 h-5 fill-primary" viewBox="0 0 24 24" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    <span>Kontak &amp; Bantuan</span>
                </h4>
                <div class="flex flex-col gap-3 font-body-sm text-body-sm">
                    <a class="flex items-start gap-3 p-3 rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors group" href="https://wa.me/6281288997722" target="_blank" rel="noopener noreferrer">
                        <!-- IKON: chat -->
                        <svg class="w-5.5 h-5.5 fill-primary flex-shrink-0 mt-0.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z"/></svg>
                        <div>
                            <div class="font-label-md text-label-md text-on-surface group-hover:text-primary transition-colors">0812-8899-7722</div>
                            <span class="font-body-sm text-body-sm text-outline">Chat Langsung WhatsApp</span>
                        </div>
                    </a>
                    <div class="flex items-start gap-3 p-3 rounded-xl bg-surface-container-low">
                        <!-- IKON: support_agent -->
                        <svg class="w-5.5 h-5.5 fill-primary flex-shrink-0 mt-0.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12.22C21 6.73 16.74 3 12 3S3 6.73 3 12.22c-1.23.67-2 1.95-2 3.41v2.5C1 20.07 2.93 22 5.27 22H7v-8H4v-1.78C4 7.84 7.59 5 12 5s8 2.84 8 7.22V14h-3v8h1.73c2.34 0 4.27-1.93 4.27-3.87v-2.5c0-1.46-.77-2.74-2-3.41z"/></svg>
                        <div>
                            <div class="font-label-md text-label-md text-on-surface">(021) 590-7788</div>
                            <span class="font-body-sm text-body-sm text-outline">Telepon Resepsionis &amp; UGD</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col gap-3">
                <h4 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2">
                    <!-- IKON: location_on -->
                    <svg class="w-5 h-5 fill-primary" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    <span>Lokasi Klinik</span>
                </h4>
                <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Jl. Raya Pasar Kemis No. 45, Sukaasih, Pasar Kemis, Tangerang, Banten 15560</p>
                <div class="rounded-xl overflow-hidden bg-surface-container-low p-3 flex items-center gap-3 shadow-[0_1px_4px_rgba(0,0,0,0.04)]">
                    <div class="w-10 h-10 rounded-lg bg-primary-fixed flex items-center justify-center flex-shrink-0">
                        <!-- IKON: map -->
                        <svg class="w-5 h-5 fill-on-primary-fixed" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 3l-.16.03L15 5.1 9 3 3.36 4.9c-.21.07-.36.25-.36.48V20.5c0 .28.22.5.5.5l.16-.03L9 18.9l6 2.1 5.64-1.9c.21-.07.36-.25.36-.48V3.5c0-.28-.22-.5-.5-.5zM15 19l-6-2.11V5l6 2.11V19z"/></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-label-md text-label-md text-on-surface">Depan Polsek Pasar Kemis</span>
                        <a class="font-body-sm text-body-sm text-primary hover:underline inline-flex items-center gap-1 mt-0.5" href="https://maps.google.com" target="_blank" rel="noopener noreferrer">
                            <span>Buka Peta Google</span>
                            <!-- IKON: north_east -->
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5v2h6.59L4.05 18.54l1.41 1.41L17 8.41V15h2V5H9z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="w-full bg-surface-container-low py-5">
            <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                <p class="font-body-sm text-body-sm text-outline">© 2026 Klinik Pratama Trias Medika. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a class="font-body-sm text-body-sm text-outline hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
                    <a class="font-body-sm text-body-sm text-outline hover:text-primary transition-colors" href="#">Syarat &amp; Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Script Menu Mobile -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const icon = document.getElementById('menu-icon');
            
            if (menu.classList.contains('max-h-0')) {
                menu.classList.remove('max-h-0', 'opacity-0', 'border-t-0');
                menu.classList.add('max-h-[500px]', 'opacity-100', 'border-t');
                icon.style.transform = 'rotate(180deg)';
            } else {
                menu.classList.remove('max-h-[500px]', 'opacity-100', 'border-t');
                menu.classList.add('max-h-0', 'opacity-0', 'border-t-0');
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>
</body>
</html>