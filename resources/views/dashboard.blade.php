<x-app-layout>
    <x-slot:name="header">
        <div>
            <h2 class="text-lg font-bold text-white">Dashboard</h2>
            <p class="text-xs text-slate-500 mt-0.5">Ringkasan data sistem informasi PKL</p>
        </div>
    </x-slot>

    @php
        $jumlahSiswa     = \App\Models\Siswa::count() ?? 0;
        $jumlahGuru      = \App\Models\Guru::count() ?? 0;
        $jumlahTempat    = \App\Models\TempatPKL::count() ?? 0;
        $jumlahPengajuan = \App\Models\PengajuanPkl::count() ?? 0;
        $jumlahJurnal    = \App\Models\JurnalPKL::count() ?? 0;
        $jurnalHariIni   = \App\Models\JurnalPKL::whereDate('tanggal', now())->count() ?? 0;
        $pengajuanMenunggu = \App\Models\PengajuanPkl::where('status', 'menunggu')->count() ?? 0;
        $jurnalMenunggu  = \App\Models\JurnalPKL::where('status_jurnal', 'Menunggu Review')->count() ?? 0;
    @endphp

    <!-- Welcome Banner -->
    <div class="relative mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-700 p-[1px]">
        <div class="rounded-[23px] bg-gradient-to-r from-blue-600/90 via-indigo-600/90 to-purple-700/90 px-8 py-8 backdrop-blur-sm">
            <!-- Dekorasi lingkaran -->
            <div class="pointer-events-none absolute -right-10 -top-10 h-48 w-48 rounded-full bg-white/[0.06]"></div>
            <div class="pointer-events-none absolute -bottom-16 -left-8 h-40 w-40 rounded-full bg-white/[0.04]"></div>
            <div class="pointer-events-none absolute right-1/4 bottom-0 h-24 w-24 rounded-full bg-white/[0.03]"></div>

            <div class="relative z-10">
                <p class="text-sm font-medium text-blue-200">{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</p>
                <h1 class="mt-2 text-2xl font-extrabold text-white sm:text-3xl">
                    Selamat datang, {{ Auth::user()->name ?? 'Administrator' }} 👋
                </h1>
                <p class="mt-2 max-w-lg text-sm text-blue-100/70">Kelola data PKL, pantau jurnal harian siswa, dan kelola penilaian dari satu tempat.</p>
            </div>
        </div>
    </div>


    <!-- ===== STAT CARDS (COLORFUL) ===== -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-6">

        <!-- Siswa - Blue -->
        <div class="stat-card relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 to-blue-800 p-5 shadow-lg shadow-blue-600/20">
            <div class="pointer-events-none absolute -right-6 -top-6 h-28 w-28 rounded-full bg-white/[0.08]"></div>
            <div class="pointer-events-none absolute -bottom-4 -left-4 h-16 w-16 rounded-full bg-white/[0.05]"></div>
            <div class="relative z-10">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/15 backdrop-blur-sm">
                    <i data-lucide="graduation-cap" class="h-5 w-5 text-white"></i>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-white">{{ $jumlahSiswa }}</p>
                <p class="mt-1 text-xs font-medium text-blue-200/70">Total Siswa</p>
            </div>
        </div>

        <!-- Guru - Emerald -->
        <div class="stat-card relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-600 to-emerald-800 p-5 shadow-lg shadow-emerald-600/20">
            <div class="pointer-events-none absolute -right-6 -top-6 h-28 w-28 rounded-full bg-white/[0.08]"></div>
            <div class="relative z-10">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/15 backdrop-blur-sm">
                    <i data-lucide="users" class="h-5 w-5 text-white"></i>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-white">{{ $jumlahGuru }}</p>
                <p class="mt-1 text-xs font-medium text-emerald-200/70">Total Guru</p>
            </div>
        </div>

        <!-- Tempat PKL - Violet -->
        <div class="stat-card relative overflow-hidden rounded-2xl bg-gradient-to-br from-violet-600 to-violet-800 p-5 shadow-lg shadow-violet-600/20">
            <div class="pointer-events-none absolute -right-6 -top-6 h-28 w-28 rounded-full bg-white/[0.08]"></div>
            <div class="relative z-10">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/15 backdrop-blur-sm">
                    <i data-lucide="building-2" class="h-5 w-5 text-white"></i>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-white">{{ $jumlahTempat }}</p>
                <p class="mt-1 text-xs font-medium text-violet-200/70">Tempat PKL</p>
            </div>
        </div>

        <!-- Pengajuan - Amber -->
        <div class="stat-card relative overflow-hidden rounded-2xl bg-gradient-to-br from-amber-500 to-orange-700 p-5 shadow-lg shadow-amber-500/20">
            <div class="pointer-events-none absolute -right-6 -top-6 h-28 w-28 rounded-full bg-white/[0.08]"></div>
            <div class="relative z-10">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/15 backdrop-blur-sm">
                    <i data-lucide="file-text" class="h-5 w-5 text-white"></i>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-white">{{ $jumlahPengajuan }}</p>
                <p class="mt-1 text-xs font-medium text-amber-200/70">
                    @if($pengajuanMenunggu > 0)
                        <span class="inline-flex items-center gap-1 font-semibold text-white">
                            <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                            {{ $pengajuanMenunggu }} menunggu
                        </span>
                    @else
                        Semua diproses
                    @endif
                </p>
            </div>
        </div>

        <!-- Jurnal - Cyan -->
        <div class="stat-card relative overflow-hidden rounded-2xl bg-gradient-to-br from-cyan-600 to-teal-700 p-5 shadow-lg shadow-cyan-600/20">
            <div class="pointer-events-none absolute -right-6 -top-6 h-28 w-28 rounded-full bg-white/[0.08]"></div>
            <div class="relative z-10">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/15 backdrop-blur-sm">
                    <i data-lucide="notebook-pen" class="h-5 w-5 text-white"></i>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-white">{{ $jumlahJurnal }}</p>
                <p class="mt-1 text-xs font-medium text-cyan-200/70">Total Jurnal</p>
            </div>
        </div>

        <!-- Jurnal Hari Ini - Rose -->
        <div class="stat-card relative overflow-hidden rounded-2xl bg-gradient-to-br from-rose-600 to-pink-800 p-5 shadow-lg shadow-rose-600/20">
            <div class="pointer-events-none absolute -right-6 -top-6 h-28 w-28 rounded-full bg-white/[0.08]"></div>
            <div class="relative z-10">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/15 backdrop-blur-sm">
                    <i data-lucide="calendar-check" class="h-5 w-5 text-white"></i>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-white">{{ $jurnalHariIni }}</p>
                <p class="mt-1 text-xs font-medium text-rose-200/70">
                    @if($jurnalMenunggu > 0)
                        <span class="inline-flex items-center gap-1 font-semibold text-white">
                            <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                            {{ $jurnalMenunggu }} perlu review
                        </span>
                    @else
                        Hari ini
                    @endif
                </p>
            </div>
        </div>

    </div>


    <!-- ===== 2 KOLOM BAWAH ===== -->
    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-2">

        <!-- Pengajuan Terbaru -->
        <div class="rounded-2xl border border-white/[0.06] bg-[#1a2332] shadow-xl overflow-hidden">
            <div class="flex items-center justify-between border-b border-white/[0.06] px-6 py-4">
                <div class="flex items-center gap-2.5">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-500/15 text-amber-400">
                        <i data-lucide="clock" class="h-4 w-4"></i>
                    </div>
                    <h3 class="text-sm font-bold text-white">Pengajuan Terbaru</h3>
                </div>
                <a href="#" class="text-xs font-semibold text-blue-400 hover:text-blue-300 transition">Lihat Semua →</a>
            </div>
            <div class="divide-y divide-white/[0.04]">
                @php
                    $pengajuans = \App\Models\PengajuanPkl::with(['siswa', 'tempatPkl'])->latest()->take(5)->get();
                @endphp
                @if($pengajuans->count() > 0)
                    @foreach($pengajuans as $p)
                        <div class="flex items-center justify-between px-6 py-3.5 transition hover:bg-white/[0.02]">
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-semibold text-slate-200">{{ $p->siswa->nama ?? '-' }}</p>
                                <p class="mt-0.5 truncate text-xs text-slate-500">{{ $p->tempatPkl->nama_perusahaan ?? '-' }} · {{ $p->tanggal_pengajuan }}</p>
                            </div>
                            @php
                                $badge = match($p->status) {
                                    'lolos'       => 'bg-emerald-500/15 text-emerald-400 ring-emerald-500/30',
                                    'tidak lolos' => 'bg-red-500/15 text-red-400 ring-red-500/30',
                                    default       => 'bg-amber-500/15 text-amber-400 ring-amber-500/30',
                                };
                                $label = match($p->status) {
                                    'lolos'       => 'Lolos',
                                    'tidak lolos' => 'Tidak Lolos',
                                    default       => 'Menunggu',
                                };
                            @endphp
                            <span class="ml-4 shrink-0 rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide ring-1 ring-inset {{ $badge }}">{{ $label }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="px-6 py-14 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/[0.03]">
                            <i data-lucide="inbox" class="h-7 w-7 text-slate-700"></i>
                        </div>
                        <p class="mt-3 text-sm text-slate-600">Belum ada pengajuan</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Jurnal Terbaru -->
        <div class="rounded-2xl border border-white/[0.06] bg-[#1a2332] shadow-xl overflow-hidden">
            <div class="flex items-center justify-between border-b border-white/[0.06] px-6 py-4">
                <div class="flex items-center gap-2.5">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-cyan-500/15 text-cyan-400">
                        <i data-lucide="pen-line" class="h-4 w-4"></i>
                    </div>
                    <h3 class="text-sm font-bold text-white">Jurnal Terbaru</h3>
                </div>
                <a href="#" class="text-xs font-semibold text-blue-400 hover:text-blue-300 transition">Lihat Semua →</a>
            </div>
            <div class="divide-y divide-white/[0.04]">
                @php
                    $jurnals = \App\Models\JurnalPKL::with('siswa')->latest()->take(5)->get();
                @endphp
                @if($jurnals->count() > 0)
                    @foreach($jurnals as $j)
                        <div class="flex items-center justify-between px-6 py-3.5 transition hover:bg-white/[0.02]">
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-semibold text-slate-200">{{ $j->siswa->nama ?? '-' }}</p>
                                <p class="mt-0.5 truncate text-xs text-slate-500">{{ $j->tanggal }} · {{ $j->jam_masuk }} - {{ $j->jam_pulang }}</p>
                            </div>
                            @php
                                $jBadge = match($j->status_jurnal) {
                                    'Disetujui'    => 'bg-emerald-500/15 text-emerald-400 ring-emerald-500/30',
                                    'Perlu Revisi' => 'bg-red-500/15 text-red-400 ring-red-500/30',
                                    default        => 'bg-sky-500/15 text-sky-400 ring-sky-500/30',
                                };
                            @endphp
                            <span class="ml-4 shrink-0 rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide ring-1 ring-inset {{ $jBadge }}">{{ $j->status_jurnal }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="px-6 py-14 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/[0.03]">
                            <i data-lucide="notebook-pen" class="h-7 w-7 text-slate-700"></i>
                        </div>
                        <p class="mt-3 text-sm text-slate-600">Belum ada jurnal</p>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <!-- ===== 3 KOLOM BAWAH ===== -->
    <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-3">

        <!-- Status PKL Siswa -->
        <div class="rounded-2xl border border-white/[0.06] bg-[#1a2332] p-6 shadow-xl">
            <div class="flex items-center gap-2.5 mb-5">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500/15 text-blue-400">
                    <i data-lucide="bar-chart-3" class="h-4 w-4"></i>
                </div>
                <h3 class="text-sm font-bold text-white">Status PKL Siswa</h3>
            </div>
            @php
                $pklAktif   = \App\Models\Siswa::where('status_pkl', 'Aktif')->count() ?? 0;
                $pklBelum   = \App\Models\Siswa::where('status_pkl', 'Belum')->count() ?? 0;
                $pklSelesai = \App\Models\Siswa::where('status_pkl', 'Selesai')->count() ?? 0;
                $totalSiswa = max($jumlahSiswa, 1);
            @endphp
            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="font-medium text-slate-400">Aktif PKL</span>
                        <span class="font-bold text-emerald-400">{{ $pklAktif }}</span>
                    </div>
                    <div class="h-2.5 overflow-hidden rounded-full bg-white/[0.06]">
                        <div class="h-full rounded-full bg-gradient-to-r from-emerald-500 to-emerald-400 transition-all duration-700" style="width:{{ ($pklAktif/$totalSiswa)*100 }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="font-medium text-slate-400">Belum PKL</span>
                        <span class="font-bold text-amber-400">{{ $pklBelum }}</span>
                    </div>
                    <div class="h-2.5 overflow-hidden rounded-full bg-white/[0.06]">
                        <div class="h-full rounded-full bg-gradient-to-r from-amber-500 to-amber-400 transition-all duration-700" style="width:{{ ($pklBelum/$totalSiswa)*100 }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="font-medium text-slate-400">Selesai</span>
                        <span class="font-bold text-blue-400">{{ $pklSelesai }}</span>
                    </div>
                    <div class="h-2.5 overflow-hidden rounded-full bg-white/[0.06]">
                        <div class="h-full rounded-full bg-gradient-to-r from-blue-500 to-blue-400 transition-all duration-700" style="width:{{ ($pklSelesai/$totalSiswa)*100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aksi Cepat -->
        <div class="rounded-2xl border border-white/[0.06] bg-[#1a2332] p-6 shadow-xl">
            <div class="flex items-center gap-2.5 mb-5">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-500/15 text-purple-400">
                    <i data-lucide="zap" class="h-4 w-4"></i>
                </div>
                <h3 class="text-sm font-bold text-white">Aksi Cepat</h3>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.siswa.index') }}" class="flex items-center gap-2.5 rounded-xl bg-white/[0.04] border border-white/[0.06] px-4 py-3 text-xs font-semibold text-slate-300 transition hover:bg-blue-600/20 hover:border-blue-500/30 hover:text-blue-300">
                    <i data-lucide="plus-circle" class="h-4 w-4 text-blue-400"></i>
                    Tambah Siswa Baru
                </a>
                <a href="#" class="flex items-center gap-2.5 rounded-xl bg-white/[0.04] border border-white/[0.06] px-4 py-3 text-xs font-semibold text-slate-300 transition hover:bg-emerald-600/20 hover:border-emerald-500/30 hover:text-emerald-300">
                    <i data-lucide="check-circle" class="h-4 w-4 text-emerald-400"></i>
                    Review Pengajuan
                    @if($pengajuanMenunggu > 0)
                        <span class="ml-auto rounded-full bg-amber-500 px-1.5 py-0.5 text-[9px] font-bold text-white">{{ $pengajuanMenunggu }}</span>
                    @endif
                </a>
                <a href="#" class="flex items-center gap-2.5 rounded-xl bg-white/[0.04] border border-white/[0.06] px-4 py-3 text-xs font-semibold text-slate-300 transition hover:bg-violet-600/20 hover:border-violet-500/30 hover:text-violet-300">
                    <i data-lucide="eye" class="h-4 w-4 text-violet-400"></i>
                    Review Jurnal Masuk Radot
                    @if($jurnalMenunggu > 0)
                        <span class="ml-auto rounded-full bg-rose-500 px-1.5 py-0.5 text-[9px] font-bold text-white">{{ $jurnalMenunggu }}</span>
                    @endif
                </a>
                <a href="#" class="flex items-center gap-2.5 rounded-xl bg-white/[0.04] border border-white/[0.06] px-4 py-3 text-xs font-semibold text-slate-300 transition hover:bg-cyan-600/20 hover:border-cyan-500/30 hover:text-cyan-300">
                    <i data-lucide="download" class="h-4 w-4 text-cyan-400"></i>
                    Cetak Laporan
                </a>
            </div>
        </div>

        <!-- Kuota Tempat PKL -->
        <div class="rounded-2xl border border-white/[0.06] bg-[#1a2332] p-6 shadow-xl">
            <div class="flex items-center gap-2.5 mb-5">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-500/15 text-amber-400">
                    <i data-lucide="map-pin" class="h-4 w-4"></i>
                </div>
                <h3 class="text-sm font-bold text-white">Kuota Tempat PKL</h3>
            </div>
            @php
                $tempats = \App\Models\TempatPKL::latest()->take(4)->get();
            @endphp
            @if($tempats->count() > 0)
                <div class="space-y-4">
                    @foreach($tempats as $t)
                        @php
                            $terisi = \App\Models\PengajuanPkl::where('tempat_id', $t->id_tempat)->where('status', 'lolos')->count() ?? 0;
                            $kuota  = $t->kuota ?? 0;
                            $persen = $kuota > 0 ? min(($terisi / $kuota) * 100, 100) : 0;
                            $color  = $persen >= 80 ? 'from-red-500 to-rose-400' : ($persen >= 50 ? 'from-amber-500 to-yellow-400' : 'from-blue-500 to-cyan-400');
                        @endphp
                        <div>
                            <div class="flex items-center justify-between text-xs mb-1.5">
                                <span class="truncate font-medium text-slate-400 max-w-[140px]">{{ $t->nama_perusahaan }}</span>
                                <span class="font-bold text-slate-300">{{ $terisi }}<span class="text-slate-600">/{{ $kuota }}</span></span>
                            </div>
                            <div class="h-2.5 overflow-hidden rounded-full bg-white/[0.06]">
                                <div class="h-full rounded-full bg-gradient-to-r {{ $color }} transition-all duration-700" style="width:{{ $persen }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-10">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/[0.03]">
                        <i data-lucide="building" class="h-7 w-7 text-slate-700"></i>
                    </div>
                    <p class="mt-3 text-xs text-slate-600">Belum ada data tempat</p>
                </div>
            @endif
        </div>
    </div>

    @stack('scripts')
</x-app-layout>