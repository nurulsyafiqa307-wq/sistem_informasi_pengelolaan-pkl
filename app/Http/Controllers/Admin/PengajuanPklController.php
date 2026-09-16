<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanPkl;
use App\Models\Siswa;
use App\Models\TempatPkl;
use App\Models\Guru;
use Illuminate\Http\Request;

class PengajuanPklController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $pengajuans = PengajuanPkl::with([
            'siswa.guruPembimbing',
            'tempatPkl'
        ])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {

                    // Cari berdasarkan siswa
                    $q->whereHas('siswa', function ($siswaQuery) use ($search) {
                        $siswaQuery->where('nama', 'like', '%' . $search . '%')
                            ->orWhere('nis', 'like', '%' . $search . '%');
                    });

                    // Cari berdasarkan tempat PKL
                    $q->orWhereHas('tempatPkl', function ($tempatQuery) use ($search) {
                        $tempatQuery->where('nama_perusahaan', 'like', '%' . $search . '%')
                            ->orWhere('bidang', 'like', '%' . $search . '%');
                    });

                    // Cari berdasarkan status
                    $q->orWhere('status', 'like', '%' . $search . '%');

                    // Cari berdasarkan tanggal dd/mm/YYYY
                    $q->orWhereRaw(
                        "DATE_FORMAT(tanggal_pengajuan, '%d/%m/%Y') LIKE ?",
                        ['%' . $search . '%']
                    );

                    // Cari berdasarkan tahun
                    if (preg_match('/^\d{4}$/', $search)) {
                        $q->orWhereYear('tanggal_pengajuan', $search);
                    }

                    // Cari berdasarkan bulan angka
                    if (is_numeric($search) && (int) $search >= 1 && (int) $search <= 12) {
                        $q->orWhereMonth('tanggal_pengajuan', (int) $search);
                    }

                    // Cari berdasarkan nama bulan Indonesia
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
                            'tanggal_pengajuan',
                            $bulan[$bulanKey]
                        );
                    }
                });
            })
            ->latest('tanggal_pengajuan')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.pengajuan.index',
            compact('pengajuans', 'search')
        );
    }

    public function create()
    {
        $siswas = Siswa::orderBy('nama')->get();

        $tempatPkls = TempatPkl::orderBy('nama_perusahaan')->get();

        return view(
            'admin.pengajuan.create',
            compact('siswas', 'tempatPkls')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tempat_pkl_id' => 'required|exists:tempat_pkls,id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:Menunggu Seleksi,Lolos,Tidak Lolos',
        ]);

        PengajuanPkl::create($validated);

        return redirect()
            ->route('admin.pengajuan.index')
            ->with('success', 'Pengajuan PKL berhasil ditambahkan.');
    }

    public function show(PengajuanPkl $pengajuan)
    {
        $pengajuan->load([
            'siswa.guruPembimbing',
            'tempatPkl'
        ]);

        return view(
            'admin.pengajuan.show',
            compact('pengajuan')
        );
    }

    public function edit(PengajuanPkl $pengajuan)
    {
        $siswas = Siswa::orderBy('nama')->get();

        $tempatPkls = TempatPkl::orderBy('nama_perusahaan')->get();

        $gurus = Guru::orderBy('nama')->get();

        return view(
            'admin.pengajuan.edit',
            compact(
                'pengajuan',
                'siswas',
                'tempatPkls',
                'gurus'
            )
        );
    }
public function update(
    Request $request,
    PengajuanPkl $pengajuan
) {
    $validated = $request->validate([
        'status' => 'required|in:Menunggu Seleksi,Lolos,Tidak Lolos',
        'guru_pembimbing_id' => 'nullable|exists:gurus,id',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Jika status Lolos, guru pembimbing wajib dipilih
    |--------------------------------------------------------------------------
    */
    if (
        $validated['status'] === 'Lolos' &&
        empty($validated['guru_pembimbing_id'])
    ) {
        return back()
            ->withErrors([
                'guru_pembimbing_id' =>
                    'Guru pembimbing wajib dipilih jika pengajuan Lolos.'
            ])
            ->withInput();
    }

    /*
    |--------------------------------------------------------------------------
    | Update status pengajuan
    |--------------------------------------------------------------------------
    */
    $pengajuan->update([
        'status' => $validated['status'],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Update guru pembimbing siswa
    |--------------------------------------------------------------------------
    */
    $siswa = Siswa::findOrFail($pengajuan->siswa_id);

    if ($validated['status'] === 'Lolos') {
        $siswa->update([
            'guru_pembimbing_id' => $validated['guru_pembimbing_id'],
            'status_pkl' => 'Lolos',
            'tempat_pkl' => $pengajuan->tempatPkl->nama_perusahaan,
        ]);
    } else {
        $siswa->update([
            'guru_pembimbing_id' => null,
        ]);
    }

    return redirect()
        ->route('admin.pengajuan.index')
        ->with('success', 'Pengajuan PKL berhasil diperbarui.');
}
    

    public function destroy(PengajuanPkl $pengajuan)
    {
        $pengajuan->delete();

        return redirect()
            ->route('admin.pengajuan.index')
            ->with('success', 'Pengajuan PKL berhasil dihapus.');
    }
}