<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Dashboard Guru' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(100, 116, 139, 0.25);
            border-radius: 999px;
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: rgba(100, 116, 139, 0.25) transparent;
        }
    </style>

</head>

<body class="bg-slate-50 text-slate-800 antialiased">

<div
    x-data="{
        sidebarOpen: window.innerWidth >= 1024
    }"

    x-init="
        window.addEventListener('resize', () => {
            if (window.innerWidth < 1024) {
                sidebarOpen = false;
            } else {
                sidebarOpen = true;
            }
        })
    "

    class="min-h-screen"
>

    {{-- OVERLAY MOBILE --}}
    <div
        x-show="sidebarOpen"

        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"

        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"

        @click="sidebarOpen = false"

        class="fixed inset-0 bg-slate-900/40 backdrop-blur-[2px] z-40 lg:hidden"

        x-cloak
    ></div>


    {{-- SIDEBAR --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"

        class="fixed top-0 left-0 bottom-0 z-50
               w-[260px] sm:w-[270px]
               bg-white
               border-r border-slate-200
               transform
               transition-transform duration-300
               ease-[cubic-bezier(0.4,0,0.2,1)]
               flex flex-col
               shadow-sm"
    >

        {{-- LOGO --}}
        <div
            class="h-16 px-4 sm:px-5
                   flex items-center
                   border-b border-slate-200
                   shrink-0"
        >

            <div
                class="w-9 h-9 rounded-xl
                       bg-gradient-to-br from-blue-500 to-blue-700
                       flex items-center justify-center
                       shrink-0
                       shadow-lg shadow-blue-500/20"
            >

                <span class="text-sm font-extrabold tracking-tight text-white">
                    J
                </span>

            </div>

            <div class="ml-3 min-w-0">

                <h1 class="text-[13px] font-bold tracking-wide text-slate-800 truncate">
                    PENGELOLAAN PKL
                </h1>
                <p class="text-[10px] text-slate-600 leading-none mt-0.5">
                    Sistem Informasi
                </p>

            </div>


            {{-- CLOSE MOBILE --}}
            <button
                @click="sidebarOpen = false"

                class="ml-auto lg:hidden
                       w-8 h-8 rounded-lg
                       flex items-center justify-center
                       text-slate-400
                       hover:text-slate-700
                       hover:bg-slate-100
                       transition-colors"

                aria-label="Tutup menu"
            >

                <svg
                    class="w-[18px] h-[18px]"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />

                </svg>

            </button>

        </div>


        {{-- MENU --}}
        <nav class="sidebar-nav flex-1 overflow-y-auto px-3 py-5">

            <p
                class="px-3 mb-3
                       text-[10px] font-bold
                       uppercase tracking-[0.15em]
                       text-slate-400"
            >
                Menu Guru
            </p>


            <div class="space-y-1">

                {{-- DASHBOARD --}}
                <a
                    href="{{ route('guru.dashboard') }}"

                    class="group flex items-center gap-3
                           px-3 py-2.5
                           rounded-xl
                           text-sm
                           transition-all duration-150
                           {{ request()->routeIs('guru.dashboard')
                                ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm shadow-blue-500/5'
                                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0
                               {{ request()->routeIs('guru.dashboard')
                                    ? 'opacity-100'
                                    : 'opacity-50 group-hover:opacity-80' }}
                               transition-opacity"

                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                        />

                    </svg>

                    <span>Dashboard</span>

                </a>


                {{-- JURNAL --}}
                <a
                    href="{{ route('guru.jurnal.index') }}"

                    class="group flex items-center gap-3
                           px-3 py-2.5
                           rounded-xl
                           text-sm
                           transition-all duration-150
                           {{ request()->routeIs('guru.jurnal.*')
                                ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm shadow-blue-500/5'
                                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0
                               {{ request()->routeIs('guru.jurnal.*')
                                    ? 'opacity-100'
                                    : 'opacity-50 group-hover:opacity-80' }}
                               transition-opacity"

                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                        />

                    </svg>

                    <span>Jurnal PKL</span>

                </a>


                {{-- PENILAIAN --}}
                <a
                    href="{{ route('guru.penilaian.index') }}"

                    class="group flex items-center gap-3
                           px-3 py-2.5
                           rounded-xl
                           text-sm
                           transition-all duration-150
                           {{ request()->routeIs('guru.penilaian.*')
                                ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm shadow-blue-500/5'
                                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0
                               {{ request()->routeIs('guru.penilaian.*')
                                    ? 'opacity-100'
                                    : 'opacity-50 group-hover:opacity-80' }}
                               transition-opacity"

                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"
                        />

                    </svg>

                    <span>Penilaian</span>

                </a>


                {{-- PROFIL --}}
                <a
                    href="{{ route('profile.edit-guru') }}"

                    class="group flex items-center gap-3
                           px-3 py-2.5
                           rounded-xl
                           text-sm
                           transition-all duration-150
                           {{ request()->routeIs('profile.*')
                                ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm shadow-blue-500/5'
                                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0
                               {{ request()->routeIs('profile.*')
                                    ? 'opacity-100'
                                    : 'opacity-50 group-hover:opacity-80' }}
                               transition-opacity"

                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                        />

                    </svg>

                    <span>Profil</span>

                </a>

            </div>

        </nav>


        {{-- USER BOTTOM --}}
        <div
            class="shrink-0
                   px-4 py-3.5
                   border-t border-slate-200"
        >

            <div class="flex items-center justify-between gap-3">

                <div class="min-w-0 flex items-center gap-3">

                    <div
                        class="w-8 h-8 rounded-lg
                               bg-gradient-to-br from-blue-500 to-blue-700
                               flex items-center justify-center
                               text-xs font-bold
                               text-white
                               shrink-0"
                    >
                        {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}
                    </div>

                    <div class="min-w-0">

                        <p class="text-[13px] font-semibold text-slate-800 truncate">
                            {{ auth()->user()->name ?? 'Guru' }}
                        </p>

                        <p class="text-[10px] text-slate-400 leading-none mt-0.5">
                            Guru
                        </p>

                    </div>

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
    aria-label="Keluar / Logout"
    class="group relative flex h-9 w-9 items-center justify-center
                               border border-rose-200
                               bg-rose-50
                               text-rose-500
                               hover:bg-rose-600
                               hover:text-white
                               hover:border-rose-600
                               active:scale-95
                               transition-all duration-150"
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
                            class="absolute left-1/2 -top-8 -translate-x-1/2
                                   opacity-0 group-hover:opacity-100
                                   pointer-events-none
                                   rounded-md
                                   bg-slate-800
                                   px-2 py-1
                                   text-[10px]
                                   font-medium
                                   text-white
                                   shadow-md
                                   transition-opacity duration-150
                                   whitespace-nowrap
                                   border border-slate-700"
                        >
                            Logout
                        </span>

                    </button>

                </form>

            </div>

        </div>

    </aside>


    {{-- MAIN --}}
    <main
        :class="sidebarOpen ? 'lg:pl-[260px]' : 'lg:pl-0'"

        class="min-h-screen
               flex flex-col
               transition-[padding]
               duration-300
               ease-[cubic-bezier(0.4,0,0.2,1)]"
    >

        {{-- HEADER --}}
        <header
            class="h-16 shrink-0
                   bg-white/95
                   backdrop-blur-md
                   border-b border-slate-200
                   flex items-center justify-between
                   px-4 sm:px-6 lg:px-8
                   sticky top-0 z-30"
        >

            <div class="flex items-center gap-3 min-w-0">

                
                   {{-- MENU BUTTON --}}
<button
    type="button"
    @click="sidebarOpen = !sidebarOpen"
    class="w-9 h-9 rounded-xl
           bg-white
           border border-slate-200
           flex items-center justify-center
           text-slate-500
           hover:text-slate-800
           hover:bg-slate-50
           hover:border-slate-300
           transition-all
           shrink-0"
    aria-label="Buka atau tutup menu navigasi"
>
    <svg
        class="w-[18px] h-[18px]"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h16"
        />
    </svg>
</button>


                <h2
                    class="text-sm sm:text-[15px]
                           font-semibold text-slate-800
                           truncate"
                >
                    {{ $header ?? 'Dashboard Guru' }}
                </h2>

            </div>

        </header>


        {{-- CONTENT --}}
        <div
            class="flex-1
                   p-4 sm:p-6 lg:p-8
                   w-full max-w-[1600px]
                   mx-auto"
        >

            {{ $slot }}

        </div>


        {{-- FOOTER --}}
        <footer
            class="shrink-0
                   px-4 sm:px-6 lg:px-8
                   py-4
                   border-t border-slate-200"
        >

            <p class="text-[11px] text-slate-400 text-center">
                &copy; {{ date('Y') }} Sistem Informasi Jurnal PKL
            </p>

        </footer>

    </main>

</div>


{{-- Library SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        // Konfigurasi dasar SweetAlert2 agar sesuai dengan warna website guru (Tema terang)
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


{{-- CSS untuk memperbaiki posisi agar PASTI di tengah --}}
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

        border-radius: 8px !important;

        font-weight: 600 !important;

    }


    .swal2-styled.swal2-cancel {

        border-radius: 8px !important;

        font-weight: 600 !important;

    }

</style>

</body>

</html>