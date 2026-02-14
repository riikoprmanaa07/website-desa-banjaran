<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $latestNews = [
            [
                'id' => 1,
                'title' => 'Gotong Royong Bersih Desa Banjaran',
                'excerpt' => 'Kegiatan gotong royong melibatkan seluruh warga dalam membersihkan lingkungan desa...',
                'image' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=800',
                'date' => '5 Februari 2026'
            ],
            [
                'id' => 2,
                'title' => 'Pelatihan UMKM untuk Warga Desa',
                'excerpt' => 'Pemerintah desa mengadakan pelatihan pengembangan UMKM bagi pelaku usaha lokal...',
                'image' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800',
                'date' => '2 Februari 2026'
            ],
            [
                'id' => 3,
                'title' => 'Posyandu Balita Bulan Ini',
                'excerpt' => 'Kegiatan posyandu balita dilaksanakan setiap tanggal 10 di Balai Desa...',
                'image' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800',
                'date' => '1 Februari 2026'
            ],
        ];

        return view('home', compact('stats', 'latestNews'));
    }
}