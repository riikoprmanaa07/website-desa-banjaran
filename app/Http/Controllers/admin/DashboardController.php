<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\Surat;
use App\Models\Berita;
use App\Models\Galeri;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenduduk = Penduduk::count();
        $suratPending = Surat::where('status', 'Pending')->count();
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();

        // Statistik Surat
        $totalSurat = Surat::count();
        $suratStats = [
            'pending' => $totalSurat > 0 ? round((Surat::where('status', 'Pending')->count() / $totalSurat) * 100) : 0,
            'diproses' => $totalSurat > 0 ? round((Surat::where('status', 'Diproses')->count() / $totalSurat) * 100) : 0,
            'selesai' => $totalSurat > 0 ? round((Surat::where('status', 'Selesai')->count() / $totalSurat) * 100) : 0,
        ];

        // Gender Stats
        $totalPendudukGender = Penduduk::count();
        $genderStats = [
            'L' => $totalPendudukGender > 0 ? round((Penduduk::where('jenis_kelamin', 'L')->count() / $totalPendudukGender) * 100) : 0,
            'P' => $totalPendudukGender > 0 ? round((Penduduk::where('jenis_kelamin', 'P')->count() / $totalPendudukGender) * 100) : 0,
        ];

        $latestSurat = Surat::with('penduduk')->latest()->take(5)->get();
        $latestBerita = Berita::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPenduduk',
            'suratPending',
            'totalBerita',
            'totalGaleri',
            'suratStats',
            'genderStats',
            'latestSurat',
            'latestBerita'
        ));
    }
}