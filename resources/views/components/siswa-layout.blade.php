<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $title ?? 'Dashboard Siswa' }}
    </title>

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
                radial-gradient(
                    ellipse 80% 60% at 50% -10%,
                    rgba(37, 99, 235, 0.06),
                    transparent
                ),
                radial-gradient(
                    ellipse 50% 40% at 90% 100%,
                    rgba(59, 130, 246, 0.04),
                    transparent
                );
        }

        #sidebar {
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);

            background: linear-gradient(
                180deg,
                #1e3a8a 0%,
                #1e40af 100%
            );

            border-right: 1px solid rgba(15, 23, 42, 0.08);

            box-shadow: 4px 0 20px rgba(15, 23, 42, 0.08);
        }

        #sidebar.sidebar-closed {
            transform: translateX(-100%);
        }

        .sidebar-logo {
            background: linear-gradient(
                135deg,
                #3b82f6,
                #2563eb
            );

            box-shadow: 0 0 24px rgba(37, 99, 235, 0.25);
        }

        .menu-link {
            position: relative;
            border-radius: 10px;
            transition: all 0.25s ease;
            overflow: hidden;
        }

        .menu-link::after {
            content: '';

            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;

            width: 3px;

            background: #ffffff;

            border-radius: 0 3px 3px 0;

            transform: scaleY(0);

            transition: transform 0.25s ease;
        }

        .menu-link:hover {
            background: rgba(255, 255, 255, 0.10);
            color: #ffffff !important;
        }

        .menu-link:hover::after {
            transform: scaleY(0.5);
        }

        .menu-link.menu-active {
            background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0.16),
                rgba(255, 255, 255, 0.08)
            );

            color: #ffffff !important;
        }

        .menu-link.menu-active::after {
            transform: scaleY(1);
        }

        #toggleBtn {
            z-index: 9999 !important;

            transition:
                left 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                background 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease;

            background: linear-gradient(
                135deg,
                #ffffff,
                #f8fafc
            );

            border: 1px solid #dbeafe;

            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.12);

            color: #2563eb;
        }

        #toggleBtn:hover {
            background: linear-gradient(
                135deg,
                #eff6ff,
                #dbeafe
            );

            border-color: #93c5fd;

            box-shadow:
                0 0 24px rgba(37, 99, 235, 0.12),
                0 4px 20px rgba(15, 23, 42, 0.12);

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
            transition: margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #mainContent.main-full {
            margin-left: 0 !important;
        }

        .top-header {
            background: rgba(255, 255, 255, 0.95);

            backdrop-filter: blur(20px) saturate(1.2);

            border-bottom: 1px solid #e2e8f0;

            box-shadow: 0 1px 10px rgba(15, 23, 42, 0.04);
        }

        .header-title {
            background: linear-gradient(
                135deg,
                #0f172a 30%,
                #2563eb 100%
            );

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;

            background-clip: text;
        }

        .avatar-ring {
            background: linear-gradient(
                135deg,
                #2563eb,
                #3b82f6
            );

            box-shadow: 0 0 20px rgba(37, 99, 235, 0.20);

            padding: 2px;
        }

        .avatar-ring > div {
            background: #eff6ff;

            border-radius: 50%;

            width: 100%;
            height: 100%;

            display: flex;

            align-items: center;

            justify-content: center;
        }

        .footer-border {
            border-top: 1px solid #e2e8f0;
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

        @media (max-width:1023px) {

            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar.sidebar-open {
                transform: translateX(0);
            }

            #mainContent {
                margin-left: 0 !important;
            }

            .header-text-shift {
                padding-left: 0 !important;
            }

        }

        @media (max-width:639px) {

            .resp-px {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .resp-py {
                padding-top: 1.25rem !important;
                padding-bottom: 1.25rem !important;
            }

        }

        /* Paksa browser menggunakan skema terang pada elemen form */
:root {
    color-scheme: light;
}

/* Mencegah background hitam/gelap saat autofill browser */
input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus, 
input:-webkit-autofill:active,
select:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 30px #ffffff inset !important;
    -webkit-text-fill-color: #0f172a !important;
}

/* Memastikan background input tetap terang */
input, select, textarea {
    color-scheme: light !important;
    background-color: #ffffff;
    color: #0f172a;
}
/* Timpa semua elemen input, select, dan datepicker agar berlatar putih */
input, 
select, 
textarea,
input[type="date"],
select.form-select {
    background-color: #ffffff !important;
    color: #0f172a !important;
}

/* Jika Anda menggunakan plugin dropdown kustom (seperti TomSelect/Select2) */
.ts-control, 
.select2-container--default .select2-selection--single {
    background-color: #ffffff !important;
    color: #0f172a !important;
    border-color: #e2e8f0 !important;
}

    </style>

</head>

