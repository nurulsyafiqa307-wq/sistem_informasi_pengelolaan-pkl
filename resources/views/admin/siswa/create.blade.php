<x-app-layout>

    {{-- ===== HIDE BROWSER DEFAULT PASSWORD EYE & FORCE LIGHT STYLES ===== --}}
    <style>
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear,
        input[type="password"]::-webkit-contacts-auto-fill-button,
        input[type="password"]::-webkit-credentials-auto-fill-button {
            display: none !important;
        }

        /* Override style input agar terang */
        .input-light {
            background-color: #ffffff !important;
            color: #0f172a !important;
            border: 1px solid #cbd5e1 !important;
        }
        .input-light:focus {
            border-color: #2563eb !important;
            outline: none !important;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2) !important;
        }
        .input-light::placeholder {
            color: #94a3b8 !important;
        }
    </style>

    <x-slot:title>Tambah Siswa</x-slot:title>

    <x-slot:header>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.siswa.index') }}" class="flex h-8 w-8 items-center justify-center rounded-lg transition hover:bg-slate-200" style="color: #64748b;">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
            </a>
            <div>
                <h2 class="text-[14px] lg:text-[15px] font-bold text-slate-800">Tambah Siswa</h2>
                <p class="text-[11px] hidden sm:block text-slate-500">Buat data siswa & akun login baru</p>
            </div>
        </div>
    </x-slot:header>

    {{-- ===== ALERT ERROR ===== --}}
    @if($errors->any())
        <div class="max-w-2xl mx-auto flex items-start gap-3 p-4 rounded-xl mb-5 bg-red-50 border border-red-200">
            <div class="flex h-8 w-8 items-center justify-center rounded-lg shrink-0 mt-0.5 bg-red-100">
                <i data-lucide="alert-circle" class="h-4 w-4 text-red-600"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-[12.5px] font-semibold mb-1.5 text-red-600">Data belum lengkap:</p>
                <ul class="space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li class="text-[11.5px] text-red-500">• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button onclick="this.closest('div').remove()" class="shrink-0 text-red-400 hover:text-red-600">
                <i data-lucide="x" class="h-4 w-4"></i>
            </button>
        </div>
    @endif

    <form action="{{ route('admin.siswa.store') }}" method="POST" class="max-w-2xl mx-auto">

        @csrf

        {{-- ===== SECTION 1: DATA SISWA ===== --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 mb-4">
            <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50">
                    <i data-lucide="user-plus" class="h-[18px] w-[18px] text-blue-600"></i>
                </div>
                <div>
                    <h3 class="text-[14px] font-bold text-slate-800">Data Siswa</h3>
                    <p class="text-[11px] text-slate-500">Informasi pribadi & akademik</p>
                </div>
                <span class="ml-auto text-[9px] font-bold uppercase tracking-widest px-2 py-0.5 rounded bg-blue-50 text-blue-600">Langkah 1</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-[11px] font-semibold mb-1.5 text-slate-700">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                           class="input-light w-full rounded-lg px-3.5 py-2.5 text-[12.5px]"
                           placeholder="Masukkan nama lengkap" required>
                </div>

                <div>
                    <label class="block text-[11px] font-semibold mb-1.5 text-slate-700">
                        NIS <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nis" value="{{ old('nis') }}"
                           class="input-light w-full rounded-lg px-3.5 py-2.5 text-[12.5px] font-mono"
                           placeholder="Nomor Induk Siswa" required>
                </div>

                <div>
                    <label class="block text-[11px] font-semibold mb-1.5 text-slate-700">
                        No. HP
                    </label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                        class="input-light w-full rounded-lg px-3.5 py-2.5 text-[12.5px]"
                        placeholder="08123456789"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        maxlength="15"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>

               <div>
                    <label class="block text-[11px] font-semibold mb-1.5 text-slate-700">
                        Kelas <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        name="kelas"
                        value="{{ old('kelas', 'XII') }}"
                        class="input-light w-full rounded-lg px-3.5 py-2.5 text-[12.5px]"
                        readonly
                        required>
                </div>

                <div>
                    <label class="block text-[11px] font-semibold mb-1.5 text-slate-700">
                        Jurusan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="jurusan" value="{{ old('jurusan') }}"
                           class="input-light w-full rounded-lg px-3.5 py-2.5 text-[12.5px]"
                           placeholder="PPLG" required>
                </div>
            </div>
        </div>

        {{-- ===== DIVIDER ===== --}}
        <div class="flex items-center gap-3 my-5">
            <div class="flex-1 h-px bg-slate-200"></div>
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 border border-slate-200">
                <i data-lucide="chevron-down" class="h-3 w-3 text-slate-400"></i>
                <span class="text-[10px] font-semibold uppercase tracking-widest text-slate-500">Selanjutnya</span>
                <i data-lucide="chevron-down" class="h-3 w-3 text-slate-400"></i>
            </div>
            <div class="flex-1 h-px bg-slate-200"></div>
        </div>

        {{-- ===== SECTION 2: AKUN LOGIN ===== --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 mb-5">
            <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-purple-50">
                    <i data-lucide="shield-check" class="h-[18px] w-[18px] text-purple-600"></i>
                </div>
                <div>
                    <h3 class="text-[14px] font-bold text-slate-800">Akun Login</h3>
                    <p class="text-[11px] text-slate-500">Kredensial untuk akses sistem</p>
                </div>
                <span class="ml-auto text-[9px] font-bold uppercase tracking-widest px-2 py-0.5 rounded bg-purple-50 text-purple-600">Langkah 2</span>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-[11px] font-semibold mb-1.5 text-slate-700">
                        E-mail <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-3.5 top-1/2 -translate-y-1/2 h-3.5 w-3.5 text-slate-400"></i>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="input-light w-full rounded-lg pl-10 pr-3.5 py-2.5 text-[12.5px]"
                               placeholder="siswa@email.com" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-semibold mb-1.5 text-slate-700">
                            Kata Sandi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i data-lucide="lock" class="absolute left-3.5 top-1/2 -translate-y-1/2 h-3.5 w-3.5 text-slate-400"></i>
                            <input type="password" name="password" id="password"
                                   class="input-light w-full rounded-lg pl-10 pr-10 py-2.5 text-[12.5px]"
                                   placeholder="Min. 8 karakter" required minlength="8">
                            <button type="button" onclick="togglePw('password', this)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 p-1 text-slate-400 hover:text-slate-600 focus:outline-none z-10">
                                <i data-lucide="eye-off" class="h-3.5 w-3.5"></i>
                            </button>
                        </div>
                        <div class="flex gap-1 mt-2" id="strBar">
                            <div class="h-1 flex-1 rounded-full transition-all duration-300 bg-slate-100"></div>
                            <div class="h-1 flex-1 rounded-full transition-all duration-300 bg-slate-100"></div>
                            <div class="h-1 flex-1 rounded-full transition-all duration-300 bg-slate-100"></div>
                            <div class="h-1 flex-1 rounded-full transition-all duration-300 bg-slate-100"></div>
                        </div>
                        <p class="text-[10px] mt-1 text-slate-400" id="strTxt">Belum diisi</p>
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold mb-1.5 text-slate-700">
                            Konfirmasi Sandi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i data-lucide="lock" class="absolute left-3.5 top-1/2 -translate-y-1/2 h-3.5 w-3.5 text-slate-400"></i>
                            <input type="password" name="password_confirmation" id="pwConfirm"
                                   class="input-light w-full rounded-lg pl-10 pr-10 py-2.5 text-[12.5px]"
                                   placeholder="Ulangi sandi" required>
                            <button type="button" onclick="togglePw('pwConfirm', this)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 p-1 text-slate-400 hover:text-slate-600 focus:outline-none z-10">
                                <i data-lucide="eye-off" class="h-3.5 w-3.5"></i>
                            </button>
                        </div>
                        <p class="text-[10px] mt-2 hidden text-red-500" id="matchTxt">
                            ✕ Kata sandi tidak cocok
                        </p>
                        <p class="text-[10px] mt-2 hidden text-emerald-600" id="matchOk">
                            ✓ Kata sandi cocok
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-2.5 p-3 rounded-lg bg-purple-50 border border-purple-100">
                    <i data-lucide="info" class="h-3.5 w-3.5 shrink-0 mt-0.5 text-purple-600"></i>
                    <p class="text-[10.5px] leading-relaxed text-slate-600">
                        Akun login dibuat otomatis setelah data disimpan. Siswa bisa masuk ke sistem menggunakan email dan kata sandi di atas.
                    </p>
                </div>
            </div>
        </div>

        {{-- ===== TOMBOL ===== --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.siswa.index') }}" class="px-4 py-2 text-[12.5px] font-medium rounded-lg text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 transition flex items-center gap-1.5">
                <i data-lucide="x" class="h-3.5 w-3.5"></i>
                Batal
            </a>
            <button type="submit" class="px-4 py-2 text-[12.5px] font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition flex items-center gap-1.5 shadow-sm">
                <i data-lucide="check" class="h-4 w-4"></i>
                Simpan Data
            </button>
        </div>
    </form>

    {{-- Script diletakkan langsung tanpa @push --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        function togglePw(id, btn) {
            const inp = document.getElementById(id);
            if (!inp) return;

            if (inp.type === 'password') {
                inp.type = 'text';
                btn.innerHTML = '<i data-lucide="eye" class="h-3.5 w-3.5"></i>';
            } else {
                inp.type = 'password';
                btn.innerHTML = '<i data-lucide="eye-off" class="h-3.5 w-3.5"></i>';
            }
            
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        const pw = document.getElementById('password');
        const bars = document.querySelectorAll('#strBar > div');
        const stxt = document.getElementById('strTxt');
        const colors = ['#ef4444', '#f59e0b', '#3b82f6', '#22c55e'];
        const labels = ['Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];

        if (pw) {
            pw.addEventListener('input', function () {
                const v = this.value;
                let s = 0;
                if (v.length >= 8) s++;
                if (/[A-Z]/.test(v)) s++;
                if (/[0-9]/.test(v)) s++;
                if (/[^A-Za-z0-9]/.test(v)) s++;
                bars.forEach((b, i) => {
                    b.style.background = i < s ? colors[s - 1] : '#f1f5f9';
                });
                stxt.textContent = v.length === 0 ? 'Belum diisi' : (s > 0 ? labels[s - 1] : 'Terlalu pendek');
                stxt.style.color = v.length === 0 ? '#94a3b8' : (s > 0 ? colors[s - 1] : '#94a3b8');
                checkMatch();
            });
        }

        const pwc = document.getElementById('pwConfirm');
        const mt = document.getElementById('matchTxt');
        const mo = document.getElementById('matchOk');

        function checkMatch() {
            if (!pwc || !pw) return;
            if (pwc.value.length === 0) {
                mt.classList.add('hidden');
                mo.classList.add('hidden');
            } else if (pwc.value !== pw.value) {
                mt.classList.remove('hidden');
                mo.classList.add('hidden');
            } else {
                mt.classList.add('hidden');
                mo.classList.remove('hidden');
            }
        }

        if (pwc) {
            pwc.addEventListener('input', checkMatch);
        }
    </script>
</x-app-layout>