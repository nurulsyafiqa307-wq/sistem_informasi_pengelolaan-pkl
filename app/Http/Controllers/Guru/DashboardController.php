<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\JurnalPKL;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = auth()->user()->guru;

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan.');
        }

        // Ambil siswa yang dibimbing guru ini
        $siswas = Siswa::where('guru_pembimbing_id', $guru->id)
            ->orderBy('nama')
            ->get();

        // Ambil jurnal dari siswa yang dibimbing
        $jurnals = JurnalPKL::with('siswa')
            ->whereIn('siswa_id', $siswas->pluck('id'))
            ->latest('tanggal')
            ->latest()
            ->get();

        // Statistik dashboard
        $jumlahSiswa = $siswas->count();

        // Jumlah jurnal yang masih perlu diperiksa
        $jurnalMasuk = $jurnals
            ->where('status_jurnal', 'Menunggu Review')
            ->count();

        // Jumlah siswa yang sudah memiliki penilaian
        $jumlahDinilai = $siswas
            ->filter(function ($siswa) {
                return $siswa->penilaian !== null;
            })
            ->count();

        return view('guru.dashboard', compact(
            'guru',
            'siswas',
            'jurnals',
            'jumlahSiswa',
            'jurnalMasuk',
            'jumlahDinilai'
        ));
    }
}