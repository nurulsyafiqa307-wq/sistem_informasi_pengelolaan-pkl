<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Menampilkan semua data siswa
     */
    public function index(Request $request)
{
    $search = trim($request->input('search', ''));

    $siswas = Siswa::with('user')
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nis', 'like', '%' . $search . '%')
                    ->orWhere('kelas', 'like', '%' . $search . '%')
                    ->orWhere('jurusan', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view(
        'admin.siswa.index',
        compact('siswas', 'search')
    );
}

    /**
     * Menampilkan form tambah siswa
     */
    public function create()
    {
        return view('admin.siswa.create');
    }

    /**
     * Menyimpan data siswa dan membuat akun login
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'nis' => 'required|string|max:50|unique:siswas,nis',
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
            'no_hp' => 'nullable|digits_between:10,15',
        ]);

        DB::transaction(function () use ($validated) {

            // Membuat akun login
           $user = User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role_id' => 3,
            ]);

            // Membuat data siswa
            Siswa::create([
                'user_id' => $user->id,
                'nis' => $validated['nis'],
                'nama' => $validated['nama'],
                'kelas' => $validated['kelas'],
                'jurusan' => $validated['jurusan'],
                'no_hp' => $validated['no_hp'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa dan akun login berhasil dibuat.');
    }

    /**
     * Menampilkan detail siswa
     */
    public function show(Siswa $siswa)
    {
        $siswa->load('user');

        return view('admin.siswa.show', compact('siswa'));
    }

    /**
     * Menampilkan form edit siswa
     */
    public function edit(Siswa $siswa)
    {
        $siswa->load('user');

        return view('admin.siswa.edit', compact('siswa'));
    }

    /**
     * Mengupdate data siswa dan akun login
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $siswa->user_id,
            'nis' => 'required|string|max:50|unique:siswas,nis,' . $siswa->id,
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
            'no_hp' => 'nullable|digits_between:10,15',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        DB::transaction(function () use ($validated, $siswa) {

            // Update data siswa
            $siswa->update([
                'nama' => $validated['nama'],
                'nis' => $validated['nis'],
                'kelas' => $validated['kelas'],
                'jurusan' => $validated['jurusan'],
                'no_hp' => $validated['no_hp'] ?? null,
            ]);

            // Update akun login
            if ($siswa->user) {
                $user = $siswa->user;

                $user->name = $validated['nama'];
                $user->email = $validated['email'];

                // Password hanya berubah jika diisi
                if (!empty($validated['password'])) {
                    $user->password = Hash::make($validated['password']);
                }

                $user->save();
            }
        });

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Menghapus data siswa dan akun login
     */
    public function destroy(Siswa $siswa)
    {
        DB::transaction(function () use ($siswa) {

            if ($siswa->user) {
                $siswa->user->delete();
            }

            $siswa->delete();
        });

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}