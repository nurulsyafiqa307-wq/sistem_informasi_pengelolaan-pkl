<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JurnalPKL;
use App\Models\PengajuanPkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalPKLController extends Controller
{
    /**
     * Menampilkan jurnal milik siswa yang sedang login.
     */
    public function index(Request $request)
{
    $siswa = Auth::user()->siswa;

    if (!$siswa) {
        abort(403, 'Data siswa tidak ditemukan.');
    }

    // Ambil semua bulan yang memiliki jurnal
    $bulanTersedia = JurnalPKL::where('siswa_id', $siswa->id)
        ->selectRaw("DATE_FORMAT(tanggal, '%Y-%m') as bulan")
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('bulan');

    // Jika belum memilih bulan, buka bulan dari jurnal terbaru
    if ($request->filled('bulan')) {
        $bulan = $request->input('bulan');

        // Pastikan bulan yang dipilih memang dimiliki siswa
        if (!$bulanTersedia->contains($bulan)) {
            $bulan = $bulanTersedia->last();
        }
    } else {
        $bulan = $bulanTersedia->last();
    }

    // Jika belum ada jurnal sama sekali
    if (!$bulan) {
        $bulan = now()->format('Y-m');
    }

    // Ambil jurnal hanya dari bulan yang sedang dipilih
    $jurnals = JurnalPKL::where('siswa_id', $siswa->id)
        ->whereYear('tanggal', substr($bulan, 0, 4))
        ->whereMonth('tanggal', substr($bulan, 5, 2))
        ->latest('tanggal')
        ->get();

    return view('siswa.jurnal.index', compact(
        'jurnals',
        'bulan',
        'bulanTersedia'
    ));
}


    /**
     * Menampilkan form pengisian jurnal.
     */
    public function create()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(403, 'Data siswa tidak ditemukan.');
        }

        // Cek pengajuan PKL terbaru siswa
        $pengajuan = PengajuanPkl::where('siswa_id', $siswa->id)
            ->latest()
            ->first();

        // Jurnal hanya boleh diisi jika pengajuan terbaru Lolos
        if (!$pengajuan || $pengajuan->status !== 'Lolos') {
            abort(403, 'Kamu belum dinyatakan lolos Pengajuan PKL.');
        }

        return view('siswa.jurnal.create');
    }


    /**
     * Menyimpan jurnal baru.
     */
    public function store(Request $request)
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(403, 'Data siswa tidak ditemukan.');
        }

        // Cek pengajuan PKL terbaru siswa
        $pengajuan = PengajuanPkl::where('siswa_id', $siswa->id)
            ->latest()
            ->first();

        // Jurnal hanya boleh dibuat jika pengajuan terbaru Lolos
        if (!$pengajuan || $pengajuan->status !== 'Lolos') {
            abort(403, 'Kamu belum dinyatakan lolos Pengajuan PKL.');
        }

        $data = $request->validate([
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'kegiatan' => 'required|string',
            'kon' => 'nullable|string',
            'solusi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('jurnal', 'public');
        }

        $data['siswa_id'] = $siswa->id;
        $data['status_jurnal'] = 'Menunggu Review';

        JurnalPKL::create($data);

        return redirect()
            ->route('siswa.jurnal.index')
            ->with('success', 'Jurnal harian berhasil disimpan.');
    }


    /**
     * Menampilkan form edit jurnal.
     */
    public function edit(int $id)
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(403, 'Data siswa tidak ditemukan.');
        }

        $jurnal = JurnalPKL::where('id_jurnal', $id)
            ->where('siswa_id', $siswa->id)
            ->firstOrFail();

        if ($jurnal->status_jurnal !== 'Perlu Revisi') {
            abort(403, 'Jurnal ini tidak dapat diedit.');
        }

        return view('siswa.jurnal.edit', compact('jurnal'));
    }


    /**
     * Memperbarui jurnal yang perlu revisi.
     */
    public function update(Request $request, int $id)
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(403, 'Data siswa tidak ditemukan.');
        }

        $jurnal = JurnalPKL::where('id_jurnal', $id)
            ->where('siswa_id', $siswa->id)
            ->firstOrFail();

        if ($jurnal->status_jurnal !== 'Perlu Revisi') {
            abort(403, 'Jurnal ini tidak dapat diedit.');
        }

        $data = $request->validate([
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'kegiatan' => 'required|string',
            'kon' => 'nullable|string',
            'solusi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('jurnal', 'public');
        }

        // Setelah diperbaiki, kembali menunggu review
        $data['status_jurnal'] = 'Menunggu Review';

        $jurnal->update($data);

        return redirect()
            ->route('siswa.jurnal.index')
            ->with('success', 'Jurnal berhasil diperbaiki dan dikirim kembali untuk direview.');
    }

    /**
 * Menghapus jurnal milik siswa.
 */
public function destroy(int $id)
{
    $siswa = Auth::user()->siswa;

    if (!$siswa) {
        abort(403, 'Data siswa tidak ditemukan.');
    }

    $jurnal = JurnalPKL::where('id_jurnal', $id)
        ->where('siswa_id', $siswa->id)
        ->firstOrFail();

    $jurnal->delete();

    return redirect()
        ->route('siswa.jurnal.index')
        ->with('success', 'Jurnal berhasil dihapus.');
}
}