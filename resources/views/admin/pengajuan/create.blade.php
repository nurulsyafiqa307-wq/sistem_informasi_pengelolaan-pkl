<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
                    Tambah Pengajuan PKL
                </h1>
                <p class="text-sm text-slate-500 mt-0.5">
                    Buat pengajuan PKL baru untuk siswa.
                </p>
            </div>

            <a
                href="{{ route('admin.pengajuan.index') }}"
                class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 transition-all shadow-sm"
            >
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto py-2 pb-8">

        <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">

            {{-- PESAN ERROR --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">
                    <div class="flex items-center gap-2 mb-2 text-red-600 font-semibold text-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 01-18 0z"
                            />
                        </svg>
                        Data belum bisa disimpan:
                    </div>

                    <ul class="list-disc list-inside text-xs text-red-500 space-y-1 ml-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('admin.pengajuan.store') }}"
                method="POST"
                class="space-y-6"
            >
                @csrf

                {{-- SISWA --}}
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600">
                        Siswa
                    </label>

                    <select
                        name="siswa_id"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition cursor-pointer"
                        style="background-color: #ffffff !important; color: #1e293b !important; color-scheme: light !important;"
                    >
                        <option value="">
                            -- Pilih Siswa --
                        </option>

                        @foreach($siswas as $siswa)
                            <option
                                value="{{ $siswa->id }}"
                                {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}
                            >
                                {{ $siswa->nama }}
                            </option>
                        @endforeach
                    </select>

                    @error('siswa_id')
                        <p class="text-xs text-red-500 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- TEMPAT PKL --}}
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600">
                        Tempat PKL
                    </label>

                    <select
                        name="tempat_pkl_id"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition cursor-pointer"
                        style="background-color: #ffffff !important; color: #1e293b !important; color-scheme: light !important;"
                    >
                        <option value="">
                            -- Pilih Tempat PKL --
                        </option>

                        @foreach($tempatPkls as $tempat)
                            <option
                                value="{{ $tempat->id }}"
                                {{ old('tempat_pkl_id') == $tempat->id ? 'selected' : '' }}
                            >
                                {{ $tempat->nama_perusahaan }}
                            </option>
                        @endforeach
                    </select>

                    @error('tempat_pkl_id')
                        <p class="text-xs text-red-500 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- TANGGAL PENGAJUAN --}}
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600">
                        Tanggal Pengajuan
                    </label>

                    <input
                        type="date"
                        name="tanggal_pengajuan"
                        value="{{ old('tanggal_pengajuan', date('Y-m-d')) }}"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition"
                        style="background-color: #ffffff !important; color: #1e293b !important; color-scheme: light !important;"
                    >

                    @error('tanggal_pengajuan')
                        <p class="text-xs text-red-500 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- STATUS --}}
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600">
                        Status Pengajuan
                    </label>

                    <select
                        name="status"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition cursor-pointer"
                        style="background-color: #ffffff !important; color: #1e293b !important; color-scheme: light !important;"
                    >
                        <option
                            value="Menunggu Seleksi"
                            {{ old('status', 'Menunggu Seleksi') == 'Menunggu Seleksi' ? 'selected' : '' }}
                        >
                            Menunggu Seleksi
                        </option>

                        <option
                            value="Lolos"
                            {{ old('status') === 'Lolos' ? 'selected' : '' }}
                        >
                            Lolos
                        </option>

                        <option
                            value="Tidak Lolos"
                            {{ old('status') === 'Tidak Lolos' ? 'selected' : '' }}
                        >
                            Tidak Lolos
                        </option>
                    </select>

                    @error('status')
                        <p class="text-xs text-red-500 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- TOMBOL AKSIONAL --}}
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">

                    <a
                        href="{{ route('admin.pengajuan.index') }}"
                        class="px-5 py-2.5 rounded-xl bg-white border border-slate-300 hover:bg-slate-50 transition text-slate-700 text-sm font-medium"
                    >
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 transition text-white text-sm font-semibold shadow-sm active:scale-[0.98]"
                    >
                        Simpan Pengajuan
                    </button>

                </div>

            </form>
        </div>
    </div>

</x-app-layout>