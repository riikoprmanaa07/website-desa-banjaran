<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = [
            [
                'title' => 'Pembuatan KTP',
                'description' => 'Layanan pembuatan Kartu Tanda Penduduk (KTP) elektronik',
                'icon' => '🪪',
                'requirements' => [
                    'Fotocopy Kartu Keluarga',
                    'Pas foto 4x6 (2 lembar)',
                    'Surat pengantar RT/RW'
                ]
            ],
            [
                'title' => 'Surat Keterangan Usaha',
                'description' => 'Penerbitan surat keterangan untuk keperluan usaha',
                'icon' => '📄',
                'requirements' => [
                    'Fotocopy KTP',
                    'Fotocopy KK',
                    'Surat pengantar RT/RW'
                ]
            ],
            
            [
                'title' => 'Surat Keterangan Tidak Mampu',
                'description' => 'Untuk keperluan beasiswa atau bantuan sosial',
                'icon' => '💰',
                'requirements' => [
                    'Fotocopy KTP',
                    'Fotocopy KK',
                    'Surat pengantar RT/RW',
                    'Surat keterangan penghasilan'
                ]
            ],
        ];

        return view('services', compact('services'));
    }
}