<body class="text-slate-800 antialiased">

    <div id="sidebarOverlay" onclick="closeSidebar()"></div>

    <button
        id="toggleBtn"
        onclick="toggleSidebar()"
        class="fixed top-5 w-10 h-10 rounded-xl flex items-center justify-center cursor-pointer text-base"
        style="left: 268px;"
    >
        <i class="fas fa-times" id="toggleIcon"></i>
    </button>

    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}

        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64">

            <div
                class="h-20 flex items-center px-6"
                style="border-bottom: 1px solid rgba(255,255,255,0.12);"
            >

                <div class="w-10 h-10 rounded-xl sidebar-logo flex items-center justify-center">

                    <span class="text-lg font-bold text-white">
                        J
                    </span>

                </div>

                <div class="ml-3">

                    <h1 class="text-lg font-bold tracking-wide text-white">
                        MANEJEMEN PKL
                    </h1>

                    <p class="text-xs text-blue-100">
                        Sistem Informasi
                    </p>

                </div>

            </div>

            <div class="px-4 py-6">

                <p class="px-3 mb-4 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200">
                    Menu Siswa
                </p>

                <a
                    href="{{ route('siswa.dashboard') }}"
                    class="menu-link flex items-center gap-3 px-3 py-3 mb-1.5
                    {{ request()->routeIs('siswa.dashboard') ? 'menu-active' : 'text-blue-100' }}"
                >

                    <span class="text-sm font-medium relative z-10">
                        Dashboard
                    </span>

                </a>

                <a
                    href="{{ route('siswa.pengajuan.index') }}"
                    class="menu-link flex items-center gap-3 px-3 py-3 mb-1.5
                    {{ request()->routeIs('siswa.pengajuan.*') ? 'menu-active' : 'text-blue-100' }}"
                >

                    <span class="text-sm font-medium relative z-10">
                        Pengajuan PKL
                    </span>

                </a>

                <a
                    href="{{ route('siswa.jurnal.index') }}"
                    class="menu-link flex items-center gap-3 px-3 py-3 mb-1.5
                    {{ request()->routeIs('siswa.jurnal.*') ? 'menu-active' : 'text-blue-100' }}"
                >

                    <span class="text-sm font-medium relative z-10">
                        Jurnal Harian
                    </span>

                </a>

                <a
                    href="{{ route('siswa.penilaian.index') }}"
                    class="menu-link flex items-center gap-3 px-3 py-3 mb-1.5
                    {{ request()->routeIs('siswa.penilaian.*') ? 'menu-active' : 'text-blue-100' }}"
                >

                    <span class="text-sm font-medium relative z-10">
                        Penilaian
                    </span>

                </a>

                <a
                    href="{{ route('profile.edit') }}"
                    class="menu-link flex items-center gap-3 px-3 py-3 mb-1.5
                    {{ request()->routeIs('profile.*') ? 'menu-active' : 'text-blue-100' }}"
                >

                    <span class="text-sm font-medium relative z-10">
                        Profil
                    </span>

                </a>

            </div>

            <div
                class="absolute bottom-0 left-0 right-0 p-4"
                style="
                    border-top: 1px solid rgba(255,255,255,0.12);
                    background: rgba(15,23,42,0.12);
                "
            >

                <div class="flex items-center justify-between">

                    <div class="min-w-0">

                        <p class="text-sm font-semibold text-white truncate">
                            {{ auth()->user()->name ?? 'Siswa' }}
                        </p>

                        <p class="text-xs text-blue-100">
                            Siswa
                        </p>

                    </div>

                    {{-- FORM LOGOUT DENGAN IKON --}}

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        class="inline-block"
                    >

                        @csrf

                        <button
                            type="submit"
                            title="Keluar / Logout"
                            class="group relative flex h-9 w-9 items-center justify-center rounded-xl border border-rose-200 bg-rose-50 text-rose-500 hover:bg-rose-600 hover:text-white hover:border-rose-600 active:scale-95 transition-all duration-150"
                        >

                            {{-- Ikon Logout / Arrow Right From Line --}}

                            <svg
                                class="h-4 w-4 transition-transform duration-150 group-hover:translate-x-0.5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H8.25"
                                />

                            </svg>

                            {{-- Tooltip Saat Hover (Opsional) --}}

                            <span
                                class="absolute left-1/2 -top-8 -translate-x-1/2 opacity-0 group-hover:opacity-100 pointer-events-none rounded-md bg-slate-900 px-2 py-1 text-[10px] font-medium text-white shadow-md transition-opacity duration-150 whitespace-nowrap border border-slate-700"
                            >
                                Logout
                            </span>

                        </button>

                    </form>

                </div>

            </div>

        </aside>

        {{-- MAIN --}}

        <main id="mainContent" class="ml-64 min-h-screen flex-1">

            <header class="top-header h-20 flex items-center justify-between px-8 resp-px">

                {{-- TULISAN DIGESER KE KANAN BIAR GA KETUTUP TOMBOL --}}

                <div
                    class="header-text-shift"
                    style="padding-left: 50px;"
                >

                    <h2 class="text-xl font-extrabold header-title">
                        {{ $header ?? 'Dashboard Siswa' }}
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Sistem Informasi Jurnal PKL
                    </p>

                </div>

                <div class="flex items-center gap-4">

                    {{-- <div class="text-right hidden sm:block">

                        <p class="text-sm font-medium text-slate-700">
                            {{ auth()->user()->name ?? 'Siswa' }}
                        </p>

                        <p class="text-xs text-slate-400">
                            Siswa
                        </p>

                    </div> --}}

                    {{-- <div class="avatar-ring w-10 h-10 rounded-full">

                        <div>

                            <span class="font-semibold text-blue-600 text-sm">
                                {{ strtoupper(substr(auth()->user()->name ?? 'S', 0, 1)) }}
                            </span>

                        </div>

                    </div> --}}

                </div>

            </header>

            <div class="p-8 resp-px resp-py">

                {{ $slot }}

            </div>

            <footer class="px-8 py-6 footer-border text-center">

                <p class="text-xs text-slate-500">
                    © {{ date('Y') }} Sistem Informasi Jurnal PKL
                </p>

            </footer>

        </main>

    </div>

    <script>

        var sidebar = document.getElementById('sidebar');
        var mainContent = document.getElementById('mainContent');
        var toggleBtn = document.getElementById('toggleBtn');
        var toggleIcon = document.getElementById('toggleIcon');
        var overlay = document.getElementById('sidebarOverlay');

        var isOpen = true;

        var isMobile = window.innerWidth < 1024;

        function init() {

            isMobile = window.innerWidth < 1024;

            if (isMobile) {

                isOpen = false;

                sidebar.classList.remove('sidebar-open', 'sidebar-closed');

                mainContent.classList.remove('main-full');

                toggleBtn.style.left = '16px';

                toggleIcon.className = 'fas fa-bars';

                overlay.classList.remove('active');

            } else {

                isOpen = true;

                sidebar.classList.remove('sidebar-closed', 'sidebar-open');

                mainContent.classList.remove('main-full');

                toggleBtn.style.left = '268px';

                toggleIcon.className = 'fas fa-times';

                overlay.classList.remove('active');

            }

        }

        function toggleSidebar() {

            isOpen = !isOpen;

            if (isMobile) {

                if (isOpen) {

                    sidebar.classList.add('sidebar-open');

                    overlay.classList.add('active');

                    toggleIcon.className = 'fas fa-times';

                } else {

                    sidebar.classList.remove('sidebar-open');

                    overlay.classList.remove('active');

                    toggleIcon.className = 'fas fa-bars';

                }

            } else {

                if (isOpen) {

                    sidebar.classList.remove('sidebar-closed');

                    mainContent.classList.remove('main-full');

                    toggleBtn.style.left = '268px';

                    toggleIcon.className = 'fas fa-times';

                } else {

                    sidebar.classList.add('sidebar-closed');

                    mainContent.classList.add('main-full');

                    toggleBtn.style.left = '16px';

                    toggleIcon.className = 'fas fa-bars';

                }

            }

        }

        function closeSidebar() {

            if (isMobile && isOpen) {

                isOpen = false;

                sidebar.classList.remove('sidebar-open');

                overlay.classList.remove('active');

                toggleIcon.className = 'fas fa-bars';

            }

        }

        var rt;

        window.addEventListener('resize', function() {

            clearTimeout(rt);

            rt = setTimeout(init, 150);

        });

        init();

    </script>

    <!-- Library SweetAlert2 -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            // Konfigurasi dasar SweetAlert2 agar sesuai dengan warna website siswa

            const SwalDark = Swal.mixin({

                background: '#ffffff',

                color: '#1e293b',

                confirmButtonColor: '#2563eb',

                cancelButtonColor: '#ef4444',

            });

            // Cari semua form yang memiliki kelas 'form-delete'

            const deleteForms = document.querySelectorAll('form.form-delete');

            deleteForms.forEach(form => {

                form.addEventListener('submit', function (e) {

                    e.preventDefault();

                    // Ambil pesan kustom jika ada, kalau tidak ada pakai pesan default

                    const confirmMessage =
                        form.getAttribute('data-confirm-message') ||
                        "Data yang dihapus tidak dapat dikembalikan!";

                    SwalDark.fire({

                        title: 'Yakin ingin menghapus?',

                        text: confirmMessage,

                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonText: 'Ya, hapus!',

                        cancelButtonText: 'Batal',

                        position: 'center',

                        customClass: {

                            popup: 'swal2-dark-popup'

                        }

                    }).then((result) => {

                        if (result.isConfirmed) {

                            form.submit();

                        }

                    });

                });

            });

        });

    </script>

    <!-- CSS untuk memperbaiki posisi agar PASTI di tengah -->

    <style>

        .swal2-container {

            display: flex !important;

            align-items: center !important;

            justify-content: center !important;

            position: fixed !important;

            top: 0 !important;

            left: 0 !important;

            right: 0 !important;

            bottom: 0 !important;

            inset: 0 !important;

        }

        .swal2-dark-popup {

            border: 1px solid rgba(15, 23, 42, 0.08) !important;

            box-shadow: 0 8px 32px rgba(15, 23, 42, 0.15) !important;

            border-radius: 16px !important;

        }

        .swal2-styled.swal2-confirm {

            border-radius: 10px !important;

            font-weight: 600 !important;

        }

        .swal2-styled.swal2-cancel {

            border-radius: 10px !important;

            font-weight: 600 !important;

        }

    </style>

</body>

</html>