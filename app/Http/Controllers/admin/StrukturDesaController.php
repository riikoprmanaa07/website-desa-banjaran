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
        $struktur = StrukturDesa::orderBy('urutan')->get(); // ⭐ Ubah dari paginate ke get untuk drag & drop
        return view('admin.struktur.index', compact('struktur'));
    }

    public function create()
    {
        return view('admin.struktur.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048', // ⭐ Ubah jadi required
            'pendidikan' => 'nullable|string',  // ⭐ Tambahkan ini
            'no_hp' => 'nullable|string|max:20', // ⭐ Tambahkan ini
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        // ⭐ Auto set urutan (max + 1)
        $validated['urutan'] = (StrukturDesa::max('urutan') ?? 0) + 1;
        
        // ⭐ Auto set status Aktif
        $validated['status'] = 'Aktif';

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
            'pendidikan' => 'nullable|string',  // ⭐ Tambahkan ini
            'no_hp' => 'nullable|string|max:20', // ⭐ Tambahkan ini
            'urutan' => 'nullable|integer|min:0', // ⭐ Ubah jadi nullable
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
            'order' => 'required|array',  // ⭐ Ubah dari 'orders' ke 'order'
            'order.*.id' => 'required|exists:struktur_desa,id',
            'order.*.urutan' => 'required|integer|min:1',
        ]);

        foreach ($request->order as $item) {
            StrukturDesa::where('id', $item['id'])
                ->update(['urutan' => $item['urutan']]);
        }

        return response()->json(['success' => true]);
    }
}