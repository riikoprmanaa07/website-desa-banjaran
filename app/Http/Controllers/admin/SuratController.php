<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use App\Models\Penduduk;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = Surat::with('penduduk', 'dokumen');

        // Search 
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_surat', 'like', '%' . $search . '%')
                  ->orWhere('jenis_surat', 'like', '%' . $search . '%')
                  ->orWhereHas('penduduk', function ($q2) use ($search) {
                      $q2->where('nama', 'like', '%' . $search . '%')
                         ->orWhere('nik', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter jenis
        if ($request->filled('jenis')) {
            $query->where('jenis_surat', $request->jenis);
        }

        $surat = $query->latest()->paginate(20);

        // Statistik
        $stats = [
            'pending'  => Surat::where('status', 'Pending')->count(),
            'diproses' => Surat::where('status', 'Diproses')->count(),
            'selesai'  => Surat::where('status', 'Selesai')->count(),
            'ditolak'  => Surat::where('status', 'Ditolak')->count(),
        ];

        return view('admin.surat.index', compact('surat', 'stats'));
    }

    public function create()
    {
        $penduduk  = Penduduk::orderBy('nama')->get();
        $templates = TemplateSurat::where('aktif', true)->orderBy('nama_template')->get();

        return view('admin.surat.create', compact('penduduk', 'templates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'penduduk_id'       => 'required|exists:penduduk,id',
            'template_surat_id' => 'required|exists:template_surat,id',
            'jenis_surat'       => 'required|string',
            'tanggal_surat'     => 'required|date',
            'keperluan'         => 'required|string',
            'keterangan'        => 'nullable|string',
            'masa_berlaku'      => 'nullable|string',
        ]);

        $hasil = DB::transaction(function () use ($validated) {
            $penduduk = Penduduk::findOrFail($validated['penduduk_id']);
            $template = TemplateSurat::findOrFail($validated['template_surat_id']);

            $bulanIni = date('m', strtotime($validated['tanggal_surat']));
            $tahunIni = date('Y', strtotime($validated['tanggal_surat']));
            
            // Kunci tabel sementara untuk menghitung urutan agar tidak ada admin lain yang menyerobot
            $latestSurat = Surat::whereMonth('tanggal_surat', $bulanIni)
                                ->whereYear('tanggal_surat', $tahunIni)
                                ->lockForUpdate()
                                ->first();

            $urutan = Surat::whereMonth('tanggal_surat', $bulanIni)
                           ->whereYear('tanggal_surat', $tahunIni)
                           ->count() + 1;

            $arrayBulan = [1=>'I', 2=>'II', 3=>'III', 4=>'IV', 5=>'V', 6=>'VI', 7=>'VII', 8=>'VIII', 9=>'IX', 10=>'X', 11=>'XI', 12=>'XII'];
            $bulanRomawi = $arrayBulan[(int)$bulanIni];

            $urutanFormatted = str_pad($urutan, 3, '0', STR_PAD_LEFT);
            $nomorSurat = $urutanFormatted . '/DS/' . $bulanRomawi . '/' . $tahunIni;

            $berlakuSampai = null;
            if (!empty($validated['masa_berlaku'])) {
                $berlakuSampai = Surat::hitungBerlakuSampai($validated['masa_berlaku'], $validated['tanggal_surat']);
            }

            $tempSurat = (object) [
                'nomor_surat'   => $nomorSurat,
                'tanggal_surat' => new \Carbon\Carbon($validated['tanggal_surat']),
                'keperluan'     => $validated['keperluan'],
                'keterangan'    => $validated['keterangan'] ?? '',
            ];

            return Surat::create([
                'penduduk_id'       => $validated['penduduk_id'],
                'template_surat_id' => $validated['template_surat_id'],
                'jenis_surat'       => $template->nama_template, 
                'nomor_surat'       => $nomorSurat,
                'tanggal_surat'     => $validated['tanggal_surat'],
                'keperluan'         => $validated['keperluan'],
                'keterangan'        => $validated['keterangan'] ?? null,
                'masa_berlaku'      => $validated['masa_berlaku'] ?? null,
                'berlaku_sampai'    => $berlakuSampai,
                'isi_surat'         => $template->generateSurat($penduduk, $tempSurat),
                'penandatangan'     => $template->penandatangan_nama,
                'status'            => 'Pending',
            ]);
        });

        return redirect()->route('admin.surat.index')
            ->with('success', 'Surat berhasil dibuat dengan nomor otomatis: ' . $hasil->nomor_surat);
    }

    public function show($id)
    {
        $surat = Surat::with(['penduduk', 'templateSurat', 'dokumen'])->findOrFail($id);
        return view('admin.surat.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat     = Surat::findOrFail($id);
        $penduduk  = Penduduk::orderBy('nama')->get();
        $templates = TemplateSurat::where('aktif', true)->orderBy('nama_template')->get();

        return view('admin.surat.edit', compact('surat', 'penduduk', 'templates'));
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $validated = $request->validate([
            'penduduk_id'       => 'required|exists:penduduk,id',
            'template_surat_id' => 'required|exists:template_surat,id',
            'nomor_surat'       => 'required|string|unique:surat,nomor_surat,' . $id,
            'tanggal_surat'     => 'required|date',
            'keperluan'         => 'required|string',
            'penandatangan'     => 'required|string|max:255',
            'keterangan'        => 'nullable|string',
            'masa_berlaku'      => 'nullable|string', 
            'status'            => 'required|in:Pending,Diproses,Selesai,Ditolak',
        ]);

        $needRegenerate = (
            $surat->template_surat_id != $validated['template_surat_id'] ||
            $surat->penduduk_id != $validated['penduduk_id'] ||
            $surat->tanggal_surat->format('Y-m-d') != $validated['tanggal_surat'] ||
            $surat->masa_berlaku != ($validated['masa_berlaku'] ?? null) ||
            $surat->nomor_surat != $validated['nomor_surat']
        );

        if ($needRegenerate) {
            $berlakuSampai = null;
            $berlakuFormat = '';
            $tglSurat = new \Carbon\Carbon($validated['tanggal_surat']);

            if (!empty($validated['masa_berlaku'])) {
                $berlakuSampai = Surat::hitungBerlakuSampai($validated['masa_berlaku'], $validated['tanggal_surat']);
                if ($berlakuSampai) {
                    $bulanId = [1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'];
                    $fmt = fn($d) => $d->format('d') . ' ' . $bulanId[(int)$d->format('n')] . ' ' . $d->format('Y');
                    $berlakuFormat = $fmt($tglSurat) . ' s/d ' . $fmt($berlakuSampai);
                }
            }

            $penduduk = Penduduk::findOrFail($validated['penduduk_id']);
            $template = TemplateSurat::findOrFail($validated['template_surat_id']);

            $tempSurat = (object) [
                'nomor_surat'   => $validated['nomor_surat'],
                'tanggal_surat' => clone $tglSurat,
                'keperluan'     => $validated['keperluan'],
                'keterangan'    => $validated['keterangan'] ?? '',
            ];

            $validated['isi_surat']      = $template->generateSurat($penduduk, $tempSurat, $berlakuFormat);
            $validated['jenis_surat']    = $template->nama_template;
            $validated['berlaku_sampai'] = $berlakuSampai;
        }

        // ✅ PERBAIKAN: Otomatis hapus file KTP/KK warga jika admin menolak surat dari halaman edit
        if ($validated['status'] === 'Ditolak') {
            $dokumens = $surat->dokumen()->get();
            foreach ($dokumens as $dok) {
                if (Storage::disk('private')->exists($dok->file_path)) {
                    Storage::disk('private')->delete($dok->file_path);
                }
            }
            $surat->dokumen()->delete();
        }

        $surat->update($validated);

        return redirect()->route('admin.surat.show', $surat->id)
            ->with('success', 'Surat berhasil diupdate dan disesuaikan.');
    }

    public function destroy($id)
    {
        $surat = Surat::with('dokumen')->findOrFail($id);
        
        foreach ($surat->dokumen as $dok) {
            if (Storage::disk('private')->exists($dok->file_path)) {
                Storage::disk('private')->delete($dok->file_path);
            }
        }

        $surat->delete();

        return redirect()->route('admin.surat.index')
            ->with('success', 'Surat dan dokumen persyaratan berhasil dihapus.');
    }

    public function updateStatus(Request $request, $id)
    {
        $surat = Surat::with('dokumen')->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Pending,Diproses,Selesai,Ditolak',
        ]);

        // ✅ PERBAIKAN: Otomatis hapus file fisik (KTP/KK) jika surat ditolak
        if ($validated['status'] === 'Ditolak') {
            foreach ($surat->dokumen as $dok) {
                if (Storage::disk('private')->exists($dok->file_path)) {
                    Storage::disk('private')->delete($dok->file_path);
                }
            }
            // Hapus data dokumen dari database
            $surat->dokumen()->delete();
        }

        $surat->update($validated);

        return back()->with('success', 'Status surat berhasil diupdate. Jika Ditolak, file persyaratan otomatis dihapus untuk menghemat server.');
    }

    public function print($id)
    {
        $surat    = Surat::with(['penduduk', 'templateSurat'])->findOrFail($id);
        $template = $surat->templateSurat;
        $penduduk = $surat->penduduk;

        $isiSuratRaw = $template->generateSurat($penduduk, $surat);

        $baris = explode("\n", $isiSuratRaw);
        $html  = '';
        $inTable = false;

        foreach ($baris as $b) {
            $b = trim($b);
            if ($b === '') {
                if ($inTable) { 
                    $html .= '</table><br>'; 
                    $inTable = false; 
                } else { 
                    $html .= '<br>'; 
                }
                continue;
            }

            $pos = strpos($b, ':');
            if ($pos !== false && $pos > 0 && $pos < 40 && !preg_match('/[.!?]$/', $b)) {
                if (!$inTable) {
                    $html .= '<table style="width:100%; border-collapse:collapse; margin-bottom: 10px;">';
                    $inTable = true;
                }
                $label = trim(substr($b, 0, $pos));
                $nilai = trim(substr($b, $pos + 1));
                
                $html .= '<tr>
                    <td style="width: 30%; vertical-align: top; padding: 2px 0;">' . e($label) . '</td>
                    <td style="width: 2%; vertical-align: top; padding: 2px 0;">:</td>
                    <td style="vertical-align: top; padding: 2px 0;">' . e($nilai) . '</td>
                </tr>';
            } else {
                if ($inTable) { 
                    $html .= '</table>'; 
                    $inTable = false; 
                }
                $html .= '<div style="margin-bottom: 5px; text-align: justify;">' . e($b) . '</div>';
            }
        }
        
        if ($inTable) { 
            $html .= '</table>'; 
        }
        
        $isiSurat = $html;

        $namaPemohon = strtoupper($penduduk->nama);
        $masaBerlakuFormat = $surat->masa_berlaku ? $surat->formatMasaBerlaku() : '';

        $pdf = Pdf::loadView('admin.surat.print', compact(
                'surat', 'template', 'isiSurat', 'penduduk',
                'namaPemohon', 'masaBerlakuFormat'
            ))
            ->setPaper([0, 0, 612.28, 935.43], 'portrait'); 

        $namaFile = 'Surat-' . str_replace('/', '-', $surat->nomor_surat) . '.pdf';
        return $pdf->download($namaFile);
    }
    
    public function verifikasi(Request $request, $id)
    {
        $surat = Surat::with(['penduduk', 'templateSurat'])->findOrFail($id);

        $validated = $request->validate([
            'nomor_surat'  => 'required|unique:surat,nomor_surat,' . $id,
            'masa_berlaku' => 'nullable|string|max:100',
        ]);

        DB::transaction(function () use ($surat, $validated) {
            $berlakuSampai = null;
            $berlakuFormat = '';

            if (! empty($validated['masa_berlaku'])) {
                $berlakuSampai = Surat::hitungBerlakuSampai(
                    $validated['masa_berlaku'],
                    $surat->tanggal_surat
                );

                if ($berlakuSampai) {
                    $bulanId = [
                        1=>'Januari',   2=>'Februari', 3=>'Maret',    4=>'April',
                        5=>'Mei',       6=>'Juni',     7=>'Juli',      8=>'Agustus',
                        9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember',
                    ];
                    $fmt = fn($d) => $d->format('d') . ' ' . $bulanId[(int)$d->format('n')] . ' ' . $d->format('Y');
                    $berlakuFormat = $fmt($surat->tanggal_surat) . ' s/d ' . $fmt($berlakuSampai);
                }
            }

            $surat->nomor_surat = $validated['nomor_surat'];

            $isiSuratGenerated = $surat->templateSurat->generateSurat(
                $surat->penduduk,
                $surat,
                $berlakuFormat
            );

            $surat->update([
                'nomor_surat'    => $validated['nomor_surat'],
                'isi_surat'      => $isiSuratGenerated,
                'status'         => 'Selesai',
                'masa_berlaku'   => $validated['masa_berlaku'] ?? null,
                'berlaku_sampai' => $berlakuSampai,
            ]);
        });

        return redirect()->route('admin.surat.index')
            ->with('success', 'Surat berhasil diverifikasi dan siap cetak.');
    }
    
    public function downloadDokumen($id)
    {
        $dokumen = \App\Models\DokumenSurat::findOrFail($id);
        
        if (!Storage::disk('private')->exists($dokumen->file_path)) {
            abort(404, 'File dokumen tidak ditemukan atau sudah dihapus.');
        }

        return Storage::disk('private')->download(
            $dokumen->file_path, 
            $dokumen->nama_file_asli
        );
    }
}