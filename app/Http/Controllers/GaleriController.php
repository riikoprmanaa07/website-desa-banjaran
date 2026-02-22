<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori unik dari database untuk filter
        $kategoriList = Galeri::select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        $query = Galeri::orderBy('tanggal_foto', 'desc');

        // Filter berdasarkan kategori yang dipilih
        if ($request->filled('kategori') && $request->kategori !== 'semua') {
            $query->where('kategori', $request->kategori);
        }

        $galeris = $query->paginate(12)->withQueryString();

        return view('galeri', compact('galeris', 'kategoriList'));
    }
}