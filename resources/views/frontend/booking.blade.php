@extends('frontend.layouts.master')

@section('content')
<div class="flex flex-col w-full">
    <div class="relative w-full max-w-7xl mx-auto px-6 lg:px-12 pt-10 pb-12">
        
        <!-- Header Banner & Booking Stepper -->
        <div class="bg-surface-container-lowest rounded-2xl p-6 md:p-10 shadow-[0_4px_20px_-4px_rgba(0,108,74,0.06)] mb-10">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 px-4 py-1 rounded-full bg-secondary-container/40 text-on-secondary-container font-label-sm text-label-sm font-bold uppercase tracking-wider mb-2">
                        <span class="material-symbols-outlined text-sm">assignment_turned_in</span>
                        Pendaftaran Mandiri Pasien
                    </span>
                    <h1 class="font-headline-xl text-headline-xl text-primary font-bold tracking-tight mt-1 mb-2">
                        Formulir Pendaftaran &amp; Booking Jadwal
                    </h1>
                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                        Isi data Anda untuk mendapatkan nomor antrean poli dan kepastian jadwal dokter tanpa harus mengantre lama di ruang tunggu klinik.
                    </p>
                </div>
            </div>
        </div>

        <!-- NOTIFIKASI SUKSES / ERROR -->
        @if(session('success'))
        <div class="mb-8 p-6 rounded-2xl bg-secondary-container text-on-secondary-container border border-secondary/20 shadow-sm flex flex-col items-center justify-center text-center">
            <span class="material-symbols-outlined text-[48px] text-primary mb-2">check_circle</span>
            <h2 class="font-headline-lg text-headline-lg font-bold mb-2">{{ session('success') }}</h2>
            <p class="font-body-md text-body-md">Silakan tangkap layar (screenshot) halaman ini dan tunjukkan ke resepsionis saat kedatangan.</p>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-8 p-6 rounded-2xl bg-error-container text-on-error-container border border-error/20 shadow-sm">
            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined text-error">error</span>
                <h3 class="font-headline-sm font-bold text-error">Pendaftaran Gagal</h3>
            </div>
            <ul class="list-disc list-inside font-body-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT COLUMN: Informasi Klinik -->
            <aside class="lg:col-span-5 flex flex-col gap-4 lg:sticky lg:top-24">
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-[0_8px_30px_-8px_rgba(0,108,74,0.08)] bg-gradient-to-b from-surface-container-lowest via-surface-container-lowest to-surface-container-low/30">
                    <div class="flex items-center justify-between pb-2 mb-4 bg-surface-container-low px-4 py-2 rounded-xl">
                        <div class="flex items-center gap-2 text-primary">
                            <span class="material-symbols-outlined text-headline-sm">stethoscope</span>
                            <span class="font-headline-sm text-headline-sm text-on-surface font-bold">Informasi Pelayanan</span>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center gap-4 p-3 bg-surface-container-low rounded-xl">
                            <span class="material-symbols-outlined text-primary text-xl">credit_card</span>
                            <div class="flex-1">
                                <span class="block font-label-sm text-label-sm text-outline">Skema Pembayaran</span>
                                <span class="font-label-md text-label-md text-on-surface font-bold">BPJS Kesehatan &amp; Umum</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 bg-surface-container-low rounded-xl">
                            <span class="material-symbols-outlined text-primary text-xl">health_and_safety</span>
                            <div class="flex-1">
                                <span class="block font-label-sm text-label-sm text-outline">Rekam Medis</span>
                                <span class="font-label-md text-label-md text-on-surface font-bold">Terintegrasi SatuSehat</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 rounded-xl bg-secondary-container/20 flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-headline-sm shrink-0">emergency</span>
                        <div class="text-left font-body-sm text-body-sm text-on-surface">
                            <span class="font-label-md text-label-md text-primary font-bold block mb-0.5">Butuh Penanganan Gawat Segera?</span>
                            Kondisi gawat darurat dapat langsung menuju Instalasi Gawat Darurat (IGD) 24 Jam kami tanpa perlu booking reservasi antrean online.
                        </div>
                    </div>
                </div>
            </aside>

            <!-- RIGHT COLUMN: Booking Form -->
            <main class="lg:col-span-7 flex flex-col gap-6">
                <form action="{{ route('booking.store') }}" method="POST" class="bg-surface-container-lowest rounded-2xl p-6 md:p-10 shadow-[0_12px_40px_-10px_rgba(0,108,74,0.09)] flex flex-col gap-10">
                    @csrf

                    <!-- SECTION 1: Data Pasien -->
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-2 pb-2">
                            <div class="w-9 h-9 rounded-xl bg-secondary-container/40 text-primary flex items-center justify-center font-bold">
                                <span class="material-symbols-outlined text-xl">person</span>
                            </div>
                            <div>
                                <h2 class="font-headline-md text-headline-md text-on-surface font-bold">1. Identitas Pasien</h2>
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-md text-label-md text-on-surface font-bold" for="patient_name">Nama Lengkap Sesuai KTP <span class="text-error">*</span></label>
                            <div class="relative flex items-center">
                                <span class="material-symbols-outlined absolute left-3.5 text-outline text-xl pointer-events-none">badge</span>
                                <input class="w-full h-12 pl-11 pr-4 rounded-xl bg-surface-container-lowest font-body-md text-body-md text-on-surface shadow-sm focus:outline-none focus:ring-2 focus:ring-primary border border-outline-variant/30" id="patient_name" name="nama_pasien" placeholder="Contoh: Budi Santoso" required type="text" value="{{ old('nama_pasien') }}">
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-md text-label-md text-on-surface font-bold" for="patient_phone">Nomor WhatsApp Aktif <span class="text-error">*</span></label>
                            <div class="relative flex items-center">
                                <span class="material-symbols-outlined absolute left-3.5 text-outline text-xl pointer-events-none">chat</span>
                                <input class="w-full h-12 pl-11 pr-4 rounded-xl bg-surface-container-lowest font-body-md text-body-md text-on-surface shadow-sm focus:outline-none focus:ring-2 focus:ring-primary border border-outline-variant/30" id="patient_phone" name="no_hp" placeholder="Contoh: 081288997722" required type="tel" value="{{ old('no_hp') }}">
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: Pemilihan Layanan & Jadwal -->
                    <div class="flex flex-col gap-4 pt-2">
                        <div class="flex items-center gap-2 pb-2">
                            <div class="w-9 h-9 rounded-xl bg-secondary-container/40 text-primary flex items-center justify-center font-bold">
                                <span class="material-symbols-outlined text-xl">medical_services</span>
                            </div>
                            <div>
                                <h2 class="font-headline-md text-headline-md text-on-surface font-bold">2. Layanan &amp; Jadwal</h2>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Layanan Dropdown (Relasional DB) -->
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-md text-label-md text-on-surface font-bold" for="layananSelect">Poliklinik / Layanan <span class="text-error">*</span></label>
                                <div class="relative flex items-center">
                                    <span class="material-symbols-outlined absolute left-3.5 text-outline text-xl pointer-events-none">local_hospital</span>
                                    <select class="w-full h-12 pl-11 pr-8 rounded-xl bg-surface-container-lowest font-body-md text-body-md text-on-surface shadow-sm focus:outline-none focus:ring-2 focus:ring-primary appearance-none border border-outline-variant/30 cursor-pointer" id="layananSelect" name="layanan_id" required>
                                        <option value="" data-spesialisasi-id="" data-spesialisasi="">-- Pilih Layanan --</option>
                                        @foreach($layanans as $layanan)
                                            @php
                                                $specNama = $layanan->spesialisasi->nama_spesialisasi ?? 'Umum';
                                                $specId = $layanan->spesialisasi_id ?? '';
                                            @endphp
                                            <option value="{{ $layanan->id }}" 
                                                    data-spesialisasi-id="{{ $specId }}" 
                                                    data-spesialisasi="{{ $specNama }}" 
                                                    {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}>
                                                {{ $layanan->nama_layanan }} ({{ $specNama }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 text-outline pointer-events-none">expand_more</span>
                                </div>
                            </div>

                            <!-- Dokter Dropdown -->
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-md text-label-md text-on-surface font-bold" for="jadwalSelect">Dokter &amp; Sesi Praktik <span class="text-error">*</span></label>
                                <div class="relative flex items-center">
                                    <span class="material-symbols-outlined absolute left-3.5 text-outline text-xl pointer-events-none">schedule</span>
                                    <select class="w-full h-12 pl-11 pr-8 rounded-xl bg-surface-container-lowest font-body-md text-body-md text-on-surface shadow-sm focus:outline-none focus:ring-2 focus:ring-primary appearance-none border border-outline-variant/30 cursor-pointer" id="jadwalSelect" name="jadwal_id" required>
                                        <option value="" data-spesialisasi-id="" data-spesialisasi="" data-dokter-id="">-- Pilih Jadwal Dokter --</option>
                                        @foreach($jadwals as $jadwal)
                                            @php
                                                $dokterObj = $jadwal->dokter;
                                                $dokterSpec = is_object($dokterObj->spesialisasi) ? $dokterObj->spesialisasi->nama_spesialisasi : ($dokterObj->spesialisasi ?? 'Umum');
                                                $dokterSpecId = is_object($dokterObj->spesialisasi) ? $dokterObj->spesialisasi->id : ($dokterObj->spesialisasi_id ?? '');
                                                $isPreselected = (isset($selectedJadwalId) && $selectedJadwalId == $jadwal->id) || old('jadwal_id') == $jadwal->id;
                                            @endphp
                                            <option value="{{ $jadwal->id }}" 
                                                    data-spesialisasi-id="{{ $dokterSpecId }}"
                                                    data-spesialisasi="{{ $dokterSpec }}"
                                                    data-dokter-id="{{ $jadwal->dokter_id }}"
                                                    {{ $isPreselected ? 'selected' : '' }}>
                                                {{ $dokterObj->nama_dokter ?? 'Dokter' }} ({{ $jadwal->hari }}, {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai ?? $jadwal->jam_mulai)) }} WIB)
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 text-outline pointer-events-none">expand_more</span>
                                </div>
                                <!-- Notifikasi Filter Dokter Khusus -->
                                @if(isset($selectedDokterId) && $selectedDokterId)
                                <div id="filterDoctorNotice" class="flex items-center justify-between font-body-sm text-body-sm text-primary mt-1 px-1">
                                    <span>Menampilkan sesi dokter terpilih.</span>
                                    <button type="button" id="btnShowAllDoctors" class="underline hover:text-primary-container font-semibold cursor-pointer">Tampilkan Semua Dokter</button>
                                </div>
                                @endif
                            </div>

                            <!-- Tanggal Berobat (Diproteksi Zona Waktu Asia/Jakarta) -->
                            <div class="flex flex-col gap-1.5 md:col-span-2">
                                <label class="font-label-md text-label-md text-on-surface font-bold" for="booking_date">Rencana Tanggal Kedatangan <span class="text-error">*</span></label>
                                <div class="relative flex items-center">
                                    <span class="material-symbols-outlined absolute left-3.5 text-outline text-xl pointer-events-none">today</span>
                                    <input class="w-full h-12 pl-11 pr-4 rounded-xl bg-surface-container-lowest font-body-md text-body-md text-on-surface shadow-sm focus:outline-none focus:ring-2 focus:ring-primary border border-outline-variant/30" 
                                           id="booking_date" 
                                           min="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d') }}" 
                                           name="tanggal" 
                                           required 
                                           type="date" 
                                           value="{{ old('tanggal', \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d')) }}">
                                </div>
                                <span class="font-body-sm text-body-sm text-outline mt-1">Pastikan tanggal yang dipilih sesuai dengan hari praktik dokter.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Primary CTA Action Section -->
                    <div class="flex flex-col gap-4 mt-4">
                        <button class="w-full py-4 px-6 rounded-xl bg-primary text-on-primary font-headline-sm text-headline-sm font-bold shadow-[0_12px_24px_-6px_rgba(0,105,72,0.35)] hover:bg-primary-container active:scale-[0.99] transition-all flex items-center justify-center gap-3 cursor-pointer" type="submit">
                            <span class="material-symbols-outlined text-2xl">confirmation_number</span>
                            <span>Ambil Nomor Antrean Sekarang</span>
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>

