<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-800 min-h-screen flex items-center justify-center p-4">

    {{-- KONTEN UTAMA --}}
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-100 p-6 sm:p-8 text-center flex flex-col items-center justify-center transition-all">
        
        {{-- Ikon Peringatan / Lock --}}
        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-rose-50 border border-rose-100 text-rose-500 rounded-2xl flex items-center justify-center mb-5 shadow-sm">
            <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg>
        </div>

        {{-- Kode Error --}}
        <span class="inline-block px-3 py-1 bg-rose-100 text-rose-700 text-xs font-bold rounded-full mb-3 tracking-wider uppercase">
            Error 403
        </span>

        {{-- Judul Halaman --}}
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 mb-2">
            Akses Dibatasi
        </h1>

        {{-- Pesan Dinamis dari Controller Laravel --}}
        <p class="text-sm sm:text-base text-slate-600 mb-6 leading-relaxed max-w-sm mx-auto">
            {{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses untuk membuka halaman ini.' }}
        </p>

        {{-- Tombol Navigasi Kembali --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 w-full">
            <a href="{{ route('siswa.dashboard') }}" 
               class="w-full sm:w-auto px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl shadow-md shadow-blue-500/20 transition-all duration-200 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Dashboard
            </a>
        </div>

    </div>

</body>
</html>