<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StrukturDesa;
use App\Models\Bpd;

class ProfileController extends Controller
{
    public function profile()
    {
        // Ambil data struktur desa urut berdasarkan kolom urutan
        $struktur = StrukturDesa::orderBy('urutan', 'asc')->get();
         $bpd      = Bpd::orderBy('urutan')->get();

        return view('profile', compact('struktur', 'bpd'));
    }
}