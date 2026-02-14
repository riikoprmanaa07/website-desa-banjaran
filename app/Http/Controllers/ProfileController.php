<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $visionMission = [
            'vision' => 'Mewujudkan Desa Banjaran yang maju, sejahtera, mandiri, dan religius',
            'missions' => [
                'Meningkatkan kualitas pelayanan publik kepada masyarakat',
                'Mengembangkan ekonomi kreatif dan UMKM desa',
                'Meningkatkan kualitas pendidikan dan kesehatan masyarakat',
                'Membangun infrastruktur desa yang merata',
                'Melestarikan nilai-nilai budaya dan kearifan lokal',
            ]
        ];

        $structure = [
            ['position' => 'Kepala Desa', 'name' => 'Bapak Suryadi, S.Sos'],
            ['position' => 'Sekretaris Desa', 'name' => 'Ibu Retno Wulandari, S.AP'],
            ['position' => 'Kaur Keuangan', 'name' => 'Bapak Ahmad Fauzi, SE'],
            ['position' => 'Kaur Perencanaan', 'name' => 'Ibu Siti Nurjanah, ST'],
            ['position' => 'Kasi Pemerintahan', 'name' => 'Bapak Bambang Wijaya'],
            ['position' => 'Kasi Kesejahteraan', 'name' => 'Ibu Dewi Sartika, S.Sos'],
            ['position' => 'Kasi Kesejahteraan', 'name' => 'Ibu Dewi Sartika, S.Sos'],
            ['position' => 'Kasi Kesejahteraan', 'name' => 'Ibu Dewi Sartika, S.Sos'],
        ];

        return view('profile', compact('visionMission', 'structure'));
    }
}