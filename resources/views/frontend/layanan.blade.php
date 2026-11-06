@extends('frontend.layouts.master')

@section('content')
<div class="flex flex-col w-full">
    <div class="relative w-full max-w-7xl mx-auto px-6 lg:px-12 pt-12 pb-16">
        <!-- Ambient Background -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-64 bg-gradient-to-b from-primary-fixed/20 to-transparent blur-3xl pointer-events-none -z-10 rounded-full"></div>

        <!-- Header Section -->
        <div class="flex flex-col items-center text-center max-w-3xl mx-auto mb-16">
            <span class="inline-flex items-center gap-1.5 px-4 py-1 rounded-full bg-surface-container-lowest text-primary shadow-sm font-label-sm text-label-sm uppercase tracking-wider font-bold mb-4">
                <!-- IKON: medical_services -->
                <svg class="w-4 h-4 fill-primary" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM10 4h4v2h-4V4zm10 15H4V8h16v11zm-7-9h-2v3H8v2h3v3h2v-3h3v-2h-3v-3z"/></svg>
                Transparansi Biaya
            </span>
            <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight font-extrabold">
                Layanan &amp; <span class="text-primary">Estimasi Biaya</span>
            </h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-4 leading-relaxed">
                Klinik Pratama Trias Medika berkomitmen memberikan pelayanan kesehatan berkualitas dengan harga yang terjangkau dan transparan. Kami juga melayani pasien BPJS Kesehatan.
            </p>
        </div>

        <!-- Dynamic Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($layanans as$layanan)
            <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/30 hover:shadow-md transition-all duration-300 flex flex-col h-full group">
                <div class="w-14 h-14 rounded-xl bg-surface-container-low text-primary flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <!-- IKON: health_and_safety -->
                    <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M10.5 13H8v-3h2.5V7.5h3V10H16v3h-2.5v2.5h-3V13zM12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91 4.59-1.15 8-5.86 8-10.91V5l-8-3z"/></svg>
                </div>
                
                <h3 class="font-headline-md text-headline-md text-on-surface font-bold mb-2">
                    {{ $layanan->nama_layanan }}
                </h3>
                
                <p class="font-body-sm text-body-sm text-on-surface-variant flex-grow mb-6">
                    {{ $layanan->deskripsi ?? 'Layanan medis profesional dan terpadu oleh tenaga kesehatan berkompeten di bidangnya.' }}
                </p>
                
                <div class="pt-4 border-t border-outline-variant/30 flex items-center justify-between mt-auto">
                    <span class="font-label-sm text-label-sm text-outline uppercase tracking-wider">Estimasi Biaya</span>
                    <span class="font-headline-sm text-headline-sm text-primary font-bold">Rp {{ number_format($layanan->estimasi_biaya ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center text-on-surface-variant font-body-lg bg-surface-container-low rounded-2xl">
                Data layanan belum ditambahkan oleh administrator.
            </div>
            @endforelse
        </div>

        <!-- BPJS Info Banner -->
        <div class="mt-12 bg-primary rounded-2xl p-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-lg shadow-primary/20">
            <div class="flex items-center gap-6 text-on-primary">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                    <!-- IKON: verified -->
                    <svg class="w-9 h-9 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M23 12l-2.44-2.79.34-3.69-3.61-.82-1.89-3.2L12 2.96 8.6 1.5 6.71 4.69 3.1 5.5l.34 3.7L1 12l2.44 2.79-.34 3.7 3.61.82 1.89 3.2l3.4-1.46 3.4 1.46 1.89-3.2 3.61-.82-.34-3.69L23 12zm-12.91 4.72l-3.8-3.81 1.48-1.48 2.32 2.33 5.85-5.87 1.48 1.48-7.33 7.35z"/></svg>
                </div>
                <div>
                    <h3 class="font-headline-md text-headline-md font-bold mb-1">Peserta BPJS Kesehatan?</h3>
                    <p class="font-body-md text-body-md text-primary-container-highest opacity-90">
                        Klinik Trias Medika adalah Faskes Tingkat Pertama (FKTP) resmi. Layanan dasar ditanggung penuh sesuai hak kepesertaan.
                    </p>
                </div>
            </div>
            <a href="{{ route('booking.create') }}" class="px-6 py-3 bg-surface-container-lowest text-primary font-label-lg font-bold rounded-xl hover:bg-surface transition-colors shrink-0">
                Buat Janji Sekarang
            </a>
        </div>
    </div>
</div>
@endsection