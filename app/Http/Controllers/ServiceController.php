<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = [
            [
                'title' => 'Akta Kelahiran',
                'description' => 'Penerbitan dokumen resmi pencatatan kelahiran anak.',
                'icon' => '<svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
                'requirements' => [
                    'Formulir F2.01 dari Desa',
                    'Surat Lahir Asli dari RS/Bidan',
                    'KTP-el Ayah dan Ibu',
                    'KTP-el Saksi 1 dan 2',
                    'Kartu Keluarga (KK)',
                    'Buku Nikah (Halaman Biodata & Pengesahan)'
                ]
            ],
            [
                'title' => 'Akta Kematian',
                'description' => 'Penerbitan dokumen resmi pencatatan kematian warga.',
                'icon' => '<svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>',
                'requirements' => [
                    'Formulir F2.01 dari Desa',
                    'Surat Kematian dari RS/Desa',
                    'KTP & KK Orang yang Meninggal',
                    'KTP 2 Orang Saksi',
                    'KTP & KK Pelapor'
                ]
            ],
            [
                'title' => 'KIA',
                'description' => 'Penerbitan identitas resmi untuk anak usia 0 hingga di bawah 17 tahun.',
                'icon' => '<svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>',
                'requirements' => [
                    'Kartu Keluarga (KK) Orang Tua',
                    'Akta Kelahiran Anak',
                    'Pasfoto berwarna pakaian formal (Khusus anak usia 5 tahun ke atas)'
                ]
            ],
            [
                'title' => 'Pindah Domisili',
                'description' => 'Penerbitan Surat Keterangan Pindah (SKPWNI) keluar desa.',
                'icon' => '<svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>',
                'requirements' => [
                    'Formulir F1.03 dari Desa',
                    'KK Orang yang Pindah',
                    'KTP Orang yang Pindah',
                    'Buku Nikah (Jika sudah menikah)'
                ]
            ],
            [
                'title' => 'Kedatangan',
                'description' => 'Pencatatan data penduduk yang baru pindah masuk ke desa.',
                'icon' => '<svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>',
                'requirements' => [
                    'Surat Pindah (SKPWNI) dari Dukcapil Asal',
                    'Buku Nikah (Jika sudah menikah)'
                ]
            ],
            [
                'title' => 'KTP-el',
                'description' => 'Perekaman baru, pencetakan ulang, atau perubahan data KTP.',
                'icon' => '<svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>',
                'requirements' => [
                    'Fotokopi Kartu Keluarga (KK)',
                    'KTP-el Lama (Jika rusak / ubah data)',
                    'Surat Kehilangan dari Kepolisian (Jika hilang)',
                    'Formulir F1.06 & Data Pendukung (Khusus perubahan data)'
                ]
            ],
            [
                'title' => 'Pembetulan Akta',
                'description' => 'Perubahan atau koreksi data pada dokumen yang mengalami kesalahan.',
                'icon' => '<svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>',
                'requirements' => [
                    'Surat Permohonan & Formulir F2.01',
                    'KTP Ayah, Ibu, dan Pemilik Akta',
                    'Buku Nikah Ortu / Kutipan Akta Perkawinan',
                    'Akta Lama yang akan diubah (ASLI)',
                    'Dokumen pendukung data yang benar (Ijazah / Akta Ortu)'
                ]
            ],
        ];

        return view('services', compact('services'));
    }
}