<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-[14px] lg:text-[15px] font-bold text-slate-800">
                    Edit Pengajuan PKL
                </h2>
                <p class="text-sm text-slate-400 mt-1">
                    Perbarui guru pembimbing dan status pengajuan PKL.
                </p>
            </div>

            <a
                href="{{ route('admin.pengajuan.index') }}"
                class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 transition shadow-sm"
            >
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto py-2">

        <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">

            {{-- PESAN ERROR --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">
                    <div class="flex items-center gap-2 mb-2 text-red-600 font-semibold text-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                action="{{ route('admin.pengajuan.update', $pengajuan) }}"
                method="POST"
                class="space-y-6"
            >
                @csrf
                @method('PUT')

                {{-- INFORMASI PENGAJUAN --}}
                <div>
                    <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50">
                            <svg class="w-[18px] h-[18px] text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-[14px] font-bold text-slate-800">
                                Informasi Pengajuan
                            </h3>
                            <p class="text-[11px] text-slate-500">
                                Data pengajuan tidak dapat diubah.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- SISWA --}}
                        <div>
                            <label class="block text-[11px] font-semibold mb-1.5 text-slate-600">
                                Siswa
                            </label>

                            <div class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                                {{ $pengajuan->siswa->nama ?? '-' }}
                            </div>
                        </div>

                        {{-- TEMPAT PKL --}}
                        <div>
                            <label class="block text-[11px] font-semibold mb-1.5 text-slate-600">
                                Tempat PKL
                            </label>

                            <div class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                                {{ $pengajuan->tempatPkl->nama_perusahaan ?? $pengajuan->tempatPkl->nama ?? '-' }}
                            </div>
                        </div>

                        {{-- TANGGAL PENGAJUAN --}}
                        <div class="sm:col-span-2">
                            <label class="block text-[11px] font-semibold mb-1.5 text-slate-600">
                                Tanggal Pengajuan
                            </label>

                            <div class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                                {{ $pengajuan->tanggal_pengajuan ?? '-' }}
                            </div>
                        </div>

                    </div>
                </div>

                {{-- DATA YANG BOLEH DIUBAH --}}
                <div class="pt-2">

                    <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50">
                            <svg class="w-[18px] w-[18px] text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-[14px] font-bold text-slate-800">
                                Perubahan Pengajuan
                            </h3>
                            <p class="text-[11px] text-slate-500">
                                Hanya guru pembimbing dan status yang dapat diubah.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-5">

                        {{-- STATUS --}}
                        <div class="space-y-1.5">
                            <label
                                for="status"
                                class="block text-xs font-semibold uppercase tracking-wider text-slate-600"
                            >
                                Status Pengajuan
                            </label>

                            <select
                                name="status"
                                id="status"
                                required
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition cursor-pointer"
                            >
                                <option
                                    value="Menunggu Seleksi"
                                    {{ old('status', $pengajuan->status) == 'Menunggu Seleksi' ? 'selected' : '' }}
                                >
                                    Menunggu Seleksi
                                </option>

                                <option
                                    value="Lolos"
                                    {{ old('status', $pengajuan->status) == 'Lolos' ? 'selected' : '' }}
                                >
                                    Lolos
                                </option>

                                <option
                                    value="Tidak Lolos"
                                    {{ old('status', $pengajuan->status) == 'Tidak Lolos' ? 'selected' : '' }}
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

                        {{-- GURU PEMBIMBING --}}
                        <div class="space-y-1.5">
                            <label
                                for="guru_pembimbing_id"
                                class="block text-xs font-semibold uppercase tracking-wider text-slate-600"
                            >
                                Guru Pembimbing
                            </label>

                            <select
                                name="guru_pembimbing_id"
                                id="guru_pembimbing_id"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition cursor-pointer"
                            >
                                <option value="">
                                    -- Pilih Guru Pembimbing --
                                </option>

                                @foreach($gurus as $guru)
                                    <option
                                        value="{{ $guru->id }}"
                                        {{ old(
                                            'guru_pembimbing_id',
                                            $pengajuan->siswa->guru_pembimbing_id ?? ''
                                        ) == $guru->id ? 'selected' : '' }}
                                    >
                                        {{ $guru->nama }}
                                    </option>
                                @endforeach
                            </select>

                            <p class="text-[11px] text-amber-600 flex items-center gap-1.5 mt-1.5">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                                Guru pembimbing wajib dipilih jika status pengajuan Lolos.
                            </p>

                            @error('guru_pembimbing_id')
                                <p class="text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- TOMBOL --}}
                <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-200">

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
                        Simpan Perubahan
                    </button>

                </div>

            </form>
        </div>
    </div>

</x-app-layout>