<!-- JavaScript Filter Presisi Murni (Strict Filtering) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const layananSelect = document.getElementById('layananSelect');
    const jadwalSelect = document.getElementById('jadwalSelect');
    const layananOptions = Array.from(layananSelect.options);
    const jadwalOptions = Array.from(jadwalSelect.options);
    const btnShowAllDoctors = document.getElementById('btnShowAllDoctors');
    const filterDoctorNotice = document.getElementById('filterDoctorNotice');

    const selectedDokterId = "{{ $selectedDokterId ?? '' }}";

    // Filter Layanan secara Ketat berdasarkan Spesialisasi Dokter
    function filterLayananByDokter(docSpecId, docSpecName) {
        let validLayananFound = false;

        layananOptions.forEach(option => {
            if (option.value === '') {
                option.style.display = 'block';
                return;
            }

            const optSpecId = option.getAttribute('data-spesialisasi-id');
            const optSpecName = (option.getAttribute('data-spesialisasi') || '').toLowerCase().trim();
            const targetSpecName = (docSpecName || '').toLowerCase().trim();

            // Cek kecocokan mutlak berdasarkan ID atau nama spesialisasi
            const isMatched = (docSpecId && optSpecId && docSpecId === optSpecId) || 
                              (targetSpecName && optSpecName && (targetSpecName.includes(optSpecName) || optSpecName.includes(targetSpecName)));

            if (isMatched) {
                option.style.display = 'block';
                option.disabled = false;
                if (!validLayananFound) {
                    layananSelect.value = option.value;
                    validLayananFound = true;
                }
            } else {
                option.style.display = 'none';
                option.disabled = true;
            }
        });

        // Jika dokter yang dipilih tidak memiliki layanan sama sekali, atur ke default
        if (!validLayananFound) {
            layananSelect.value = '';
        }
    }

    // 1. Inisialisasi awal saat halaman dibuka dari tombol 'Booking Sekarang' dokter tertentu
    if (selectedDokterId) {
        let activeDocSpecId = '';
        let activeDocSpecName = '';

        jadwalOptions.forEach(option => {
            if (option.value === '') return;
            const docId = option.getAttribute('data-dokter-id');
            if (docId === selectedDokterId) {
                option.style.display = 'block';
                option.disabled = false;
                if (!activeDocSpecId) activeDocSpecId = option.getAttribute('data-spesialisasi-id');
                if (!activeDocSpecName) activeDocSpecName = option.getAttribute('data-spesialisasi');
            } else {
                option.style.display = 'none';
                option.disabled = true;
            }
        });

        filterLayananByDokter(activeDocSpecId, activeDocSpecName);
    }

    // 2. Filter otomatis saat pengguna mengganti Dokter pada dropdown
    jadwalSelect.addEventListener('change', function () {
        const selectedJadwal = jadwalSelect.options[jadwalSelect.selectedIndex];
        if (selectedJadwal && selectedJadwal.value !== '') {
            const docSpecId = selectedJadwal.getAttribute('data-spesialisasi-id');
            const docSpecName = selectedJadwal.getAttribute('data-spesialisasi');
            filterLayananByDokter(docSpecId, docSpecName);
        } else {
            // Tampilkan kembali semua opsi layanan jika opsi dokter dikosongkan
            layananOptions.forEach(opt => { opt.style.display = 'block'; opt.disabled = false; });
        }
    });

    // 3. Reset filter via tombol 'Tampilkan Semua Dokter'
    if (btnShowAllDoctors) {
        btnShowAllDoctors.addEventListener('click', function () {
            jadwalOptions.forEach(opt => { opt.style.display = 'block'; opt.disabled = false; });
            layananOptions.forEach(opt => { opt.style.display = 'block'; opt.disabled = false; });
            if (filterDoctorNotice) filterDoctorNotice.style.display = 'none';
            layananSelect.value = '';
            jadwalSelect.value = '';
        });
    }

    // 4. Filter Dokter saat pengguna memilih Layanan terlebih dahulu
    layananSelect.addEventListener('change', function () {
        const selectedLayanan = layananSelect.options[layananSelect.selectedIndex];
        const targetSpecId = selectedLayanan ? selectedLayanan.getAttribute('data-spesialisasi-id') : '';
        const targetSpecName = selectedLayanan ? (selectedLayanan.getAttribute('data-spesialisasi') || '').toLowerCase().trim() : '';

        jadwalOptions.forEach(option => {
            if (option.value === '') return;
            const doctorSpecId = option.getAttribute('data-spesialisasi-id');
            const doctorSpecName = (option.getAttribute('data-spesialisasi') || '').toLowerCase().trim();

            const isMatched = !targetSpecId && !targetSpecName ? true :
                              (targetSpecId && doctorSpecId && targetSpecId === doctorSpecId) ||
                              (targetSpecName && doctorSpecName && (doctorSpecName.includes(targetSpecName) || targetSpecName.includes(doctorSpecName)));

            if (isMatched) {
                option.style.display = 'block';
                option.disabled = false;
            } else {
                option.style.display = 'none';
                option.disabled = true;
            }
        });

        if (filterDoctorNotice) filterDoctorNotice.style.display = 'none';
    });
});
</script>
@endsection