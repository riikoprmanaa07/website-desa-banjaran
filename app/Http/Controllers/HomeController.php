<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\StrukturDesa;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            ['icon' => '👥', 'label' => 'Jumlah Penduduk', 'value' => '8,542'],
            ['icon' => '🏠', 'label' => 'Jumlah KK', 'value' => '2,156'],
            ['icon' => '📍', 'label' => 'Luas Wilayah', 'value' => '12.5 km²'],
            ['icon' => '🏘️', 'label' => 'Jumlah RT/RW', 'value' => '45/12'],
        ];

        // Ambil Kepala Desa yang Aktif
        $kepalaDesa = StrukturDesa::where('jabatan', 'Kepala Desa')
            ->where('status', 'Aktif')
            ->first();

        // Ambil 3 berita terbaru yang sudah publish
        $latestNews = Berita::published()
            ->latest('published_at')
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'id'      => $item->id,
                    'title'   => $item->judul,
                    'excerpt' => $item->excerpt,
                    'image'   => $item->gambar_url,
                    'date'    => $item->tanggal_publish,
                ];
            });

        return view('home', compact('stats', 'latestNews', 'kepalaDesa'));
    }
}