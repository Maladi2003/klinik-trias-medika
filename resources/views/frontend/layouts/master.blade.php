<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Klinik Pratama Trias Medika</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    
    <style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">tailwind.config = { darkMode: "class", theme: { extend: { "colors": { "on-primary-fixed": "#002114", "on-secondary-container": "#00714d", "surface-container-highest": "#dae2fd", "tertiary-container": "#00855d", "outline-variant": "#bccac0", "surface-dim": "#d2d9f4", "on-primary": "#ffffff", "on-secondary-fixed": "#002113", "surface-variant": "#dae2fd", "primary-fixed-dim": "#68dba9", "on-surface-variant": "#3d4a42", "surface-container-low": "#f2f3ff", "surface-container-lowest": "#ffffff", "error": "#ba1a1a", "inverse-primary": "#68dba9", "secondary-fixed-dim": "#4edea3", "on-secondary": "#ffffff", "surface": "#faf8ff", "surface-container-high": "#e2e7ff", "primary-fixed": "#85f8c4", "secondary-container": "#6cf8bb", "secondary-fixed": "#6ffbbe", "on-error": "#ffffff", "surface-container": "#eaedff", "surface-bright": "#faf8ff", "on-error-container": "#93000a", "on-background": "#131b2e", "primary-container": "#00855d", "on-tertiary-container": "#f5fff7", "error-container": "#ffdad6", "tertiary-fixed": "#68fcbf", "on-surface": "#131b2e", "tertiary": "#006949", "on-tertiary-fixed-variant": "#005137", "on-secondary-fixed-variant": "#005236", "primary": "#006948", "secondary": "#006c49", "on-tertiary-fixed": "#002114", "surface-tint": "#006c4a", "inverse-surface": "#283044", "on-tertiary": "#ffffff", "inverse-on-surface": "#eef0ff", "tertiary-fixed-dim": "#45dfa4", "on-primary-fixed-variant": "#005137", "outline": "#6d7a72", "background": "#faf8ff", "on-primary-container": "#f5fff7" }, "fontFamily": { "headline-md": [ "Plus Jakarta Sans" ], "body-lg": [ "Plus Jakarta Sans" ], "body-sm": [ "Plus Jakarta Sans" ], "label-md": [ "Plus Jakarta Sans" ], "display-lg-mobile": [ "Plus Jakarta Sans" ], "headline-xl": [ "Plus Jakarta Sans" ], "label-lg": [ "Plus Jakarta Sans" ], "headline-xl-mobile": [ "Plus Jakarta Sans" ], "display-lg": [ "Plus Jakarta Sans" ], "label-sm": [ "Plus Jakarta Sans" ], "headline-sm": [ "Plus Jakarta Sans" ], "headline-lg": [ "Plus Jakarta Sans" ], "body-md": [ "Plus Jakarta Sans" ] } } } };</script>
