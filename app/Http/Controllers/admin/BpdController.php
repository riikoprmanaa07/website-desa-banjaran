<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BPDController extends Controller
{
    public function index()
    {
        $bpd = Bpd::orderBy('urutan')->get();
        return view('admin.bpd.index', compact('bpd'));
    }

    public function create()
    {
        return view('admin.bpd.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'pendidikan' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('bpd', 'public');
        }

        $validated['urutan'] = (Bpd::max('urutan') ?? 0) + 1;
        $validated['status'] = 'Aktif';

        Bpd::create($validated);

        return redirect()->route('admin.bpd.index')
            ->with('success', 'Anggota BPD berhasil ditambahkan');
    }

    public function edit($id)
    {
        $bpd = Bpd::findOrFail($id);
        return view('admin.bpd.edit', compact('bpd'));
    }

    public function update(Request $request, $id)
    {
        $bpd = Bpd::findOrFail($id);

        $validated = $request->validate([
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'pendidikan' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            if ($bpd->foto) {
                Storage::disk('public')->delete($bpd->foto);
            }
            $validated['foto'] = $request->file('foto')->store('bpd', 'public');
        }

        $bpd->update($validated);

        return redirect()->route('admin.bpd.index')
            ->with('success', 'Data BPD berhasil diupdate');
    }

    public function destroy($id)
    {
        $bpd = Bpd::findOrFail($id);

        if ($bpd->foto) {
            Storage::disk('public')->delete($bpd->foto);
        }

        $bpd->delete();

        return redirect()->route('admin.bpd.index')
            ->with('success', 'Data BPD berhasil dihapus');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*.id' => 'required|exists:bpd,id',
            'order.*.urutan' => 'required|integer|min:1',
        ]);

        foreach ($request->order as $item) {
            Bpd::where('id', $item['id'])
                ->update(['urutan' => $item['urutan']]);
        }

        return response()->json(['success' => true]);
    }
}
