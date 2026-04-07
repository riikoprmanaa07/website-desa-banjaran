<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemplateSurat;
use App\Models\Surat;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            'nama_template'           => 'required|string|max:255',
            'jenis_surat'             => 'required|string|max:255',
            'kop_surat'               => 'required|string',
            'judul_surat'             => 'required|string|max:255',
            'pembuka'                 => 'required|string',
            'isi_template'            => 'required|string',
            'penutup'                 => 'nullable|string',
            'penandatangan_jabatan'   => 'required|string|max:255',
            'penandatangan_nama'      => 'required|string|max:255',
            'penandatangan_nip'       => 'nullable|string|max:50',
            'aktif'                   => 'boolean',
            'butuh_ttd_pemohon'       => 'nullable|boolean',
            'label_ttd_pemohon'       => 'nullable|string|max:100',
            'tampil_nama_pemohon'     => 'nullable|boolean',
            // === TAMBAHAN ===
            'masa_berlaku_default'    => 'nullable|string|in:' . implode(',', array_keys(TemplateSurat::pilihanMasaBerlaku())),
        ]);

        $validated['aktif']               = $request->has('aktif');
        $validated['butuh_ttd_pemohon']   = $request->has('butuh_ttd_pemohon');
        $validated['tampil_nama_pemohon'] = $request->has('tampil_nama_pemohon');

        // Simpan null jika dipilih "— Tidak ada masa berlaku —" (value kosong)
        $validated['masa_berlaku_default'] = $request->input('masa_berlaku_default') ?: null;

        TemplateSurat::create($validated);

        return redirect()->route('admin.template-surat.index')
            ->with('success', 'Template surat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $template     = TemplateSurat::findOrFail($id);
        $placeholders = TemplateSurat::getAvailablePlaceholders();
        return view('admin.template-surat.edit', compact('template', 'placeholders'));
    }

    public function update(Request $request, $id)
    {
        $template = TemplateSurat::findOrFail($id);

        $validated = $request->validate([
            'nama_template'           => 'required|string|max:255',
            'jenis_surat'             => 'required|string|max:255',
            'kop_surat'               => 'required|string',
            'judul_surat'             => 'required|string|max:255',
            'pembuka'                 => 'required|string',
            'isi_template'            => 'required|string',
            'penutup'                 => 'nullable|string',
            'penandatangan_jabatan'   => 'required|string|max:255',
            'penandatangan_nama'      => 'required|string|max:255',
            'penandatangan_nip'       => 'nullable|string|max:50',
            'aktif'                   => 'boolean',
            'butuh_ttd_pemohon'       => 'nullable|boolean',
            'label_ttd_pemohon'       => 'nullable|string|max:100',
            'tampil_nama_pemohon'     => 'nullable|boolean',
            // === TAMBAHAN ===
            'masa_berlaku_default'    => 'nullable|string|in:' . implode(',', array_keys(TemplateSurat::pilihanMasaBerlaku())),
        ]);

        $validated['aktif']               = $request->has('aktif');
        $validated['butuh_ttd_pemohon']   = $request->has('butuh_ttd_pemohon');
        $validated['tampil_nama_pemohon'] = $request->has('tampil_nama_pemohon');
        $validated['masa_berlaku_default'] = $request->input('masa_berlaku_default') ?: null;

        $template->update($validated);

        return redirect()->route('admin.template-surat.index')
            ->with('success', 'Template surat berhasil diupdate');
    }

    public function destroy($id)
    {
        $template = TemplateSurat::findOrFail($id);

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

        // === Hitung contoh masa berlaku untuk preview ===
        $berlakuPreview = '';
        if ($template->masa_berlaku_default) {
            $tanggalContoh  = Carbon::parse('2024-02-16');
            $berlakuSampai  = Surat::hitungBerlakuSampai($template->masa_berlaku_default, $tanggalContoh);
            $bulanId        = [
                1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April',
                5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus',
                9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember',
            ];
            $fmt = fn($d) => $d->format('d') . ' ' . $bulanId[(int)$d->format('n')] . ' ' . $d->format('Y');
            $berlakuPreview = $fmt($tanggalContoh) . ' s/d ' . $fmt($berlakuSampai);
        }

        $dummyData = [
            '[NAMA_PENDUDUK]'         => 'BUDI SANTOSO',
            '[NIK]'                   => '3301234567890123',
            '[TEMPAT_LAHIR]'          => 'Banjaran',
            '[TANGGAL_LAHIR]'         => '15 Januari 1990',
            '[TANGGAL_LAHIR_ANGKA]'   => '15-01-1990',
            '[ALAMAT]'                => 'Jl. Merdeka No. 123',
            '[RT]'                    => '001',
            '[RW]'                    => '002',
            '[PEKERJAAN]'             => 'Wiraswasta',
            '[AGAMA]'                 => 'Islam',
            '[STATUS_PERKAWINAN]'     => 'Kawin',
            '[PENDIDIKAN]'            => 'S1',
            '[JENIS_KELAMIN]'         => 'Laki-laki',
            '[KEWARGANEGARAAN]'       => 'WNI',
            '[NO_KK]'                 => '3301234567890001',
            '[NOMOR_SURAT]'           => '001/SK/DS/II/2024',
            '[TANGGAL_SURAT]'         => '16 Februari 2024',
            '[TANGGAL_SURAT_ANGKA]'   => '16-02-2024',
            '[KEPERLUAN]'             => 'Untuk keperluan administrasi',
            '[KETERANGAN]'            => 'Keterangan tambahan',
            // === TAMBAHAN: preview [BERLAKU] dengan contoh nyata ===
            '[BERLAKU]'               => $berlakuPreview ?: '(tidak ada masa berlaku)',
            '[PENANDATANGAN_JABATAN]' => $template->penandatangan_jabatan,
            '[PENANDATANGAN_NAMA]'    => $template->penandatangan_nama,
            '[PENANDATANGAN_NIP]'     => $template->penandatangan_nip ?? '',
        ];

        $preview = str_replace(
            array_keys($dummyData),
            array_values($dummyData),
            $template->isi_template
        );

        $namaPemohon = 'BUDI SANTOSO';
        $kotaTanggal = 'Banjaran, 16 Februari 2024';

        return view('admin.template-surat.preview', compact(
            'template', 'preview', 'namaPemohon', 'kotaTanggal'
        ));
    }
}