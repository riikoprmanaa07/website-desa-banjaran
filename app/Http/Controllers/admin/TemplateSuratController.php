<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;

class TemplateSuratController extends Controller
{
    public function index()
    {
        $templates = TemplateSurat::latest()->paginate(20);
        return view('admin.template-surat.index', compact('templates'));
    }

    public function create()
    {
        $placeholders = TemplateSurat::getAvailablePlaceholders();
        return view('admin.template-surat.create', compact('placeholders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_template' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:255',
            'kop_surat' => 'required|string',
            'judul_surat' => 'required|string|max:255',
            'pembuka' => 'required|string',
            'isi_template' => 'required|string',
            'penutup' => 'nullable|string',
            'penandatangan_jabatan' => 'required|string|max:255',
            'penandatangan_nama' => 'required|string|max:255',
            'penandatangan_nip' => 'nullable|string|max:50',
            'aktif' => 'boolean',
        ]);

        $validated['aktif'] = $request->has('aktif');

        TemplateSurat::create($validated);

        return redirect()->route('admin.template-surat.index')
            ->with('success', 'Template surat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $template = TemplateSurat::findOrFail($id);
        $placeholders = TemplateSurat::getAvailablePlaceholders();
        return view('admin.template-surat.edit', compact('template', 'placeholders'));
    }

    public function update(Request $request, $id)
    {
        $template = TemplateSurat::findOrFail($id);

        $validated = $request->validate([
            'nama_template' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:255',
            'kop_surat' => 'required|string',
            'judul_surat' => 'required|string|max:255',
            'pembuka' => 'required|string',
            'isi_template' => 'required|string',
            'penutup' => 'nullable|string',
            'penandatangan_jabatan' => 'required|string|max:255',
            'penandatangan_nama' => 'required|string|max:255',
            'penandatangan_nip' => 'nullable|string|max:50',
            'aktif' => 'boolean',
        ]);

        $validated['aktif'] = $request->has('aktif');

        $template->update($validated);

        return redirect()->route('admin.template-surat.index')
            ->with('success', 'Template surat berhasil diupdate');
    }

    public function destroy($id)
    {
        $template = TemplateSurat::findOrFail($id);
        
        // Cek apakah template masih digunakan
        if ($template->surat()->count() > 0) {
            return back()->with('error', 'Template tidak dapat dihapus karena masih digunakan di ' . $template->surat()->count() . ' surat');
        }

        $template->delete();

        return redirect()->route('admin.template-surat.index')
            ->with('success', 'Template surat berhasil dihapus');
    }

    public function preview($id)
    {
        $template = TemplateSurat::findOrFail($id);
        
        // Data dummy untuk preview
        $dummyData = [
            '[NAMA_PENDUDUK]' => 'BUDI SANTOSO',
            '[NIK]' => '3301234567890123',
            '[TEMPAT_LAHIR]' => 'Banjaran',
            '[TANGGAL_LAHIR]' => '15 Januari 1990',
            '[ALAMAT]' => 'Jl. Merdeka No. 123',
            '[RT]' => '001',
            '[RW]' => '002',
            '[PEKERJAAN]' => 'Wiraswasta',
            '[AGAMA]' => 'Islam',
            '[STATUS_PERKAWINAN]' => 'Kawin',
            '[PENDIDIKAN]' => 'S1',
            '[JENIS_KELAMIN]' => 'Laki-laki',
            '[KEWARGANEGARAAN]' => 'WNI',
            '[NO_KK]' => '3301234567890001',
            '[NOMOR_SURAT]' => '001/SK/DS/II/2024',
            '[TANGGAL_SURAT]' => '16 Februari 2024',
            '[KEPERLUAN]' => 'Untuk keperluan administrasi',
            '[KETERANGAN]' => 'Keterangan tambahan',
            '[PENANDATANGAN_JABATAN]' => $template->penandatangan_jabatan,
            '[PENANDATANGAN_NAMA]' => $template->penandatangan_nama,
            '[PENANDATANGAN_NIP]' => $template->penandatangan_nip ?? '',
        ];

        $preview = str_replace(
            array_keys($dummyData),
            array_values($dummyData),
            $template->isi_template
        );

        return view('admin.template-surat.preview', compact('template', 'preview'));
    }
}