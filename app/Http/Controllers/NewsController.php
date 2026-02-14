<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    private function getAllNews()
    {
        return [
            [
                'id' => 1,
                'title' => 'Gotong Royong Bersih Desa Banjaran',
                'excerpt' => 'Kegiatan gotong royong melibatkan seluruh warga dalam membersihkan lingkungan desa...',
                'content' => 'Pada hari Minggu, 5 Februari 2026, seluruh warga Desa Banjaran berkumpul untuk melaksanakan kegiatan gotong royong bersih desa. Kegiatan ini merupakan agenda rutin yang dilaksanakan setiap bulan untuk menjaga kebersihan dan keindahan lingkungan desa. Antusiasme warga sangat tinggi, terlihat dari partisipasi aktif dari berbagai kalangan mulai dari anak-anak hingga orang tua. Kepala Desa Banjaran, Bapak Suryadi, S.Sos mengapresiasi tingginya kesadaran warga akan pentingnya menjaga kebersihan lingkungan.',
                'image' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=800',
                'date' => '5 Februari 2026',
                'category' => 'Kegiatan'
            ],
            [
                'id' => 2,
                'title' => 'Pelatihan UMKM untuk Warga Desa',
                'excerpt' => 'Pemerintah desa mengadakan pelatihan pengembangan UMKM bagi pelaku usaha lokal...',
                'content' => 'Pemerintah Desa Banjaran bekerja sama dengan Dinas Koperasi dan UMKM Kabupaten mengadakan pelatihan pengembangan usaha mikro kecil menengah (UMKM) bagi para pelaku usaha di desa. Pelatihan ini bertujuan untuk meningkatkan kapasitas dan keterampilan para pelaku UMKM dalam mengelola usaha mereka, termasuk pemasaran digital dan pembukuan sederhana. Kegiatan ini diikuti oleh 50 peserta dari berbagai jenis usaha.',
                'image' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800',
                'date' => '2 Februari 2026',
                'category' => 'Pemberdayaan'
            ],
            [
                'id' => 3,
                'title' => 'Posyandu Balita Bulan Ini',
                'excerpt' => 'Kegiatan posyandu balita dilaksanakan setiap tanggal 10 di Balai Desa...',
                'content' => 'Kegiatan posyandu balita rutin dilaksanakan setiap tanggal 10 di Balai Desa Banjaran. Kegiatan ini melayani pemeriksaan kesehatan balita, imunisasi, dan pemberian vitamin. Para ibu diimbau untuk membawa balitanya agar mendapatkan pelayanan kesehatan yang optimal. Petugas kesehatan dari Puskesmas setempat siap memberikan konsultasi kesehatan gratis.',
                'image' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800',
                'date' => '1 Februari 2026',
                'category' => 'Kesehatan'
            ],
            [
                'id' => 4,
                'title' => 'Pembangunan Jalan Desa Tahap II',
                'excerpt' => 'Pemerintah desa melanjutkan pembangunan jalan desa untuk meningkatkan aksesibilitas...',
                'content' => 'Pembangunan jalan desa tahap II dimulai pada minggu ini. Proyek ini merupakan kelanjutan dari tahap sebelumnya yang bertujuan untuk meningkatkan aksesibilitas warga ke berbagai wilayah desa. Dana yang digunakan berasal dari Dana Desa (DD) dan Alokasi Dana Desa (ADD). Diharapkan dengan adanya perbaikan jalan ini, mobilitas warga dan distribusi hasil pertanian dapat lebih lancar.',
                'image' => 'https://images.unsplash.com/photo-1581094271901-8022df4466f9?w=800',
                'date' => '28 Januari 2026',
                'category' => 'Infrastruktur'
            ],
        ];
    }

    public function index()
    {
        $news = $this->getAllNews();
        return view('news.index', compact('news'));
    }

    public function show($id)
    {
        $allNews = $this->getAllNews();
        $news = collect($allNews)->firstWhere('id', (int)$id);
        
        if (!$news) {
            abort(404);
        }

        $relatedNews = collect($allNews)->where('id', '!=', (int)$id)->take(3);

        return view('news.show', compact('news', 'relatedNews'));
    }
}