@extends('frontend.layouts.master')

@section('content')
<div class="flex flex-col w-full">
    <div class="relative w-full max-w-7xl mx-auto px-6 lg:px-12 pt-10 pb-12">
        
        <!-- Header Banner & Booking Stepper -->
        <div class="bg-surface-container-lowest rounded-2xl p-6 md:p-10 shadow-[0_4px_20px_-4px_rgba(0,108,74,0.06)] mb-10">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 px-4 py-1 rounded-full bg-secondary-container/40 text-on-secondary-container font-label-sm text-label-sm font-bold uppercase tracking-wider mb-2">
                        <!-- IKON: assignment_turned_in -->
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm-2 14l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
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
            <!-- IKON: check_circle -->
            <svg class="w-12 h-12 fill-primary mb-2" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            <h2 class="font-headline-lg text-headline-lg font-bold mb-2">{{ session('success') }}</h2>
            <p class="font-body-md text-body-md">Silakan tangkap layar (screenshot) halaman ini dan tunjukkan ke resepsionis saat kedatangan.</p>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-8 p-6 rounded-2xl bg-error-container text-on-error-container border border-error/20 shadow-sm">
            <div class="flex items-center gap-2 mb-2">
                <!-- IKON: error -->
                <svg class="w-5 h-5 fill-error" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
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
                            <!-- IKON: stethoscope -->
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 8c-1.1 0-2 .9-2 2v3c0 2.76-2.24 5-5 5s-5-2.24-5-5v-3c0-1.1-.9-2-2-2s-2 .9-2 2v3c0 4.97 4.03 9 9 9s9-4.03 9-9v-3c0-1.1-.9-2-2-2zm-7-6c-1.1 0-2 .9-2 2v2H9V4c0-1.1-.9-2-2-2z"/></svg>
                            <span class="font-headline-sm text-headline-sm text-on-surface font-bold">Informasi Pelayanan</span>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center gap-4 p-3 bg-surface-container-low rounded-xl">
                            <!-- IKON: credit_card -->
                            <svg class="w-5 h-5 fill-primary" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
                            <div class="flex-1">
                                <span class="block font-label-sm text-label-sm text-outline">Skema Pembayaran</span>
                                <span class="font-label-md text-label-md text-on-surface font-bold">BPJS Kesehatan &amp; Umum</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 bg-surface-container-low rounded-xl">
                            <!-- IKON: health_and_safety -->
                            <svg class="w-5 h-5 fill-primary" viewBox="0 0 24 24" aria-hidden="true"><path d="M10.5 13H8v-3h2.5V7.5h3V10H16v3h-2.5v2.5h-3V13zM12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91 4.59-1.15 8-5.86 8-10.91V5l-8-3z"/></svg>
                            <div class="flex-1">
                                <span class="block font-label-sm text-label-sm text-outline">Rekam Medis</span>
                                <span class="font-label-md text-label-md text-on-surface font-bold">Terintegrasi SatuSehat</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 rounded-xl bg-secondary-container/20 flex items-start gap-3">
                        <!-- IKON: emergency -->
                        <svg class="w-6 h-6 fill-primary shrink-0" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 9.5h-5.77l4.08-4.08-2.12-2.12-4.08 4.08V1.5h-3v5.88L5.53 3.3 3.41 5.42l4.08 4.08H1.5v3h5.99l-4.08 4.08 2.12 2.12 4.08-4.08v5.88h3v-5.88l4.08 4.08 2.12-2.12-4.08-4.08h5.77v-3z"/></svg>
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
                                <!-- IKON: person -->
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            </div>
                            <div>
                                <h2 class="font-headline-md text-headline-md text-on-surface font-bold">1. Identitas Pasien</h2>
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-md text-label-md text-on-surface font-bold" for="patient_name">Nama Lengkap Sesuai KTP <span class="text-error">*</span></label>
                            <div class="relative flex items-center">
                                <!-- IKON: badge -->
                                <svg class="w-5 h-5 fill-outline absolute left-3.5 pointer-events-none" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 7h-5V4c0-1.1-.9-2-2-2h-2c-1.1 0-2 .9-2 2v3H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zM11 4h2v3h-2V4zm-1 8c0-.55.45-1 1-1s1 .45 1 1-.45 1-1 1-1-.45-1-1zm3 4h-4v-1c0-.67 1.34-1 2-1s2 .33 2 1v1z"/></svg>
                                <input class="w-full h-12 pl-11 pr-4 rounded-xl bg-surface-container-lowest font-body-md text-body-md text-on-surface shadow-sm focus:outline-none focus:ring-2 focus:ring-primary border border-outline-variant/30" id="patient_name" name="nama_pasien" placeholder="Contoh: Budi Santoso" required type="text" value="{{ old('nama_pasien') }}">
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-md text-label-md text-on-surface font-bold" for="patient_phone">Nomor WhatsApp Aktif <span class="text-error">*</span></label>
                            <div class="relative flex items-center">
                                <!-- IKON: chat -->
                                <svg class="w-5 h-5 fill-outline absolute left-3.5 pointer-events-none" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z"/></svg>
                                <input class="w-full h-12 pl-11 pr-4 rounded-xl bg-surface-container-lowest font-body-md text-body-md text-on-surface shadow-sm focus:outline-none focus:ring-2 focus:ring-primary border border-outline-variant/30" id="patient_phone" name="no_hp" placeholder="Contoh: 081288997722" required type="tel" value="{{ old('no_hp') }}">
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: Pemilihan Layanan & Jadwal -->
                    <div class="flex flex-col gap-4 pt-2">
                        <div class="flex items-center gap-2 pb-2">
                            <div class="w-9 h-9 rounded-xl bg-secondary-container/40 text-primary flex items-center justify-center font-bold">
                                <!-- IKON: medical_services -->
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM10 4h4v2h-4V4zm10 15H4V8h16v11zm-7-9h-2v3H8v2h3v3h2v-3h3v-2h-3v-3z"/></svg>
                            </div>
                            <div>
                                <h2 class="font-headline-md text-headline-md text-on-surface font-bold">2. Layanan &amp; Jadwal</h2>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Layanan Dropdown -->
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-md text-label-md text-on-surface font-bold" for="layananSelect">Poliklinik / Layanan <span class="text-error">*</span></label>
                                <div class="relative flex items-center">
                                    <!-- IKON: local_hospital -->
                                    <svg class="w-5 h-5 fill-outline absolute left-3.5 pointer-events-none" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 3H5c-1.1 0-1.99.9-1.99 2L3 19c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
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
                                    <!-- IKON: expand_more -->
                                    <svg class="w-5 h-5 fill-outline absolute right-3 pointer-events-none" viewBox="0 0 24 24" aria-hidden="true"><path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/></svg>
                                </div>
                            </div>

                            <!-- Dokter Dropdown -->
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-md text-label-md text-on-surface font-bold" for="jadwalSelect">Dokter &amp; Sesi Praktik <span class="text-error">*</span></label>
                                <div class="relative flex items-center">
                                    <!-- IKON: schedule -->
                                    <svg class="w-5 h-5 fill-outline absolute left-3.5 pointer-events-none" viewBox="0 0 24 24" aria-hidden="true"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
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
                                    <!-- IKON: expand_more -->
                                    <svg class="w-5 h-5 fill-outline absolute right-3 pointer-events-none" viewBox="0 0 24 24" aria-hidden="true"><path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/></svg>
                                </div>
                                @if(isset($selectedDokterId) && $selectedDokterId)
                                <div id="filterDoctorNotice" class="flex items-center justify-between font-body-sm text-body-sm text-primary mt-1 px-1">
                                    <span>Menampilkan sesi dokter terpilih.</span>
                                    <button type="button" id="btnShowAllDoctors" class="underline hover:text-primary-container font-semibold cursor-pointer">Tampilkan Semua Dokter</button>
                                </div>
                                @endif
                            </div>

                            <!-- Tanggal Berobat -->
                            <div class="flex flex-col gap-1.5 md:col-span-2">
                                <label class="font-label-md text-label-md text-on-surface font-bold" for="booking_date">Rencana Tanggal Kedatangan <span class="text-error">*</span></label>
                                <div class="relative flex items-center">
                                    <!-- IKON: today -->
                                    <svg class="w-5 h-5 fill-outline absolute left-3.5 pointer-events-none" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>
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
                            <!-- IKON: confirmation_number -->
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 10V6c0-1.11-.9-2-2-2H4c-1.1 0-1.99.89-1.99 2v4c1.1 0 1.99.9 1.99 2s-.89 2-2 2v4c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-4c-1.1 0-2-.9-2-2s.9-2 2-2zm-9 7.5h-2v-2h2v2zm0-4.5h-2v-2h2v2zm0-4.5h-2v-2h2v2z"/></svg>
                            <span>Ambil Nomor Antrean Sekarang</span>
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const layananSelect = document.getElementById('layananSelect');
    const jadwalSelect = document.getElementById('jadwalSelect');
    const layananOptions = Array.from(layananSelect.options);
    const jadwalOptions = Array.from(jadwalSelect.options);
    const btnShowAllDoctors = document.getElementById('btnShowAllDoctors');
    const filterDoctorNotice = document.getElementById('filterDoctorNotice');

    const selectedDokterId = "{{ $selectedDokterId ?? '' }}";

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

        if (!validLayananFound) {
            layananSelect.value = '';
        }
    }

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

    jadwalSelect.addEventListener('change', function () {
        const selectedJadwal = jadwalSelect.options[jadwalSelect.selectedIndex];
        if (selectedJadwal && selectedJadwal.value !== '') {
            const docSpecId = selectedJadwal.getAttribute('data-spesialisasi-id');
            const docSpecName = selectedJadwal.getAttribute('data-spesialisasi');
            filterLayananByDokter(docSpecId, docSpecName);
        } else {
            layananOptions.forEach(opt => { opt.style.display = 'block'; opt.disabled = false; });
        }
    });

    if (btnShowAllDoctors) {
        btnShowAllDoctors.addEventListener('click', function () {
            jadwalOptions.forEach(opt => { opt.style.display = 'block'; opt.disabled = false; });
            layananOptions.forEach(opt => { opt.style.display = 'block'; opt.disabled = false; });
            if (filterDoctorNotice) filterDoctorNotice.style.display = 'none';
            layananSelect.value = '';
            jadwalSelect.value = '';
        });
    }

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