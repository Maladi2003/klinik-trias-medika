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

    <!-- INLINE ALL CSS (TAILWIND & PLUS JAKARTA SANS LOKAL) -->
    <style>
        @layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}
        <?php 
            $cssPath = public_path('css/app.css');
            if (file_exists($cssPath)) {
                echo file_get_contents($cssPath);
            }
        ?>
    </style>

    <!-- MATERIAL SYMBOLS SUBSET ASYNC (~15 KiB ASLI PRESISI) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0&text=search,groups,star,medical_services,health_and_safety,arrow_circle_right,verified,schedule,call,chat,support_agent,location_on,map,north_east,calendar_month,person,menu,close,expand_more,unfold_more,arrow_drop_down,filter_alt,tune,event&display=swap" media="print" onload="this.media='all'">
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
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">calendar_month</span>
                    <span>Buat Janji Temu</span>
                </a>
                
                <div class="w-10 h-10 sm:w-8 sm:h-8 rounded-full bg-primary flex items-center justify-center flex-shrink-0 text-on-primary shadow-sm">
                    <span class="material-symbols-outlined text-[18px]" aria-hidden="true">person</span>
                </div>
                
                <button onclick="toggleMobileMenu()" class="lg:hidden flex items-center justify-center w-10 h-10 rounded-full text-on-surface hover:bg-surface-container transition-colors focus:outline-none relative z-[9999] cursor-pointer" aria-label="Buka atau Tutup Menu Navigasi">
                    <span class="material-symbols-outlined text-[26px] transition-transform duration-300" id="menu-icon" aria-hidden="true">menu</span>
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
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">calendar_month</span>
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
                    <span class="material-symbols-outlined text-[16px] text-primary" aria-hidden="true">verified</span>
                    <span>Terakreditasi Paripurna Kemenkes</span>
                </div>
            </div>
            
            <div class="flex flex-col gap-3">
                <h4 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[20px]" aria-hidden="true">schedule</span>Jam Operasional
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
                    <span class="material-symbols-outlined text-primary text-[20px]" aria-hidden="true">call</span>Kontak &amp; Bantuan
                </h4>
                <div class="flex flex-col gap-3 font-body-sm text-body-sm">
                    <a class="flex items-start gap-3 p-3 rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors group" href="https://wa.me/6281288997722" target="_blank" rel="noopener noreferrer">
                        <span class="material-symbols-outlined text-primary text-[22px]" aria-hidden="true">chat</span>
                        <div>
                            <div class="font-label-md text-label-md text-on-surface group-hover:text-primary transition-colors">0812-8899-7722</div>
                            <span class="font-body-sm text-body-sm text-outline">Chat Langsung WhatsApp</span>
                        </div>
                    </a>
                    <div class="flex items-start gap-3 p-3 rounded-xl bg-surface-container-low">
                        <span class="material-symbols-outlined text-primary text-[22px]" aria-hidden="true">support_agent</span>
                        <div>
                            <div class="font-label-md text-label-md text-on-surface">(021) 590-7788</div>
                            <span class="font-body-sm text-body-sm text-outline">Telepon Resepsionis &amp; UGD</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col gap-3">
                <h4 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[20px]" aria-hidden="true">location_on</span>Lokasi Klinik
                </h4>
                <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Jl. Raya Pasar Kemis No. 45, Sukaasih, Pasar Kemis, Tangerang, Banten 15560</p>
                <div class="rounded-xl overflow-hidden bg-surface-container-low p-3 flex items-center gap-3 shadow-[0_1px_4px_rgba(0,0,0,0.04)]">
                    <div class="w-10 h-10 rounded-lg bg-primary-fixed flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-on-primary-fixed text-[20px]" aria-hidden="true">map</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-label-md text-label-md text-on-surface">Depan Polsek Pasar Kemis</span>
                        <a class="font-body-sm text-body-sm text-primary hover:underline inline-flex items-center gap-1 mt-0.5" href="https://maps.google.com" target="_blank" rel="noopener noreferrer">
                            Buka Peta Google <span class="material-symbols-outlined text-[14px]" aria-hidden="true">north_east</span>
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
                icon.textContent = 'close';
            } else {
                menu.classList.remove('max-h-[500px]', 'opacity-100', 'border-t');
                menu.classList.add('max-h-0', 'opacity-0', 'border-t-0');
                icon.style.transform = 'rotate(0deg)';
                icon.textContent = 'menu';
            }
        }
    </script>
</body>
</html>