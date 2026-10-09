@extends('frontend.layouts.master')

@section('content')
<div class="max-w-3xl mx-auto my-12 px-4">
    <div class="bg-surface-container-lowest rounded-3xl p-8 md:p-12 shadow-xl border border-outline-variant/20">
        
        <!-- Header Tiket -->
        <div class="text-center pb-8 border-b border-dashed border-outline-variant/40">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-secondary-container/60 text-primary font-label-md font-bold text-sm mb-3">
                <span class="material-symbols-outlined text-lg">check_circle</span>
                Pendaftaran Berhasil Terkonfirmasi
            </span>
            <h1 class="text-2xl md:text-3xl font-bold text-on-surface">Klinik Pratama Trias Medika</h1>
            <p class="text-sm text-outline mt-1">Bukti Reservasi &amp; Nomor Antrean Pasien</p>
        </div>

        <!-- Card Nomor Antrean Utama -->
        <div class="my-8 p-6 rounded-2xl bg-gradient-to-br from-primary/10 to-primary/5 border border-primary/20 text-center">
            <span class="text-xs uppercase tracking-wider font-bold text-primary block mb-1">Nomor Antrean Anda</span>
            @php
                $huruf = strtoupper(substr($janji->layanan->nama_layanan ?? 'A', 0, 1));
                $kodeAntrean = $huruf . '-' . str_pad($janji->no_antrean, 3, '0', STR_PAD_LEFT);
            @endphp
            <div class="text-5xl md:text-6xl font-black text-primary tracking-tight my-2">
                {{ $kodeAntrean }}
            </div>
            <p class="text-xs text-outline">Harap datang 15 menit sebelum sesi praktik dimulai.</p>
        </div>

        <!-- Detail Rincian Pasien & Jadwal -->
        <div class="space-y-4 text-sm font-body-md border-b border-dashed border-outline-variant/40 pb-8">
            <div class="flex justify-between py-2 border-b border-outline-variant/10">
                <span class="text-outline">Nama Pasien</span>
                <span class="font-bold text-on-surface">{{ $janji->pasien->nama_pasien }}</span>
            </div>
            <div class="flex justify-between py-2 border-b border-outline-variant/10">
                <span class="text-outline">No. WhatsApp</span>
                <span class="font-bold text-on-surface">{{ $janji->pasien->no_wa }}</span>
            </div>
            <div class="flex justify-between py-2 border-b border-outline-variant/10">
                <span class="text-outline">Poliklinik / Layanan</span>
                <span class="font-bold text-on-surface">{{ $janji->layanan->nama_layanan }} ({{ $janji->layanan->spesialisasi->nama_spesialisasi ?? 'Umum' }})</span>
            </div>
            <div class="flex justify-between py-2 border-b border-outline-variant/10">
                <span class="text-outline">Dokter Pemeriksa</span>
                <span class="font-bold text-on-surface">{{ $janji->jadwal->dokter->nama_dokter ?? 'Dokter Jaga' }}</span>
            </div>
            <div class="flex justify-between py-2 border-b border-outline-variant/10">
                <span class="text-outline">Tanggal &amp; Waktu Kedatangan</span>
                <span class="font-bold text-primary">
                    {{ \Carbon\Carbon::parse($janji->tanggal_berobat)->isoFormat('D MMMM YYYY') }} 
                    ({{ date('H:i', strtotime($janji->jadwal->jam_mulai)) }} WIB)
                </span>
            </div>
            <div class="flex justify-between py-2">
                <span class="text-outline">Estimasi Biaya Layanan</span>
                <span class="font-bold text-on-surface">Rp {{ number_format($janji->layanan->estimasi_biaya ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- QR Code Dinamis Tiket Antrean (Otomatis & Unik) -->
        <div class="my-8 p-6 bg-surface-container-low rounded-2xl border border-outline-variant/30 text-center flex flex-col items-center">
            <span class="font-bold text-on-surface text-base mb-1">QR Code Tiket Antrean</span>
            <p class="text-xs text-outline mb-4">Tunjukkan QR Code ini kepada resepsionis klinik saat kedatangan untuk verifikasi nomor antrean.</p>
            <div class="p-4 bg-white rounded-2xl shadow-md inline-block border border-outline-variant/20">
                {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(160)->margin(1)->generate($qrUrl ?? route('booking.success', $janji->id)) !!}
            </div>
            <span class="text-xs text-outline font-semibold mt-3">Kode Booking: #TR3S-{{ $janji->id }}</span>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-8 flex flex-col sm:flex-row gap-4">
            <a href="{{ route('booking.pdf', $janji->id) }}" class="flex-1 py-3.5 px-6 rounded-xl bg-primary text-on-primary font-bold text-center shadow-lg hover:bg-primary-container transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">download</span>
                Download Tiket PDF
            </a>
            <a href="/" class="py-3.5 px-6 rounded-xl border border-outline-variant/40 text-on-surface font-bold text-center hover:bg-surface-container-low transition-all">
                Kembali ke Beranda
            </a>
        </div>

    </div>
</div>
@endsection