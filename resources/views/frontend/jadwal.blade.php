@extends('frontend.layouts.master')

@section('content')
<div class="flex flex-col w-full">
    <div class="relative w-full max-w-7xl mx-auto px-6 md:px-12 pt-10 pb-16">
        <div class="absolute top-12 left-1/2 -translate-x-1/2 w-3/4 h-64 bg-gradient-to-r from-secondary-container/20 via-primary-fixed/20 to-surface-container-low blur-3xl pointer-events-none -z-10 rounded-full"></div>
        
        <!-- Section 1: Page Title Area -->
        <section class="flex flex-col gap-4 mb-16 text-left">
            <div class="flex flex-wrap items-center gap-4">
                <span class="inline-flex items-center gap-1.5 px-4 py-1 rounded-full bg-surface-container-lowest text-primary shadow-sm font-label-sm text-label-sm">
                    <span class="material-symbols-outlined text-[16px] text-primary">verified</span>
                    JADWAL DOKTER &amp; FASILITAS TERINTEGRASI
                </span>
                <div class="flex items-center gap-1.5 px-4 py-1 rounded-full bg-surface-container-low text-on-surface-variant font-label-sm text-label-sm">
                    <span class="inline-block w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span>Update Terakhir: Hari ini | Pelayanan Buka: 08.00 - 21.00 WIB</span>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4 mt-2">
                <div class="max-w-3xl">
                    <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight leading-tight">
                        Jadwal Praktik Dokter &amp; Detail Layanan
                    </h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant mt-2 leading-relaxed">
                        Temukan jadwal dokter umum, dokter gigi, dan bidan kandungan kami. Lakukan reservasi lebih awal untuk kemudahan pemeriksaan tanpa antre berlama-lama di klinik.
                    </p>
                </div>
                <div class="flex items-center gap-4 p-4 rounded-2xl bg-surface-container-lowest shadow-sm flex-shrink-0">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-low flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-[28px]">groups</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5 font-label-sm text-label-sm text-outline uppercase tracking-wider">
                            <span class="w-2 h-2 rounded-full bg-primary animate-ping"></span>
                            Antrean Poli Berjalan
                        </div>
                        <div class="font-headline-lg text-headline-lg text-primary font-bold">
                            B-024 <span class="font-body-sm text-body-sm text-on-surface-variant font-normal">/ {{ $jadwals->count() }} Dokter Praktik</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: Interactive Filter Section -->
        <form action="{{ route('jadwal') }}" method="GET" class="mb-16 bg-surface-container-lowest rounded-2xl p-6 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                
                <!-- Dropdown Spesialisasi Dinamis dari DB -->
                <div class="md:col-span-3 flex flex-col gap-1.5">
                    <label class="font-label-md text-label-md text-on-surface-variant flex items-center gap-1" for="filter-specialty">
                        <span class="material-symbols-outlined text-[16px] text-primary">medical_services</span> Pilih Spesialisasi
                    </label>
                    <div class="relative">
                        <select name="spesialisasi" onchange="this.form.submit()" class="w-full h-12 px-4 pr-10 rounded-xl bg-surface-container-low text-on-surface font-label-md text-label-md focus:bg-surface-container-lowest focus:outline-none appearance-none transition-all cursor-pointer" id="filter-specialty">
                            <option value="">Semua Spesialisasi</option>
                            @foreach($spesialisasis as $item)
                                <option value="{{ $item->nama_spesialisasi }}" {{ request('spesialisasi') == $item->nama_spesialisasi || Str::contains(request('spesialisasi'), str_replace('Dokter ', '', $item->nama_spesialisasi)) ? 'selected' : '' }}>
                                    {{ $item->nama_spesialisasi }}
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-outline text-[20px]">expand_more</span>
                    </div>
                </div>
                
                <!-- Dropdown Hari Praktik -->
                <div class="md:col-span-3 flex flex-col gap-1.5">
                    <label class="font-label-md text-label-md text-on-surface-variant flex items-center gap-1" for="filter-day">
                        <span class="material-symbols-outlined text-[16px] text-primary">event</span> Pilih Hari Praktik
                    </label>
                    <div class="relative">
                        <select name="hari" onchange="this.form.submit()" class="w-full h-12 px-4 pr-10 rounded-xl bg-surface-container-low text-on-surface font-label-md text-label-md focus:bg-surface-container-lowest focus:outline-none appearance-none transition-all cursor-pointer" id="filter-day">
                            <option value="">Semua Hari</option>
                            <option value="Senin" {{ request('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ request('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ request('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ request('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ request('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ request('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            <option value="Minggu" {{ request('hari') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-outline text-[20px]">expand_more</span>
                    </div>
                </div>
                
                <!-- Search Input -->
                <div class="md:col-span-6 flex flex-col gap-1.5">
                    <label class="font-label-md text-label-md text-on-surface-variant flex items-center gap-1" for="search-doctor">
                        <span class="material-symbols-outlined text-[16px] text-primary">search</span> Pencarian Cepat
                    </label>
                    <div class="relative flex">
                        <input name="q" value="{{ request('q') }}" class="w-full h-12 pl-11 pr-4 rounded-xl bg-surface-container-low text-on-surface placeholder:text-outline font-body-md text-body-md focus:bg-surface-container-lowest focus:outline-none transition-all" id="search-doctor" placeholder="Cari nama dokter atau keahlian..." type="text">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-outline text-[20px]">person_search</span>
                        <button type="submit" class="hidden">Cari</button>
                    </div>
                </div>
            </div>
            
            <!-- Quick Filter Chips Dinamis -->
            <div class="flex flex-wrap items-center gap-2 mt-4 pt-4 border-t border-outline-variant/30">
                <span class="font-label-sm text-label-sm text-outline mr-2">Kategori Cepat:</span>
                
                <a href="{{ route('jadwal') }}" class="px-4 py-1.5 rounded-full {{ !request('spesialisasi') ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container' }} font-label-md text-label-md transition-all">
                    Semua
                </a>
                @foreach($spesialisasis as $item)
                <a href="{{ route('jadwal', ['spesialisasi' => $item->nama_spesialisasi]) }}" class="px-4 py-1.5 rounded-full {{ request('spesialisasi') == $item->nama_spesialisasi ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container' }} font-label-md text-label-md transition-all">
                    {{ $item->nama_spesialisasi }}
                </a>
                @endforeach
            </div>
        </form>

        <!-- Section 3: Schedule Grid -->
        <section class="mb-16">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <span class="font-label-sm text-label-sm text-primary uppercase tracking-wider font-bold">PRAKTIK DOKTER KLINIK</span>
                    <h2 class="font-headline-xl text-headline-xl text-on-surface">Dokter Berpengalaman Siap Melayani</h2>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($jadwals as $jadwal)
                <article class="flex flex-col justify-between rounded-2xl bg-surface-container-lowest p-6 shadow-sm hover:shadow-md transition-all duration-300 group">
                    <div>
                        <div class="flex items-start gap-4 mb-4">
                            <div class="relative">
                                <img alt="{{ $jadwal->dokter->nama_dokter ?? 'Dokter' }}" class="w-20 h-20 rounded-2xl object-cover shadow-sm group-hover:scale-105 transition-transform duration-300" src="https://ui-avatars.com/api/?name={{ urlencode($jadwal->dokter->nama_dokter ?? 'Dokter') }}&background=006948&color=fff&size=150">
                                <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-primary ring-2 ring-surface-container-lowest" title="Aktif Bertugas"></span>
                            </div>
                            <div class="flex flex-col flex-1">
                                <span class="inline-block px-2.5 py-0.5 rounded-full bg-surface-container-low text-primary font-label-sm text-label-sm w-fit mb-1">{{ $jadwal->dokter->spesialisasi ?? 'Poli Klinik' }}</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">{{ $jadwal->dokter->nama_dokter ?? 'Belum ada dokter' }}</h3>
                            </div>
                        </div>
                        <div class="p-4 rounded-xl bg-surface-container-low flex flex-col gap-2 mb-4">
                            <div class="flex items-center justify-between font-label-md text-label-md text-on-surface pt-0.5">
                                <span class="font-semibold">{{ $jadwal->hari }}</span>
                                <span class="px-2 py-0.5 rounded-md bg-surface-container-lowest font-medium">
                                    {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai ?? $jadwal->jam_mulai)) }} WIB
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 pt-2">
                        <!-- Mengirimkan parameter jadwal_id secara presisi -->
                        <a class="w-full h-12 flex items-center justify-center gap-2 rounded-xl bg-primary text-on-primary font-label-lg text-label-lg shadow-sm hover:bg-primary-container transition-colors" href="{{ route('booking.create', ['jadwal_id' => $jadwal->id]) }}">
                            <span class="material-symbols-outlined text-[20px]">calendar_month</span> Booking Sekarang
                        </a>
                    </div>
                </article>
                @empty
                <div class="col-span-full py-12 text-center text-on-surface-variant font-body-lg">
                    Tidak ada jadwal dokter yang sesuai dengan pencarian Anda saat ini.
                </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection