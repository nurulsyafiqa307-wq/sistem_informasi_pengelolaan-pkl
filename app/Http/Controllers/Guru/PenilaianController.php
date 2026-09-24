<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    /**
     * Menampilkan penilaian siswa bimbingan guru.
     */
    public function index()
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan.');
        }

        $siswas = Siswa::where('guru_pembimbing_id', $guru->id)
    ->with('penilaian')
    ->orderBy('nama')
    ->paginate(9)
    ->withQueryString();

        return view('guru.penilaian.index', compact('siswas'));
    }

    /**
     * Form penilaian siswa.
     */
    public function create(int $siswa)
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan.');
        }

        $siswa = Siswa::where('id', $siswa)
            ->where('guru_pembimbing_id', $guru->id)
            ->firstOrFail();

        // Cegah membuat penilaian kedua
        if ($siswa->penilaian) {
            return redirect()
                ->route('guru.penilaian.show', $siswa->penilaian->id);
        }

        return view('guru.penilaian.create', compact('siswa'));
    }

    /**
     * Menyimpan penilaian.
     */
    public function store(Request $request)
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan.');
        }

        $data = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'disiplin' => 'required|integer|min:0|max:100',
            'komunikasi' => 'required|integer|min:0|max:100',
            'kerjasama' => 'required|integer|min:0|max:100',
            'tanggung_jawab' => 'required|integer|min:0|max:100',
            'keterampilan' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        // Pastikan siswa memang siswa bimbingan guru
        $siswa = Siswa::where('id', $data['siswa_id'])
            ->where('guru_pembimbing_id', $guru->id)
            ->firstOrFail();

        // Cegah penilaian ganda
        if ($siswa->penilaian) {
            return redirect()
                ->route('guru.penilaian.index')
                ->with('error', 'Siswa tersebut sudah memiliki penilaian.');
        }

        // Hitung rata-rata
        $data['rata_rata'] = (
            $data['disiplin'] +
            $data['komunikasi'] +
            $data['kerjasama'] +
            $data['tanggung_jawab'] +
            $data['keterampilan']
        ) / 5;

        Penilaian::create($data);

            $siswa->update([
                'status_pkl' => 'Selesai PKL',
            ]);

        return redirect()
            ->route('guru.penilaian.index')
            ->with('success', 'Penilaian berhasil disimpan.');
    }

    /**
     * Menampilkan detail penilaian.
     */
    public function show(int $id)
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan.');
        }

        $penilaian = Penilaian::with('siswa')
            ->where('id', $id)
            ->whereHas('siswa', function ($query) use ($guru) {
                $query->where('guru_pembimbing_id', $guru->id);
            })
            ->firstOrFail();

        return view('guru.penilaian.show', compact('penilaian'));
    }

    /**
     * Form edit penilaian.
     */
    public function edit(int $id)
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan.');
        }

        $penilaian = Penilaian::with('siswa')
            ->where('id', $id)
            ->whereHas('siswa', function ($query) use ($guru) {
                $query->where('guru_pembimbing_id', $guru->id);
            })
            ->firstOrFail();

        return view('guru.penilaian.edit', compact('penilaian'));
    }

    /**
     * Memperbarui penilaian.
     */
    public function update(Request $request, int $id)
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan.');
        }

        $penilaian = Penilaian::where('id', $id)
            ->whereHas('siswa', function ($query) use ($guru) {
                $query->where('guru_pembimbing_id', $guru->id);
            })
            ->firstOrFail();

        $data = $request->validate([
            'disiplin' => 'required|integer|min:0|max:100',
            'komunikasi' => 'required|integer|min:0|max:100',
            'kerjasama' => 'required|integer|min:0|max:100',
            'tanggung_jawab' => 'required|integer|min:0|max:100',
            'keterampilan' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        // Hitung ulang rata-rata
        $data['rata_rata'] = (
            $data['disiplin'] +
            $data['komunikasi'] +
            $data['kerjasama'] +
            $data['tanggung_jawab'] +
            $data['keterampilan']
        ) / 5;

        $penilaian->update($data);

        return redirect()
            ->route('guru.penilaian.index')
            ->with('success', 'Penilaian berhasil diperbarui.');
    }

    /**
     * Menghapus penilaian.
     */
    public function destroy(int $id)
{
    $guru = Auth::user()->guru;

    if (!$guru) {
        abort(403, 'Data guru tidak ditemukan.');
    }

    $penilaian = Penilaian::where('id', $id)
        ->whereHas('siswa', function ($query) use ($guru) {
            $query->where('guru_pembimbing_id', $guru->id);
        })
        ->firstOrFail();

    $siswa = $penilaian->siswa;

$penilaian->delete();

if ($siswa) {
    $siswa->update([
        'status_pkl' => 'Sedang PKL',
    ]);
}

    return redirect()
        ->route('guru.penilaian.index')
        ->with('success', 'Penilaian berhasil dihapus.');
}
}
