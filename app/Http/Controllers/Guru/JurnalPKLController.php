<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JurnalPKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalPKLController extends Controller
{
    /**
     * Menampilkan semua jurnal siswa yang dibimbing guru.
     */
    public function index(Request $request)
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan.');
        }

        $search = trim($request->input('search', ''));
        $status = trim($request->input('status', ''));

        $jurnals = JurnalPKL::with('siswa')
            ->whereHas('siswa', function ($query) use ($guru) {
                $query->where('guru_pembimbing_id', $guru->id);
            })

            /*
             * FILTER STATUS
             */
            ->when($status !== '', function ($query) use ($status) {

                if ($status === 'Menunggu Review') {

                    $query->where(function ($q) {
                        $q->whereNull('status_jurnal')
                            ->orWhere('status_jurnal', '')
                            ->orWhereRaw(
                                "LOWER(TRIM(status_jurnal)) IN (?, ?)",
                                ['menunggu review', 'menunggu']
                            );
                    });

                } else {

                    $query->whereRaw(
                        'LOWER(TRIM(status_jurnal)) = ?',
                        [strtolower($status)]
                    );
                }
            })

            /*
             * FILTER PENCARIAN
             */
            ->when($search !== '', function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    /*
                     * Cari nama siswa
                     */
                    $q->whereHas('siswa', function ($siswaQuery) use ($search) {
                        $siswaQuery->where(function ($query) use ($search) {
    $query->where('nama', 'like', '%' . $search . '%')
          ->orWhere('nis', 'like', '%' . $search . '%');
});
                    });

                    /*
                     * Cari tanggal lengkap
                     * Contoh: 12-08-2026
                     */
                    $q->orWhereRaw(
                        "DATE_FORMAT(tanggal, '%d-%m-%Y') LIKE ?",
                        ['%' . $search . '%']
                    );

                    /*
                     * Cari tahun
                     * Contoh: 2026
                     */
                    if (preg_match('/^\d{4}$/', $search)) {
                        $q->orWhereYear('tanggal', $search);
                    }

                    /*
                     * Cari bulan angka
                     * Contoh: 8 atau 08
                     */
                    if (
                        is_numeric($search) &&
                        (int) $search >= 1 &&
                        (int) $search <= 12
                    ) {
                        $q->orWhereMonth('tanggal', (int) $search);
                    }

                    /*
                     * Cari nama bulan Indonesia
                     */
                    $bulan = [
                        'januari' => 1,
                        'februari' => 2,
                        'maret' => 3,
                        'april' => 4,
                        'mei' => 5,
                        'juni' => 6,
                        'juli' => 7,
                        'agustus' => 8,
                        'september' => 9,
                        'oktober' => 10,
                        'november' => 11,
                        'desember' => 12,
                    ];

                    $bulanKey = strtolower($search);

                    if (isset($bulan[$bulanKey])) {
                        $q->orWhereMonth(
                            'tanggal',
                            $bulan[$bulanKey]
                        );
                    }
                });
            })

            ->latest('tanggal')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'guru.jurnal.index',
            compact('jurnals', 'search', 'status')
        );
    }

    /**
     * Menampilkan detail jurnal.
     */
    public function show($id)
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan.');
        }

        $jurnal = JurnalPKL::with('siswa')
            ->where('id_jurnal', $id)
            ->whereHas('siswa', function ($query) use ($guru) {
                $query->where('guru_pembimbing_id', $guru->id);
            })
            ->firstOrFail();

        return view('guru.jurnal.show', compact('jurnal'));
    }

    /**
     * Guru memberikan hasil review jurnal.
     */
    public function update(Request $request, $id)
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan.');
        }

        $jurnal = JurnalPKL::where('id_jurnal', $id)
            ->whereHas('siswa', function ($query) use ($guru) {
                $query->where('guru_pembimbing_id', $guru->id);
            })
            ->firstOrFail();

        $request->validate([
            'status_jurnal' => 'required|in:Disetujui,Perlu Revisi',
        ]);

        $jurnal->update([
            'status_jurnal' => $request->status_jurnal,
        ]);

        return redirect()
            ->route('guru.jurnal.show', $jurnal->id_jurnal)
            ->with('success', 'Status jurnal berhasil diperbarui.');
    }
}