<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Siswa' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #f1f5f9;
            background-image:
                radial-gradient(ellipse 80% 60% at 50% -10%, rgba(37, 99, 235, 0.06), transparent),
                radial-gradient(ellipse 50% 40% at 90% 100%, rgba(59, 130, 246, 0.04), transparent);
        }

        /* 1. Menghilangkan garis putih vertikal tepi kanan sidebar */
        #sidebar {
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%);
            border-right: none !important;
            box-shadow: 4px 0 20px rgba(15, 23, 42, 0.12);
        }

        .sidebar-logo {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            box-shadow: 0 0 24px rgba(37, 99, 235, 0.25);
        }

        .menu-link {
            position: relative;
            border-radius: 10px;
            transition: all 0.25s ease;
            overflow: hidden;
        }

        /* 2. Menghilangkan elemen batang/garis putih di menu link */
        .menu-link::after {
            display: none !important;
        }

        .menu-link:hover {
            background: rgba(255, 255, 255, 0.10);
            color: #ffffff !important;
        }

        /* 3. Tampilan highlight menu aktif tanpa potongan garis putih */
        .menu-link.menu-active {
            background: rgba(255, 255, 255, 0.16) !important;
            color: #ffffff !important;
            border-radius: 10px;
        }

        /* Style Ikon Menu */
        .menu-link i {
            font-size: 1rem;
            width: 1.25rem;
            text-align: center;
            color: #93c5fd;
            transition: all 0.25s ease;
        }

        .menu-link:hover i {
            color: #ffffff;
        }

        .menu-link.menu-active i {
            color: #ffffff;
            transform: scale(1.1);
        }

        #toggleBtn {
            transition: background 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            background: linear-gradient(135deg, #ffffff, #f8fafc);
            border: 1px solid #dbeafe;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.12);
            color: #2563eb;
        }

        #toggleBtn:hover {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border-color: #93c5fd;
            box-shadow: 0 0 24px rgba(37, 99, 235, 0.12), 0 4px 20px rgba(15, 23, 42, 0.12);
            color: #1d4ed8;
        }

        #sidebarOverlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.45);
            z-index: 40;
            backdrop-filter: blur(4px);
        }

        #sidebarOverlay.active {
            display: block;
        }

        #mainContent {
            transition: padding-left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            padding-left: 16rem;
        }

        .top-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px) saturate(1.2);
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 10px rgba(15, 23, 42, 0.04);
        }

        .header-title {
            background: linear-gradient(135deg, #0f172a 30%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        @media (max-width: 1023px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar.sidebar-open {
                transform: translateX(0);
            }

            #mainContent {
                padding-left: 0 !important;
            }
        }

        @media (min-width: 1024px) {
            #sidebar.sidebar-closed {
                transform: translateX(-100%);
            }

            #mainContent.main-full {
                padding-left: 0 !important;
            }
        }

        :root {
            color-scheme: light;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active,
        select:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 30px #ffffff inset !important;
            -webkit-text-fill-color: #0f172a !important;
        }

        input, select, textarea {
            color-scheme: light !important;
            background-color: #ffffff !important;
            color: #0f172a !important;
        }
    </style>
</head>

