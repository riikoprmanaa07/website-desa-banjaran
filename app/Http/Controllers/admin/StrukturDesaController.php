<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturDesaController extends Controller
{
    public function index()
    {
        $struktur = StrukturDesa::orderBy('urutan')->paginate(20);
        return view('admin.struktur.index', compact('struktur'));
    }

    public function create()
    {
        $maxUrutan = StrukturDesa::max('urutan') ?? 0;
        return view('admin.struktur.create', compact('maxUrutan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'urutan' => 'required|integer|min:0',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        StrukturDesa::create($validated);

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Data struktur desa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $struktur = StrukturDesa::findOrFail($id);
        return view('admin.struktur.edit', compact('struktur'));
    }

    public function update(Request $request, $id)
    {
        $struktur = StrukturDesa::findOrFail($id);

        $validated = $request->validate([
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'urutan' => 'required|integer|min:0',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        // Upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($struktur->foto) {
                Storage::disk('public')->delete($struktur->foto);
            }
            $validated['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        $struktur->update($validated);

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Data struktur desa berhasil diupdate');
    }

    public function destroy($id)
    {
        $struktur = StrukturDesa::findOrFail($id);

        // Hapus foto
        if ($struktur->foto) {
            Storage::disk('public')->delete($struktur->foto);
        }

        $struktur->delete();

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Data struktur desa berhasil dihapus');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:struktur_desa,id',
            'orders.*.urutan' => 'required|integer|min:0',
        ]);

        foreach ($request->orders as $order) {
            StrukturDesa::where('id', $order['id'])
                ->update(['urutan' => $order['urutan']]);
        }

        return response()->json(['message' => 'Urutan berhasil diupdate']);
    }
}