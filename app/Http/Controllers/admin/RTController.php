<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RT;
use App\Models\RW;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class RTController extends Controller
{
    public function index(Request $request)
    {
        $query = RT::with('rw');

        // Filter berdasarkan RW
        if ($request->filled('rw_id')) {
            $query->where('rw_id', $request->rw_id);
        }

        $rt = $query->latest()->paginate(20);
        $rwList = RW::orderBy('nomor_rw')->get();

        return view('admin.rt.index', compact('rt', 'rwList'));
    }

    public function create()
    {
        $rwList = RW::orderBy('nomor_rw')->get();
        return view('admin.rt.create', compact('rwList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_rt' => 'required|string|max:3',
            'rw_id' => 'required|exists:rw,id',
            'nama_ketua' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $rw = RW::findOrFail($validated['rw_id']);

        // Hitung jumlah KK dan penduduk otomatis
        $validated['jumlah_kk'] = Penduduk::where('rt', $validated['nomor_rt'])
            ->where('rw', $rw->nomor_rw)
            ->distinct('no_kk')
            ->count('no_kk');

        $validated['jumlah_penduduk'] = Penduduk::where('rt', $validated['nomor_rt'])
            ->where('rw', $rw->nomor_rw)
            ->count();

        RT::create($validated);

        return redirect()->route('admin.rt.index')
            ->with('success', 'Data RT berhasil ditambahkan');
    }

    public function edit($id)
    {
        $rt = RT::findOrFail($id);
        $rwList = RW::orderBy('nomor_rw')->get();
        return view('admin.rt.edit', compact('rt', 'rwList'));
    }

    public function update(Request $request, $id)
    {
        $rt = RT::findOrFail($id);

        $validated = $request->validate([
            'nomor_rt' => 'required|string|max:3',
            'rw_id' => 'required|exists:rw,id',
            'nama_ketua' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $rw = RW::findOrFail($validated['rw_id']);

        // Update jumlah KK dan penduduk otomatis
        $validated['jumlah_kk'] = Penduduk::where('rt', $validated['nomor_rt'])
            ->where('rw', $rw->nomor_rw)
            ->distinct('no_kk')
            ->count('no_kk');

        $validated['jumlah_penduduk'] = Penduduk::where('rt', $validated['nomor_rt'])
            ->where('rw', $rw->nomor_rw)
            ->count();

        $rt->update($validated);

        return redirect()->route('admin.rt.index')
            ->with('success', 'Data RT berhasil diupdate');
    }

    public function destroy($id)
    {
        $rt = RT::findOrFail($id);
        $rt->delete();

        return redirect()->route('admin.rt.index')
            ->with('success', 'Data RT berhasil dihapus');
    }
}