<body class="text-slate-800 antialiased">

    {{-- OVERLAY MOBILE --}}
    <div id="sidebarOverlay" onclick="closeSidebar()"></div>

    <div class="min-h-screen flex flex-col">

        {{-- SIDEBAR --}}
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 flex flex-col justify-between">
            <div class="flex flex-col h-full">
                {{-- LOGO --}}
                <div class="h-20 flex items-center justify-between px-5 border-b border-white/10 shrink-0">
                    <div class="flex items-center gap-3">
                        {{-- Logo Gambar Bulat --}}
                        <div class="w-10 h-10 rounded-full overflow-hidden shrink-0 border border-white/20 bg-slate-950 flex items-center justify-center">
                            <img src="{{ asset('images/image.png') }}" alt="Logo PKL" class="w-full h-full object-cover scale-125">
                        </div>
                        <h1 class="text-sm sm:text-base font-bold tracking-wide text-white leading-tight">
                            PENGELOLAAN PKL
                        </h1>
                    </div>
                </div>

                {{-- MENU --}}
                <div class="flex-1 overflow-y-auto px-4 py-6">
                    <p class="px-3 mb-4 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200">
                        Menu Siswa
                    </p>

                    <a href="{{ route('siswa.dashboard') }}"
                       class="menu-link flex items-center gap-3 px-3 py-3 mb-1.5 {{ request()->routeIs('siswa.dashboard') ? 'menu-active' : 'text-blue-100' }}">
                        <i class="fas fa-house"></i>
                        <span class="text-sm font-medium relative z-10">Dashboard</span>
                    </a>

                    <a href="{{ route('siswa.pengajuan.index') }}"
                       class="menu-link flex items-center gap-3 px-3 py-3 mb-1.5 {{ request()->routeIs('siswa.pengajuan.*') ? 'menu-active' : 'text-blue-100' }}">
                        <i class="fas fa-file-signature"></i>
                        <span class="text-sm font-medium relative z-10">Pengajuan PKL</span>
                    </a>

                    <a href="{{ route('siswa.jurnal.index') }}"
                       class="menu-link flex items-center gap-3 px-3 py-3 mb-1.5 {{ request()->routeIs('siswa.jurnal.*') ? 'menu-active' : 'text-blue-100' }}">
                        <i class="fas fa-book-open"></i>
                        <span class="text-sm font-medium relative z-10">Jurnal Harian</span>
                    </a>

                    <a href="{{ route('siswa.penilaian.index') }}"
                       class="menu-link flex items-center gap-3 px-3 py-3 mb-1.5 {{ request()->routeIs('siswa.penilaian.*') ? 'menu-active' : 'text-blue-100' }}">
                        <i class="fas fa-star"></i>
                        <span class="text-sm font-medium relative z-10">Penilaian</span>
                    </a>

                    <a href="{{ route('profile.edit') }}"
                       class="menu-link flex items-center gap-3 px-3 py-3 mb-1.5 {{ request()->routeIs('profile.*') ? 'menu-active' : 'text-blue-100' }}">
                        <i class="fas fa-user-gear"></i>
                        <span class="text-sm font-medium relative z-10">Profil</span>
                    </a>
                </div>

                {{-- USER PROFILE BOTTOM --}}
                <div class="p-4 border-t border-white/10 bg-slate-900/30 shrink-0">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 rounded-full bg-blue-500/30 border border-blue-400/50 flex items-center justify-center shrink-0">
                                <i class="fas fa-user text-blue-100 text-sm"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-white truncate">
                                    {{ auth()->user()->name ?? 'Siswa' }}
                                </p>
                                <p class="text-[11px] text-blue-200 truncate">Siswa</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" class="inline-block shrink-0">
                            @csrf
                            <button type="submit"
                                    title="Keluar / Logout"
                                    class="group relative flex h-9 w-9 items-center justify-center rounded-xl border border-rose-200 bg-rose-50 text-rose-500 hover:bg-rose-600 hover:text-white hover:border-rose-600 active:scale-95 transition-all duration-150">
                                <svg class="h-4 w-4 transition-transform duration-150 group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H8.25" />
                                </svg>
                                <span class="absolute left-1/2 -top-8 -translate-x-1/2 opacity-0 group-hover:opacity-100 pointer-events-none rounded-md bg-slate-900 px-2 py-1 text-[10px] font-medium text-white shadow-md transition-opacity duration-150 whitespace-nowrap border border-slate-700">
                                    Logout
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        {{-- MAIN CONTENT AREA --}}
        <main id="mainContent" class="min-h-screen flex-1 flex flex-col">

            {{-- HEADER BAGIAN ATAS --}}
            <header class="top-header h-20 flex items-center justify-between px-4 sm:px-8 sticky top-0 z-30 w-full">
                <div class="flex items-center gap-3 min-w-0">
                    {{-- TOMBOL TOGGLE --}}
                    <button type="button"
                            id="toggleBtn"
                            onclick="toggleSidebar()"
                            aria-label="Buka atau tutup menu navigasi"
                            class="w-10 h-10 rounded-xl flex items-center justify-center cursor-pointer text-base shrink-0">
                        <i class="fas fa-bars" id="toggleIcon"></i>
                    </button>

                    <div class="min-w-0">
                        <h2 class="text-lg sm:text-xl font-extrabold header-title truncate">
                            {{ $header ?? 'Dashboard Siswa' }}
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 truncate">
                            Sistem Informasi Jurnal PKL
                        </p>
                    </div>
                </div>
            </header>

            {{-- CONTENT SLOT --}}
            <div class="p-4 sm:p-8 flex-1">
                {{ $slot }}
            </div>

            {{-- FOOTER --}}
            <footer class="px-8 py-6 border-t border-slate-200 text-center mt-auto">
                <p class="text-xs text-slate-500">
                    © {{ date('Y') }} Sistem Informasi Jurnal PKL
                </p>
            </footer>
        </main>
    </div>

    {{-- JAVASCRIPT NAVIGASI --}}
    <script>
        var sidebar = document.getElementById('sidebar');
        var mainContent = document.getElementById('mainContent');
        var toggleIcon = document.getElementById('toggleIcon');
        var overlay = document.getElementById('sidebarOverlay');

        var isMobile = window.innerWidth < 1024;
        var isOpen = !isMobile;

        function init() {
            isMobile = window.innerWidth < 1024;

            if (isMobile) {
                isOpen = false;
                sidebar.classList.remove('sidebar-open');
                overlay.classList.remove('active');
            } else {
                isOpen = true;
                sidebar.classList.remove('sidebar-closed');
                mainContent.classList.remove('main-full');
                overlay.classList.remove('active');
            }
        }

        function toggleSidebar() {
            isOpen = !isOpen;

            if (isMobile) {
                if (isOpen) {
                    sidebar.classList.add('sidebar-open');
                    overlay.classList.add('active');
                } else {
                    sidebar.classList.remove('sidebar-open');
                    overlay.classList.remove('active');
                }
            } else {
                if (isOpen) {
                    sidebar.classList.remove('sidebar-closed');
                    mainContent.classList.remove('main-full');
                } else {
                    sidebar.classList.add('sidebar-closed');
                    mainContent.classList.add('main-full');
                }
            }
        }

        function closeSidebar() {
            if (isMobile && isOpen) {
                isOpen = false;
                sidebar.classList.remove('sidebar-open');
                overlay.classList.remove('active');
            }
        }

        var resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(init, 150);
        });

        init();
    </script>

    {{-- SWEETALERT2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const SwalDark = Swal.mixin({
                background: '#ffffff',
                color: '#1e293b',
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#ef4444',
            });

            const deleteForms = document.querySelectorAll('form.form-delete');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const confirmMessage = form.getAttribute('data-confirm-message') || "Data yang dihapus tidak dapat dikembalikan!";

                    SwalDark.fire({
                        title: 'Yakin ingin menghapus?',
                        text: confirmMessage,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                        position: 'center',
                        customClass: { popup: 'swal2-dark-popup' }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <style>
        .swal2-container {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            position: fixed !important;
            inset: 0 !important;
        }

        .swal2-dark-popup {
            border: 1px solid rgba(15, 23, 42, 0.08) !important;
            box-shadow: 0 8px 32px rgba(15, 23, 42, 0.15) !important;
            border-radius: 16px !important;
        }

        .swal2-styled.swal2-confirm, .swal2-styled.swal2-cancel {
            border-radius: 10px !important;
            font-weight: 600 !important;
        }
    </style>
</body>

</html>