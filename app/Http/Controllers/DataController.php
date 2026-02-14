<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        // Data Demografi
        $demografi = [
            'total_penduduk' => 8542,
            'laki_laki' => 4321,
            'perempuan' => 4221,
            'kepala_keluarga' => 2156,
            'kepadatan' => '683 jiwa/km²',
        ];

        // Data Penduduk Berdasarkan Usia
        $usia = [
            ['range' => '0-4 tahun', 'laki' => 342, 'perempuan' => 318, 'total' => 660],
            ['range' => '5-9 tahun', 'laki' => 389, 'perempuan' => 367, 'total' => 756],
            ['range' => '10-14 tahun', 'laki' => 412, 'perempuan' => 398, 'total' => 810],
            ['range' => '15-19 tahun', 'laki' => 445, 'perempuan' => 434, 'total' => 879],
            ['range' => '20-24 tahun', 'laki' => 468, 'perempuan' => 456, 'total' => 924],
            ['range' => '25-29 tahun', 'laki' => 421, 'perempuan' => 412, 'total' => 833],
            ['range' => '30-34 tahun', 'laki' => 398, 'perempuan' => 387, 'total' => 785],
            ['range' => '35-39 tahun', 'laki' => 367, 'perempuan' => 358, 'total' => 725],
            ['range' => '40-44 tahun', 'laki' => 334, 'perempuan' => 325, 'total' => 659],
            ['range' => '45-49 tahun', 'laki' => 298, 'perempuan' => 289, 'total' => 587],
            ['range' => '50-54 tahun', 'laki' => 256, 'perempuan' => 248, 'total' => 504],
            ['range' => '55-59 tahun', 'laki' => 213, 'perempuan' => 207, 'total' => 420],
            ['range' => '60-64 tahun', 'laki' => 178, 'perempuan' => 172, 'total' => 350],
            ['range' => '65+ tahun', 'laki' => 200, 'perempuan' => 250, 'total' => 450],
        ];

        // Data Pendidikan
        $pendidikan = [
            ['tingkat' => 'Tidak/Belum Sekolah', 'jumlah' => 1234, 'persentase' => 14.4],
            ['tingkat' => 'Belum Tamat SD/Sederajat', 'jumlah' => 856, 'persentase' => 10.0],
            ['tingkat' => 'Tamat SD/Sederajat', 'jumlah' => 1987, 'persentase' => 23.3],
            ['tingkat' => 'SLTP/Sederajat', 'jumlah' => 1645, 'persentase' => 19.3],
            ['tingkat' => 'SLTA/Sederajat', 'jumlah' => 2134, 'persentase' => 25.0],
            ['tingkat' => 'SarjanaZ', 'jumlah' => 234, 'persentase' => 2.7],

        ];

        // Data Pekerjaan
        $pekerjaan = [
            ['jenis' => 'Petani/Pekebun', 'jumlah' => 2345, 'persentase' => 27.5],
            ['jenis' => 'Buruh Harian Lepas', 'jumlah' => 1234, 'persentase' => 14.4],
            ['jenis' => 'Buruh Tani/Perkebunan', 'jumlah' => 987, 'persentase' => 11.6],
            ['jenis' => 'Wiraswasta', 'jumlah' => 856, 'persentase' => 10.0],
            ['jenis' => 'Karyawan Swasta', 'jumlah' => 645, 'persentase' => 7.6],
            ['jenis' => 'Mengurus Rumah Tangga', 'jumlah' => 567, 'persentase' => 6.6],
            ['jenis' => 'Pelajar/Mahasiswa', 'jumlah' => 789, 'persentase' => 9.2],
            ['jenis' => 'Pedagang', 'jumlah' => 423, 'persentase' => 5.0],
            ['jenis' => 'PNS', 'jumlah' => 234, 'persentase' => 2.7],
            ['jenis' => 'Pensiunan', 'jumlah' => 156, 'persentase' => 1.8],
            ['jenis' => 'Lainnya', 'jumlah' => 306, 'persentase' => 3.6],
        ];

        // Data Agama
        $agama = [
            ['nama' => 'Islam', 'jumlah' => 8234, 'persentase' => 96.4],
            ['nama' => 'Kristen', 'jumlah' => 178, 'persentase' => 2.1],
            ['nama' => 'Katolik', 'jumlah' => 89, 'persentase' => 1.0],
            ['nama' => 'Hindu', 'jumlah' => 23, 'persentase' => 0.3],
            ['nama' => 'Buddha', 'jumlah' => 12, 'persentase' => 0.1],
            ['nama' => 'Lainnya', 'jumlah' => 6, 'persentase' => 0.1],
        ];

        // Data Perkawinan
        $perkawinan = [
            ['status' => 'Belum Kawin', 'jumlah' => 3456, 'persentase' => 40.5],
            ['status' => 'Kawin', 'jumlah' => 4567, 'persentase' => 53.5],
            ['status' => 'Cerai Hidup', 'jumlah' => 234, 'persentase' => 2.7],
            ['status' => 'Cerai Mati', 'jumlah' => 285, 'persentase' => 3.3],
        ];

        // Fasilitas Umum
        $fasilitas = [
            'pendidikan' => [
                ['nama' => 'TK/PAUD', 'jumlah' => 5],
                ['nama' => 'SD/Sederajat', 'jumlah' => 3],
                ['nama' => 'SMP/Sederajat', 'jumlah' => 2],
                ['nama' => 'SMA/Sederajat', 'jumlah' => 1],
            ],
            'kesehatan' => [
                ['nama' => 'Puskesmas', 'jumlah' => 1],
                ['nama' => 'Posyandu', 'jumlah' => 8],
                ['nama' => 'Polindes', 'jumlah' => 1],
                ['nama' => 'Apotek', 'jumlah' => 2],
            ],
            'peribadatan' => [
                ['nama' => 'Masjid', 'jumlah' => 12],
                ['nama' => 'Musholla', 'jumlah' => 25],
                ['nama' => 'Gereja', 'jumlah' => 2],
            ],
            'ekonomi' => [
                ['nama' => 'Pasar Desa', 'jumlah' => 1],
                ['nama' => 'Toko/Warung', 'jumlah' => 45],
                ['nama' => 'Bank/ATM', 'jumlah' => 2],
                ['nama' => 'Koperasi', 'jumlah' => 3],
            ],
        ];

        // Potensi Desa
        $potensi = [
            'pertanian' => [
                ['komoditas' => 'Padi', 'luas' => '450 Ha', 'produksi' => '2,700 ton/tahun'],
                ['komoditas' => 'Jagung', 'luas' => '120 Ha', 'produksi' => '600 ton/tahun'],
                ['komoditas' => 'Sayuran', 'luas' => '80 Ha', 'produksi' => '800 ton/tahun'],
            ],
            'perkebunan' => [
                ['komoditas' => 'Kelapa', 'luas' => '200 Ha', 'produksi' => '400 ton/tahun'],
                ['komoditas' => 'Kopi', 'luas' => '150 Ha', 'produksi' => '150 ton/tahun'],
                ['komoditas' => 'Cengkeh', 'luas' => '100 Ha', 'produksi' => '50 ton/tahun'],
            ],
            'peternakan' => [
                ['jenis' => 'Sapi', 'populasi' => '234 ekor'],
                ['jenis' => 'Kambing', 'populasi' => '567 ekor'],
                ['jenis' => 'Ayam', 'populasi' => '3,450 ekor'],
            ],
        ];

        return view('data', compact(
            'demografi',
            'usia',
            'pendidikan',
            'pekerjaan',
            'agama',
            'perkawinan',
            'fasilitas',
            'potensi'
        ));
    }
}