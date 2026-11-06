@extends('frontend.layouts.master')

@section('content')
<div class="flex flex-col w-full overflow-x-hidden">
    <div class="relative w-full max-w-7xl mx-auto px-6 lg:px-12 pt-12 pb-16">
        <div class="absolute top-10 left-1/3 w-96 h-96 bg-primary-fixed/30 rounded-full blur-3xl pointer-events-none -z-10"></div>
        <div class="absolute top-48 right-10 w-80 h-80 bg-secondary-container/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
        
        <!-- 1. Header & Breadcrumb Context -->
        <div class="flex flex-col items-center text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-secondary-container/40 text-on-secondary-container shadow-sm mb-4">
                <span class="w-2 h-2 rounded-full bg-primary animate-ping"></span>
                <span class="w-2 h-2 rounded-full bg-primary -ml-2.5"></span>
                <span class="font-label-sm text-label-sm uppercase tracking-wider font-bold">Pusat Informasi &amp; Layanan Pasien • Respon Cepat</span>
            </div>
            <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight font-extrabold mt-1">
                Hubungi <span class="text-primary underline decoration-primary-fixed decoration-wavy decoration-2 underline-offset-8">Klinik Trias Medika</span>
            </h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-4 leading-relaxed">
                Tim medis dan admisi kami siap membantu Anda dengan ramah dan cepat. Temukan rute lokasi klinik, jam pelayanan poli, atau kirimkan pertanyaan seputar layanan kesehatan dan BPJS.
            </p>
        </div>

        <!-- 2. Two-Column Desktop Section: Interactive Map & Contact Form -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-16 items-start">
            
            <!-- Left Column: Rich Map Module -->
            <div class="lg:col-span-7 space-y-6">
                <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm">
                    <div class="relative w-full h-[380px] rounded-lg overflow-hidden bg-surface-container-low flex flex-col justify-between p-4">
                        <svg class="absolute inset-0 w-full h-full text-outline-variant/20" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                            <line stroke="currentColor" stroke-width="12" x1="0" x2="100%" y1="120" y2="150"></line>
                            <line stroke="#ffffff" stroke-width="8" x1="0" x2="100%" y1="120" y2="150"></line>
                            <line stroke="currentColor" stroke-width="14" x1="45%" x2="52%" y1="0" y2="100%"></line>
                            <line stroke="#ffffff" stroke-width="10" x1="45%" x2="52%" y1="0" y2="100%"></line>
                            <path d="M 0,320 Q 200,340 400,310 T 800,330 L 800,380 L 0,380 Z" fill="#6cf8bb" fill-opacity="0.18"></path>
                            <path d="M 50,20 L 140,20 L 130,90 L 40,80 Z" fill="#dae2fd" fill-opacity="0.4"></path>
                            <path d="M 220,180 L 320,190 L 310,240 L 210,230 Z" fill="#e2e7ff" fill-opacity="0.5"></path>
                        </svg>
                        
                        <div class="relative z-10 flex justify-between items-start">
                            <div class="bg-surface-container-lowest/95 backdrop-blur-md px-3 py-1.5 rounded-lg shadow-sm">
                                <span class="font-label-sm text-label-sm text-on-surface font-bold flex items-center gap-1">
                                    <!-- IKON: navigation -->
                                    <svg class="w-3.5 h-3.5 fill-primary" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z"/></svg>
                                    Jl. Raya Pasar Kemis
                                </span>
                            </div>
                            <div class="flex flex-col gap-1.5 items-end">
                                <a class="bg-surface-container-lowest hover:bg-surface text-primary px-3 py-1.5 rounded-lg shadow-sm font-label-md text-label-md font-semibold flex items-center gap-1 transition-all" href="https://maps.app.goo.gl/pPfzETgEn33JMmLU9" rel="noopener noreferrer" target="_blank">
                                    <span>Perbesar Peta</span>
                                    <!-- IKON: open_in_new -->
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"/></svg>
                                </a>
                            </div>
                        </div>
                        
                        <div class="relative z-10 self-center -mt-8 flex flex-col items-center">
                            <div class="bg-surface-container-lowest px-3.5 py-2 rounded-xl shadow-md flex items-center gap-2 mb-1 animate-bounce">
                                <div class="w-6 h-6 rounded-md bg-primary text-on-primary flex items-center justify-center">
                                    <!-- IKON: local_hospital -->
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 3H5c-1.1 0-1.99.9-1.99 2L3 19c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
                                </div>
                                <div class="flex flex-col text-left">
                                    <span class="font-label-sm text-label-sm font-extrabold text-primary leading-tight">Klinik Pratama Trias Medika</span>
                                    <span class="font-label-sm text-label-sm text-on-surface-variant scale-90 -ml-1">Sukaasih, Pasar Kemis</span>
                                </div>
                            </div>
                            <div class="relative flex items-center justify-center">
                                <div class="w-8 h-8 rounded-full bg-primary/20 animate-ping absolute"></div>
                                <div class="w-7 h-7 rounded-full bg-primary text-on-primary flex items-center justify-center shadow-lg">
                                    <!-- IKON: location_on -->
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="relative z-10 flex justify-between items-end">
                            <div class="bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded-md text-on-surface-variant font-label-sm text-label-sm">
                                Koordinat: -6.1738, 106.5322
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <div class="bg-surface-container-lowest rounded-xl p-4 shadow-sm flex items-start gap-3">
                        <div class="p-2 rounded-lg bg-secondary-container/30 text-primary shrink-0">
                            <!-- IKON: local_parking -->
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M13.2 11H10V7h3.2c1.1 0 2 .9 2 2s-.9 2-2 2zM19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-6 12h-3v4H8V5h5.2c2.21 0 4 1.79 4 4s-1.79 4-4 4z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-label-lg text-label-lg text-on-surface font-bold leading-tight">Parkir Luas</h4>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Kapasitas 20+ mobil &amp; 50 motor gratis.</p>
                        </div>
                    </div>
                    <div class="bg-surface-container-lowest rounded-xl p-4 shadow-sm flex items-start gap-3">
                        <div class="p-2 rounded-lg bg-secondary-container/30 text-primary shrink-0">
                            <!-- IKON: accessible -->
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 4c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm9 7h-6v13h-2v-6h-2v6H9V11H3V9h18v2z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-label-lg text-label-lg text-on-surface font-bold leading-tight">Akses Ramah Difabel</h4>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Tersedia ramp kursi roda &amp; toilet khusus.</p>
                        </div>
                    </div>
                    <div class="bg-surface-container-lowest rounded-xl p-4 shadow-sm flex items-start gap-3">
                        <div class="p-2 rounded-lg bg-secondary-container/30 text-primary shrink-0">
                            <!-- IKON: directions_bus -->
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 16c0 1.1.9 2 2 2h1v2c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-2h6v2c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-2h1c1.1 0 2-.9 2-2V6c0-3.5-3.58-4-8-4s-8 .5-8 4v10zm3.5 1c-.83 0-1.5-.67-1.5-1.5S6.67 14 7.5 14s1.5.67 1.5 1.5S8.33 17 7.5 17zm9 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm1.5-6H6V6h12v5z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-label-lg text-label-lg text-on-surface font-bold leading-tight">Dekat Transportasi</h4>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">50 meter dari pemberhentian angkot Pasar Kemis.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Consultation & Contact Form -->
            <div class="lg:col-span-5">
                <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between pb-2 mb-4">
                        <div>
                            <div class="inline-flex items-center gap-1 text-primary mb-1">
                                <!-- IKON: mark_email_read -->
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 19c0-3.87 3.13-7 7-7 1.08 0 2.09.25 3 .68V4c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h8.08c-.05-.33-.08-.66-.08-1zm8-13l-8 5-8-5V4l8 5 8-5v2zm-2.66 12.05l-2.12-2.12-1.41 1.41 3.54 3.54 5.66-5.66-1.41-1.41-4.26 4.24z"/></svg>
                                <span class="font-label-sm text-label-sm uppercase tracking-wider font-bold">Admisi &amp; Bantuan</span>
                            </div>
                            <h2 class="font-headline-lg text-headline-lg text-on-surface font-bold tracking-tight">Kirim Pesan</h2>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-secondary-container/40 text-primary flex items-center justify-center">
                            <!-- IKON: send -->
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                        </div>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-6 leading-relaxed">
                        Isi formulir di bawah ini untuk konsultasi administrasi, cek ketersediaan obat, atau informasi kepesertaan BPJS Kesehatan.
                    </p>
                    
                    <form class="space-y-4" id="contactClinicForm" onsubmit="event.preventDefault(); handleSubmitFeedback();">
                        <div class="space-y-1">
                            <label class="block font-label-md text-label-md text-on-surface font-semibold" for="fullName">Nama Lengkap <span class="text-error">*</span></label>
                            <input class="w-full h-12 px-4 rounded-xl bg-surface-container-low focus:bg-surface-container-lowest text-on-surface font-body-md text-body-md placeholder:text-outline border border-transparent focus:border-primary focus:outline-none transition-all" id="fullName" placeholder="Masukkan nama Anda" required type="text">
                        </div>
                        
                        <div class="space-y-1">
                            <label class="block font-label-md text-label-md text-on-surface font-semibold" for="waPhone">Nomor WhatsApp <span class="text-error">*</span></label>
                            <input class="w-full h-12 px-4 rounded-xl bg-surface-container-low focus:bg-surface-container-lowest text-on-surface font-body-md text-body-md placeholder:text-outline border border-transparent focus:border-primary focus:outline-none transition-all" id="waPhone" placeholder="Contoh: 081234567890" required type="tel">
                        </div>
                        
                        <div class="space-y-1">
                            <label class="block font-label-md text-label-md text-on-surface font-semibold" for="topicSelect">Topik Layanan <span class="text-error">*</span></label>
                            <div class="relative">
                                <select class="w-full h-12 px-4 rounded-xl bg-surface-container-low focus:bg-surface-container-lowest text-on-surface font-body-md text-body-md border border-transparent focus:border-primary focus:outline-none appearance-none cursor-pointer pr-10 transition-all" id="topicSelect" required>
                                    <option disabled selected value="">Pilih Topik Layanan Kesehatan</option>
                                    <option value="BPJS Kesehatan">Informasi Layanan BPJS Kesehatan</option>
                                    <option value="Lainnya">Pertanyaan Umum Lainnya</option>
                                </select>
                                <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant flex items-center">
                                    <!-- IKON: expand_more -->
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/></svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <label class="block font-label-md text-label-md text-on-surface font-semibold" for="messageText">Pesan Anda <span class="text-error">*</span></label>
                            <textarea class="w-full p-4 rounded-xl bg-surface-container-low focus:bg-surface-container-lowest text-on-surface font-body-md text-body-md placeholder:text-outline border border-transparent focus:border-primary focus:outline-none transition-all resize-none" id="messageText" placeholder="Tuliskan pertanyaan Anda di sini..." required rows="3"></textarea>
                        </div>
                        
                        <button class="w-full h-12 bg-primary hover:bg-primary-container text-on-primary font-label-lg text-label-lg font-bold rounded-xl shadow-md transition-all flex items-center justify-center gap-2 mt-2" id="submitBtn" type="submit">
                            <!-- IKON: send -->
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                            <span>Kirim Pesan via WhatsApp</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- 3. Direct Rapid Support Strip / Emergency Action Panel -->
        <div class="mt-16 bg-surface-container-lowest rounded-xl p-6 shadow-sm">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-4 text-center lg:text-left">
                    <div class="w-14 h-14 rounded-2xl bg-secondary-container/40 text-primary flex items-center justify-center shrink-0">
                        <!-- IKON: health_and_safety -->
                        <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M10.5 13H8v-3h2.5V7.5h3V10H16v3h-2.5v2.5h-3V13zM12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91 4.59-1.15 8-5.86 8-10.91V5l-8-3z"/></svg>
                    </div>
                    <div>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-secondary-container/60 text-on-secondary-container font-label-sm text-label-sm font-bold uppercase mb-1">
                            Bantuan Cepat 24 Jam
                        </span>
                        <h3 class="font-headline-md text-headline-md text-on-surface font-extrabold">Butuh Penanganan Medis Mendesak?</h3>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                            Unit Gawat Darurat (UGD) dan Ruang Bersalin kami siaga 24 jam dengan dokter dan paramedis berpengalaman.
                        </p>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto justify-center">
                    <a class="h-12 px-6 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg font-bold flex items-center justify-center gap-2 transition-colors shadow-sm" href="tel:0215903321">
                        <!-- IKON: phone_in_talk -->
                        <svg class="w-5 h-5 fill-primary" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 15.5c-1.25 0-2.45-.2-3.57-.57-.35-.11-.74-.03-1.02.24l-2.2 2.2c-2.83-1.44-5.15-3.75-6.59-6.59l2.2-2.21c.28-.26.36-.65.25-1C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1z"/></svg>
                        <span>Hotline UGD: (021) 590-3321</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function handleSubmitFeedback() {
        const name = document.getElementById('fullName').value;
        const phone = document.getElementById('waPhone').value;
        const topic = document.getElementById('topicSelect').value;
        const message = document.getElementById('messageText').value;

        const textMessage = `Halo Admin Klinik Trias Medika,%0A%0ASaya ingin bertanya mengenai layanan klinik:%0A%0A` +
            `• *Nama:* ${encodeURIComponent(name)}%0A` +
            `• *No. HP:* ${encodeURIComponent(phone)}%0A` +
            `• *Topik:* ${encodeURIComponent(topic)}%0A` +
            `• *Pesan:* ${encodeURIComponent(message)}%0A%0A` +
            `Mohon informasi lebih lanjut. Terima kasih.`;

        const targetWa = '6281288997722';
        window.open(`https://wa.me/${targetWa}?text=${textMessage}`, '_blank');
        
        document.getElementById('contactClinicForm').reset();
    }
</script>
@endsection