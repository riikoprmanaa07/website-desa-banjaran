<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = Surat::with('penduduk');

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nomor_surat', 'like', '%' . $request->search . '%')
                  ->orWhere('jenis_surat', 'like', '%' . $request->search . '%')
                  ->orWhereHas('penduduk', function($q2) use ($request) {
                      $q2->where('nama', 'like', '%' . $request->search . '%');
                  });
            });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Jenis Surat
        if ($request->filled('jenis')) {
            $query->where('jenis_surat', $request->jenis);
        }

        // Filter Tanggal
        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->whereBetween('tanggal_surat', [$request->tanggal_dari, $request->tanggal_sampai]);
        }

        $surat = $query->latest()->paginate(20);

        return view('admin.surat.index', compact('surat'));
    }

    public function create()
    {
        $penduduk = Penduduk::orderBy('nama')->get();
        return view('admin.surat.create', compact('penduduk'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'jenis_surat' => 'required|string',
        'penduduk_id' => 'required|exists:penduduk,id',
        'keperluan' => 'required|string',
        'tanggal_surat' => 'required|date',
        'penandatangan' => 'required|string',
        'keterangan' => 'nullable|string',
    ]);

    $validated['nomor_surat'] = $this->generateNoSurat();
    $validated['status'] = 'Pending';

    Surat::create($validated);

    return redirect()->route('admin.surat.index')
        ->with('success', 'Surat berhasil dibuat');
}


    public function show($id)
    {
        $surat = Surat::with('penduduk')->findOrFail($id);
        return view('admin.surat.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $penduduk = Penduduk::orderBy('nama')->get();
        return view('admin.surat.edit', compact('surat', 'penduduk'));
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $validated = $request->validate([
            
            'jenis_surat' => 'required|string',
            'penduduk_id' => 'required|exists:penduduk,id',
            'keperluan' => 'required|string',
            'tanggal_surat' => 'required|date',
            'penandatangan' => 'required|string',
            'status' => 'required|in:Pending,Diproses,Selesai,Ditolak',
            'keterangan' => 'nullable|string',
        ]);

        $surat->update($validated);

        return redirect()->route('admin.surat.index')
            ->with('success', 'Surat berhasil diupdate');
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        return redirect()->route('admin.surat.index')
            ->with('success', 'Surat berhasil dihapus');
    }

    public function updateStatus(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        

        $request->validate([
            'status' => 'required|in:Pending,Diproses,Selesai,Ditolak',
        ]);

        $surat->update(['status' => $request->status]);

        return back()->with('success', 'Status surat berhasil diupdate');
    }
    private function generateNoSurat()
{
    $bulanRomawi = [
        1 => 'I', 2 => 'II', 3 => 'III',
        4 => 'IV', 5 => 'V', 6 => 'VI',
        7 => 'VII', 8 => 'VIII', 9 => 'IX',
        10 => 'X', 11 => 'XI', 12 => 'XII'
    ];

    $bulan = date('n');
    $tahun = date('Y');

    $count = Surat::whereYear('created_at', $tahun)
                  ->whereMonth('created_at', $bulan)
                  ->count() + 1;

    $nomorUrut = str_pad($count, 3, '0', STR_PAD_LEFT);

    return $nomorUrut . '/DS/' . $bulanRomawi[$bulan] . '/' . $tahun;
}



    public function print($id)
    {
        $surat = Surat::with('penduduk')->findOrFail($id);
        return view('admin.surat.print', compact('surat'));
    }
}