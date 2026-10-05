@extends('frontend.layouts.master')

@section('content')
<div class="flex flex-col w-full">
    <!-- SECTION 1: HERO SECTION -->
    <section class="relative w-full overflow-hidden bg-surface py-10 lg:py-16">
        <div class="pointer-events-none absolute -top-24 right-0 w-[550px] h-[550px] rounded-full bg-gradient-to-br from-primary-fixed/30 to-secondary-container/20 blur-3xl -z-10"></div>
        <div class="pointer-events-none absolute top-1/2 left-0 w-[380px] h-[380px] rounded-full bg-primary-fixed/20 blur-2xl -z-10"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">
                <div class="lg:col-span-7 flex flex-col gap-6">
                    <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-surface-container-lowest shadow-sm w-fit border-0">
                        <span class="flex h-2.5 w-2.5 rounded-full bg-primary animate-pulse"></span>
                        <span class="font-label-sm text-label-sm text-primary uppercase tracking-wider font-bold">🌿 Fasilitas Kesehatan Tingkat Pertama (FKTP) Terakreditasi Paripurna</span>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight leading-[1.12]">Klinik Trias Medika: <span class="text-primary">Mitra Kesehatan</span> Terpercaya di Pasar Kemis</h1>
                        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl leading-relaxed">Pelayanan medis cepat, ramah, dan profesional tanpa antre berjam-jam. Dilengkapi dokter berpengalaman, apotek terpadu, dan fasilitas laboratorium modern untuk kesehatan keluarga Anda.</p>
                    </div>
                    
                    <!-- Search Bar (SUDAH DIPERBAIKI) -->
                    <div class="flex flex-col gap-3 w-full max-w-xl">
                        <!-- Perhatikan action dan method GET yang ditambahkan di sini -->
                        <form action="{{ route('jadwal') }}" method="GET" class="relative flex items-center p-1.5 rounded-2xl bg-surface-container-lowest shadow-[0_10px_25px_-5px_rgba(0,105,72,0.08)]">
                            <span class="material-symbols-outlined text-outline ml-3.5 mr-2 text-[24px]">search</span>
                            <!-- Atribut name="q" sangat penting agar keyword dikirim ke controller -->
                            <input class="w-full bg-transparent py-3 text-body-md text-on-surface placeholder:text-outline focus:outline-none" name="q" value="{{ request('q') }}" id="searchServiceInput" placeholder="Cari Dokter atau Spesialis..." type="text" required>
                            <button class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-primary text-on-primary font-label-lg text-label-lg hover:bg-primary-container shadow-[0_4px_14px_rgba(0,105,72,0.22)] transition-all flex-shrink-0 cursor-pointer" type="submit">
                                <span class="material-symbols-outlined text-[18px]">search</span><span class="hidden sm:inline">Cari</span>
                            </button>
                        </form>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="pt-4 grid grid-cols-3 gap-3 sm:gap-6 max-w-xl">
                        <div class="flex flex-col p-4 rounded-2xl bg-surface-container-lowest shadow-[0_2px_8px_rgba(0,0,0,0.03)]"><div class="flex items-center gap-1.5 text-primary"><span class="material-symbols-outlined text-[20px]">groups</span><span class="font-headline-md text-headline-md text-on-surface font-extrabold tracking-tight">15.000+</span></div><span class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Pasien Terlayani</span></div>
                        <div class="flex flex-col p-4 rounded-2xl bg-surface-container-lowest shadow-[0_2px_8px_rgba(0,0,0,0.03)]"><div class="flex items-center gap-1.5 text-primary"><span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span><span class="font-headline-md text-headline-md text-on-surface font-extrabold tracking-tight">4.9<span class="text-label-md text-outline">/5</span></span></div><span class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Rating Kepuasan</span></div>
                        <div class="flex flex-col p-4 rounded-2xl bg-surface-container-lowest shadow-[0_2px_8px_rgba(0,0,0,0.03)]"><div class="flex items-center gap-1.5 text-primary"><span class="material-symbols-outlined text-[20px]">medical_services</span><span class="font-headline-md text-headline-md text-on-surface font-extrabold tracking-tight">10+</span></div><span class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Dokter &amp; Medis</span></div>
                    </div>
                </div>
                
                <!-- Image Visual (SUDAH DIPERBAIKI DENGAN GAMBAR HD) -->
                <div class="lg:col-span-5 relative flex justify-center">
                    <div class="absolute inset-0 m-auto w-72 h-72 rounded-full bg-primary-fixed/40 blur-3xl -z-10"></div>
                    <div class="relative w-full max-w-md">
                        <div class="relative overflow-hidden rounded-3xl bg-surface-container-lowest shadow-[0_20px_40px_-15px_rgba(0,105,72,0.18)] p-2.5">
                            <div class="rounded-2xl overflow-hidden aspect-[4/5] bg-surface-container relative">
                                <img alt="Ruang Periksa Dokter Bersih dan Nyaman" class="w-full h-full object-cover object-center transform hover:scale-105 transition-transform duration-700" src="{{ asset('hero-klinik.jpg') }}">
                            </div>
                            <div class="absolute bottom-6 left-6 right-6 p-4 rounded-2xl bg-surface-container-lowest/95 backdrop-blur-md shadow-[0_8px_20px_rgba(0,0,0,0.08)] flex items-center justify-between">
                                <div class="flex items-center gap-3"><div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary"><span class="material-symbols-outlined text-[20px]">health_and_safety</span></div><div class="flex flex-col"><span class="font-label-md text-label-md text-on-surface font-bold leading-tight">Poli Umum &amp; Gigi</span><span class="font-body-sm text-body-sm text-primary font-semibold">Siap Melayani Hari Ini</span></div></div>
                                <span class="material-symbols-outlined text-primary text-[22px]">arrow_circle_right</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: KEMITRAAN & AKREDITASI (TETAP SAMA) -->
    <section class="w-full px-6 lg:px-12 py-12 bg-surface">
        <div class="max-w-7xl mx-auto bg-surface-container-lowest rounded-3xl p-8 lg:p-12 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-outline-variant/30">
                <div><h2 class="font-headline-lg text-headline-lg text-on-surface font-bold tracking-tight">Afiliasi &amp; Kemitraan Resmi</h2></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="p-8 rounded-2xl bg-surface-container-low flex flex-col items-center text-center justify-between gap-6 group hover:bg-surface-container-lowest hover:shadow-md transition-all duration-300 border border-outline-variant/30"><div class="h-16 flex items-center justify-center"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCuwoOfGg3vIT7yIMj1k5RXgERatdrR3fytps--0-yKIrDUbLR5j1wjL35dq2rfshcoKrfu8Po2gbpiNraSAlsmnlEUrpNYLg_vp57Hd2-ZW9qerG3f2SWC_dOt2TU5CZe1e7RA9IZpKVTxI4JZ8809dB6-VMaSd4CrQj7CfnoFz53hU9tIc-AGsabD_Hr04ogxAKzumtKfsNNT26qDCNgGL-jCHgupoExpiYUoYHDudrbsAuR2UbvHuQm5ZeXQgpNTWg" alt="BPJS" class="h-14 w-auto object-contain transition-transform group-hover:scale-105"></div><div class="flex flex-col items-center"><h3 class="font-headline-sm text-headline-sm font-bold text-on-surface">BPJS Kesehatan</h3></div></div>
                <div class="p-8 rounded-2xl bg-surface-container-low flex flex-col items-center text-center justify-between gap-6 group hover:bg-surface-container-lowest hover:shadow-md transition-all duration-300 border border-outline-variant/30"><div class="h-16 flex items-center justify-center"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBH0HD9keEpyPpLEbhTQjw1j549vF_3z707rpDGfszOLhE0pchRlXdf4E17jaTj_DFl4kZ_Y4FG-Chwi2DdLkiJiXbaycHv1PgCwAsPILs7Jt30a6yrVE5jtpE08gj7XzuO4WwTXl3E3oqOunBeBPzdZGHAcY8_S6fyqvuVEMQUGIXts1PiYn6eNGpfC2NnOZYwf0ASNxZvvcK9LAhvjJ4YLyKzXvhVQEZrRIOLVlPo_0znM0pvmXDkxgKLjbyP6-w_uA" alt="GERMAS" class="h-14 w-auto object-contain transition-transform group-hover:scale-105"></div><div class="flex flex-col items-center"><h3 class="font-headline-sm text-headline-sm font-bold text-on-surface">GERMAS Kemenkes RI</h3></div></div>
                <div class="p-8 rounded-2xl bg-surface-container-low flex flex-col items-center text-center justify-between gap-6 group hover:bg-surface-container-lowest hover:shadow-md transition-all duration-300 border border-outline-variant/30"><div class="h-16 flex items-center justify-center"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4YikmhBc0EZQ0rUF4QYEu9rE8R__0SMo3GdUtArHjGDJEL1fDMv73eoDm272IJgRQ6UlcPLn7S5ittmj-YKcxtHP7CFkKK6lwaNvPdf0UiXo0h6ZL82g5Y2Fjz_EZietEujCR3nQnsIFxqLwjv1TNh6nqJDw7a-krs7IlsaWB5KGZl2SyqCPrY5MsF38_M6R7d1-ZD3x4yj4CB2PNa6s80vDg_PbekpKOWMvVVbXzJMPO4lUpc3a3_WsWM3cItDOPgQ" alt="IBI" class="h-14 w-auto object-contain transition-transform group-hover:scale-105"></div><div class="flex flex-col items-center"><h3 class="font-headline-sm text-headline-sm font-bold text-on-surface">Ikatan Bidan Indonesia</h3></div></div>
            </div>
        </div>
    </section>
</div>
<script>
    function setSearch(query) {
        const input = document.getElementById('searchServiceInput');
        if (input) {
            input.value = query;
            input.focus();
        }
    }
</script>
@endsection