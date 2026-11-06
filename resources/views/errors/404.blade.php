<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Klinik Pratama Trias Medika</title>
    
    <!-- Google Fonts & Material Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans min-h-screen flex items-center justify-center p-4">

    <div class="max-w-lg w-full bg-white rounded-3xl shadow-xl p-8 text-center border border-slate-100 relative overflow-hidden">
        <!-- Elemen Dekoratif -->
        <div class="absolute -top-12 -right-12 w-32 h-32 bg-emerald-50 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -left-12 w-32 h-32 bg-emerald-50 rounded-full blur-2xl pointer-events-none"></div>

        <!-- Ikon Error -->
        <div class="relative w-20 h-20 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-emerald-100 shadow-sm">
            <span class="material-symbols-outlined text-4xl">search_off</span>
        </div>

        <!-- Label & Judul -->
        <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-semibold rounded-full mb-3">
            Error 404
        </span>
        <h1 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-3 tracking-tight">
            Halaman / Tiket Tidak Ditemukan
        </h1>
        <p class="text-slate-500 text-sm sm:text-base leading-relaxed mb-8">
            Mohon maaf, nomor tiket antrean atau halaman yang Anda cari tidak ditemukan di sistem Klinik Pratama Trias Medika. Pastikan tautan yang dimasukkan sudah benar.
        </p>

        <!-- Tombol Navigasi -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ url('/') }}" 
               class="w-full sm:w-auto flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition duration-200 text-sm shadow-md shadow-emerald-600/20">
                <span class="material-symbols-outlined text-lg">home</span>
                Kembali ke Beranda
            </a>
            <a href="{{ route('booking.create') }}" 
               class="w-full sm:w-auto flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition duration-200 text-sm">
                <span class="material-symbols-outlined text-lg">calendar_month</span>
                Buat Janji Temu
            </a>
        </div>

        <!-- Watermark/Footer -->
        <p class="text-xs text-slate-400 mt-8 pt-6 border-t border-slate-100">
            &copy; {{ date('Y') }} Klinik Pratama Trias Medika &bull; PT Konsultan Inovasi Digital
        </p>
    </div>

</body>
</html>