</head>
<body class="bg-surface font-body-md text-body-md text-on-surface antialiased">

    <!-- HEADER / NAVBAR -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
        <div class="h-20 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-6 relative">
            <div class="flex items-center gap-3 flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center"><img alt="Klinik Pratama Trias Medika" class="h-12 w-auto object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAg3uTiRwxhmp8WRXiHQOCImld43sowNVAHmYRxJ3V4vDO1r8I6Flf8p_YtFpfKsD8sMw4h48_T8zTuA_pwpl1XfcOt1Eu69qK3nMWpumu0yUFu4QnFAioD8kdxul30tQoDTzfCTWHsk6i-Io59q2jrGUA_05W-5u0ks_ihBZsK1wZcus-C2fblMUoFqYyLKM9an5C6AjFzb6cj7xTtcBefHXwtYdf2-ElWKrwsBBqmvfMrwaMcUnWPWVdHM0GJ7Vh4gA"></a>
            </div>
            
            <!-- Menu Desktop -->
            <nav class="hidden lg:flex items-center gap-2 bg-surface-container-low px-2 py-1.5 rounded-2xl">
                <a href="{{ url('/') }}" class="px-4 py-2 font-label-lg text-label-lg transition-colors {{ request()->is('/') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">Beranda</a>
                <a href="{{ route('jadwal') }}" class="px-4 py-2 font-label-lg text-label-lg transition-colors {{ request()->routeIs('jadwal') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">Jadwal Dokter</a>
                <a href="{{ route('layanan') }}" class="px-4 py-2 font-label-lg text-label-lg transition-colors {{ request()->routeIs('layanan') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">Layanan &amp; Biaya</a>
                <a href="{{ route('kontak') }}" class="px-4 py-2 font-label-lg text-label-lg transition-colors {{ request()->routeIs('kontak') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">Kontak</a>
            </nav>

            <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                <a class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-on-primary font-label-lg text-label-lg hover:bg-primary-container hover:text-on-primary-container shadow-[0_4px_14px_rgba(0,105,72,0.25)] transition-all" data-path="buat-janji-temu" href="{{ route('booking.create') }}">
                    <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                    <span class="">Buat Janji Temu</span>
                </a>
                
                <div class="w-10 h-10 sm:w-8 sm:h-8 rounded-full bg-primary flex items-center justify-center flex-shrink-0 text-on-primary shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">person</span>
                </div>
                
                <!-- Tombol Hamburger dengan Transisi Rotasi Super Aman -->
                <button onclick="toggleMobileMenu()" class="lg:hidden flex items-center justify-center w-10 h-10 rounded-full text-on-surface hover:bg-surface-container transition-colors focus:outline-none relative z-[9999] cursor-pointer">
                    <span class="material-symbols-outlined text-[26px] transition-transform duration-300" id="menu-icon">menu</span>
                </button>
            </div>
        </div>

        <!-- Menu Dropdown Mobile -->
        <div id="mobile-menu" class="lg:hidden bg-surface-container-lowest border-outline-variant/30 shadow-[0_4px_12px_rgba(0,0,0,0.05)] absolute w-full left-0 top-full overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0 border-t-0">
            <div class="px-6 py-4 flex flex-col gap-2">
                <a href="{{ url('/') }}" class="px-4 py-3 rounded-xl font-label-lg text-label-lg {{ request()->is('/') ? 'bg-primary-fixed/20 text-on-primary-fixed-variant font-bold' : 'text-on-surface-variant hover:bg-surface-container-low' }}">Beranda</a>
                <a href="{{ route('jadwal') }}" class="px-4 py-3 rounded-xl font-label-lg text-label-lg {{ request()->routeIs('jadwal') ? 'bg-primary-fixed/20 text-on-primary-fixed-variant font-bold' : 'text-on-surface-variant hover:bg-surface-container-low' }}">Jadwal Dokter</a>
                <a href="{{ route('layanan') }}" class="px-4 py-3 rounded-xl font-label-lg text-label-lg {{ request()->routeIs('layanan') ? 'bg-primary-fixed/20 text-on-primary-fixed-variant font-bold' : 'text-on-surface-variant hover:bg-surface-container-low' }}">Layanan &amp; Biaya</a>
                <a href="{{ route('kontak') }}" class="px-4 py-3 rounded-xl font-label-lg text-label-lg {{ request()->routeIs('kontak') ? 'bg-primary-fixed/20 text-on-primary-fixed-variant font-bold' : 'text-on-surface-variant hover:bg-surface-container-low' }}">Kontak</a>
                
                <a class="mt-2 inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-xl bg-primary text-on-primary font-label-lg text-label-lg hover:bg-primary-container hover:text-on-primary-container shadow-[0_4px_14px_rgba(0,105,72,0.25)] w-full" href="{{ route('booking.create') }}">
                    <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                    <span>Buat Janji Temu</span>
                </a>
            </div>
        </div>
    </header>

    <main class="w-full pt-20 bg-surface overflow-x-hidden">
        @yield('content')
    </main>

    <footer class="w-full bg-surface-container-lowest shadow-[0_-1px_12px_rgba(0,0,0,0.03)] mt-space-xl">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-12 lg:py-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            <div class="flex flex-col gap-4">
                <img alt="Klinik Pratama Trias Medika" class="h-14 w-auto object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDmTqwfzhTQn-PszKrOgkTHYeXQWqpMg47Q_54Va5AKKKeG4EM8_vdYGDY7QAp43pU3HaTM_RVz7Z3RRAeozzSe4VOsuZi3XkBCObDvGXrhhmnFc6NT-WJBakvrAueAxDe825PCv3BSv3Y-5suqMLlq884ocFC_I1lPYCYILLjNns9J1WMKgE10TaQCiNIZbdfflQqitNsalmJU5Qip4TlEmbCU6CroCNcPlcYgNwMKtfaGwoybAn_IDXv3WXumJNXBdA">
                <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Pusat pelayanan kesehatan primer terpercaya bagi keluarga di Pasar Kemis. Mengutamakan kenyamanan, ketelitian diagnosis klinis, dan pelayanan sepenuh hati.</p>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-fixed/30 text-on-primary-fixed-variant font-label-sm text-label-sm w-fit"><span class="material-symbols-outlined text-[16px] text-primary">verified</span><span class="">Terakreditasi Paripurna Kemenkes</span></div>
            </div>
            <div class="flex flex-col gap-3">
                <h4 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2"><span class="material-symbols-outlined text-primary text-[20px]">schedule</span>Jam Operasional</h4>
                <ul class="flex flex-col gap-2.5 font-body-sm text-body-sm text-on-surface-variant">
                    <li class="flex justify-between items-center py-1"><span class="font-semibold text-on-surface">Senin - Sabtu:</span><span class="">08.00 - 21.00 WIB</span></li>
                    <li class="flex justify-between items-center py-1"><span class="font-semibold text-on-surface">Minggu / Libur:</span><span class="">08.00 - 14.00 WIB</span></li>
                    <li class="flex justify-between items-center py-1.5 px-3 rounded-lg bg-primary-fixed/20 text-on-primary-fixed-variant font-semibold"><span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>UGD &amp; Persalinan:</span><span class="">24 Jam Siaga</span></li>
                </ul>
            </div>
            <div class="flex flex-col gap-3">
                <h4 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2"><span class="material-symbols-outlined text-primary text-[20px]">call</span>Kontak &amp; Bantuan</h4>
                <div class="flex flex-col gap-3 font-body-sm text-body-sm">
                    <a class="flex items-start gap-3 p-3 rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors group" href="https://wa.me/6281288997722" target="_blank"><span class="material-symbols-outlined text-primary text-[22px]">chat</span><div><div class="font-label-md text-label-md text-on-surface group-hover:text-primary transition-colors">0812-8899-7722</div><span class="font-body-sm text-body-sm text-outline">Chat Langsung WhatsApp</span></div></a>
                    <div class="flex items-start gap-3 p-3 rounded-xl bg-surface-container-low"><span class="material-symbols-outlined text-primary text-[22px]">support_agent</span><div><div class="font-label-md text-label-md text-on-surface">(021) 590-7788</div><span class="font-body-sm text-body-sm text-outline">Telepon Resepsionis &amp; UGD</span></div></div>
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <h4 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2"><span class="material-symbols-outlined text-primary text-[20px]">location_on</span>Lokasi Klinik</h4>
                <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Jl. Raya Pasar Kemis No. 45, Sukaasih, Pasar Kemis, Tangerang, Banten 15560</p>
                <div class="rounded-xl overflow-hidden bg-surface-container-low p-3 flex items-center gap-3 shadow-[0_1px_4px_rgba(0,0,0,0.04)]"><div class="w-10 h-10 rounded-lg bg-primary-fixed flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-on-primary-fixed text-[20px]">map</span></div><div class="flex flex-col"><span class="font-label-md text-label-md text-on-surface">Depan Polsek Pasar Kemis</span><a class="font-body-sm text-body-sm text-primary hover:underline inline-flex items-center gap-1 mt-0.5" href="https://maps.google.com" target="_blank">Buka Peta Google <span class="material-symbols-outlined text-[14px]">north_east</span></a></div></div>
            </div>
        </div>
        <div class="w-full bg-surface-container-low py-5">
            <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                <p class="font-body-sm text-body-sm text-outline">© 2026 Klinik Pratama Trias Medika. All rights reserved.</p>
                <div class="flex items-center gap-6"><a class="font-body-sm text-body-sm text-outline hover:text-primary transition-colors" href="#">Kebijakan Privasi</a><a class="font-body-sm text-body-sm text-outline hover:text-primary transition-colors" href="#">Syarat &amp; Ketentuan</a></div>
            </div>
        </div>
    </footer>

    <!-- Script Menu Animasi Turun Pelan -->
<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('menu-icon');
        
        // Mengecek apakah menu sedang tertutup (max-h-0)
        if (menu.classList.contains('max-h-0')) {
            // Animasi turun pelan (Tirai terbuka)
            menu.classList.remove('max-h-0', 'opacity-0', 'border-t-0');
            menu.classList.add('max-h-[500px]', 'opacity-100', 'border-t');
            
            // Ikon berputar jadi X
            icon.style.transform = 'rotate(180deg)';
            icon.textContent = 'close';
        } else {
            // Animasi naik pelan (Tirai tertutup)
            menu.classList.remove('max-h-[500px]', 'opacity-100', 'border-t');
            menu.classList.add('max-h-0', 'opacity-0', 'border-t-0');
            
            // Ikon berputar kembali jadi garis 3
            icon.style.transform = 'rotate(0deg)';
            icon.textContent = 'menu';
        }
    }
</script>
</body>
</html>