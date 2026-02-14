<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RW;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class RWController extends Controller
{
    public function index()
    {
        $rw = RW::withCount('rt')->latest()->paginate(20);
        return view('admin.rw.index', compact('rw'));
    }

    public function create()
    {
        return view('admin.rw.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_rw' => 'required|string|max:3|unique:rw,nomor_rw',
            'nama_ketua' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        // Hitung jumlah KK dan penduduk otomatis
        $validated['jumlah_kk'] = Penduduk::where('rw', $validated['nomor_rw'])
            ->distinct('no_kk')
            ->count('no_kk');

        $validated['jumlah_penduduk'] = Penduduk::where('rw', $validated['nomor_rw'])->count();

        RW::create($validated);

        return redirect()->route('admin.rw.index')
            ->with('success', 'Data RW berhasil ditambahkan');
    }

    public function edit($id)
    {
        $rw = RW::findOrFail($id);
        return view('admin.rw.edit', compact('rw'));
    }

    public function update(Request $request, $id)
    {
        $rw = RW::findOrFail($id);

        $validated = $request->validate([
            'nomor_rw' => 'required|string|max:3|unique:rw,nomor_rw,' . $id,
            'nama_ketua' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        // Update jumlah KK dan penduduk otomatis
        $validated['jumlah_kk'] = Penduduk::where('rw', $validated['nomor_rw'])
            ->distinct('no_kk')
            ->count('no_kk');

        $validated['jumlah_penduduk'] = Penduduk::where('rw', $validated['nomor_rw'])->count();

        $rw->update($validated);

        return redirect()->route('admin.rw.index')
            ->with('success', 'Data RW berhasil diupdate');
    }

    public function destroy($id)
    {
        $rw = RW::findOrFail($id);
        
        // Check jika ada RT yang terkait
        if ($rw->rt()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus RW yang masih memiliki RT');
        }

        $rw->delete();

        return redirect()->route('admin.rw.index')
            ->with('success', 'Data RW berhasil dihapus');
    }
}