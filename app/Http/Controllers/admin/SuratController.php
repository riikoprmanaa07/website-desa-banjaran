<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use App\Models\Penduduk;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // ✅ TAMBAHAN: import DomPDF untuk cetak PDF

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = Surat::with('penduduk');

        // Search — ✅ PERBAIKAN: tambah pencarian nama penduduk
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

        // ✅ TAMBAHAN: hitung statistik dari semua data (bukan dari paginated)
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
        ]);

        $penduduk = Penduduk::findOrFail($validated['penduduk_id']);
        $template = TemplateSurat::findOrFail($validated['template_surat_id']);

        // ✅ PERBAIKAN: generate nomor surat otomatis (tidak perlu input manual)
        $nomorSurat = 'DESA/' . date('Y') . '/' . strtoupper(substr(uniqid(), -6));

        // Buat objek sementara untuk generateSurat
        $tempSurat = (object) [
            'nomor_surat'   => $nomorSurat,
            'tanggal_surat' => new \Carbon\Carbon($validated['tanggal_surat']),
            'keperluan'     => $validated['keperluan'],
            'keterangan'    => $validated['keterangan'] ?? '',
        ];

        Surat::create([
            'penduduk_id'       => $validated['penduduk_id'],
            'template_surat_id' => $validated['template_surat_id'],
            'jenis_surat'       => $template->nama_template, // ✅ ambil dari template, bukan input
            'nomor_surat'       => $nomorSurat,
            'tanggal_surat'     => $validated['tanggal_surat'],
            'keperluan'         => $validated['keperluan'],
            'keterangan'        => $validated['keterangan'] ?? null,
            'isi_surat'         => $template->generateSurat($penduduk, $tempSurat),
            'penandatangan'     => $template->penandatangan_nama,
            'status'            => 'Pending',
        ]);

        return redirect()->route('admin.surat.index')
            ->with('success', 'Surat berhasil dibuat.');
    }

    public function show($id)
    {
        $surat = Surat::with(['penduduk', 'templateSurat'])->findOrFail($id);
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
        'penandatangan'     => 'required|string|max:255', // ✅ tambahan
        'keterangan'        => 'nullable|string',
        'status'            => 'required|in:Pending,Diproses,Selesai,Ditolak',
    ]);

    // Re-generate isi surat jika template atau penduduk berubah
    if ($surat->template_surat_id != $validated['template_surat_id'] ||
        $surat->penduduk_id != $validated['penduduk_id']) {

        $penduduk = Penduduk::findOrFail($validated['penduduk_id']);
        $template = TemplateSurat::findOrFail($validated['template_surat_id']);

        $tempSurat = (object) [
            'nomor_surat'   => $validated['nomor_surat'],
            'tanggal_surat' => new \Carbon\Carbon($validated['tanggal_surat']),
            'keperluan'     => $validated['keperluan'],
            'keterangan'    => $validated['keterangan'] ?? '',
        ];

        $validated['isi_surat']     = $template->generateSurat($penduduk, $tempSurat);
        $validated['jenis_surat']   = $template->nama_template;
    }

    $surat->update($validated);

    return redirect()->route('admin.surat.show', $surat->id)
        ->with('success', 'Surat berhasil diupdate.');
}

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        return redirect()->route('admin.surat.index')
            ->with('success', 'Surat berhasil dihapus.');
    }

    public function updateStatus(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Pending,Diproses,Selesai,Ditolak',
        ]);

        $surat->update($validated);

        return back()->with('success', 'Status surat berhasil diupdate.');
    }

    // ✅ PERBAIKAN: print sekarang generate PDF menggunakan DomPDF
    public function print($id)
    {
        $surat    = Surat::with(['penduduk', 'templateSurat'])->findOrFail($id);
        $template = $surat->templateSurat;
        $penduduk = $surat->penduduk;

        // Generate isi surat terbaru dari template
        $isiSurat = $template->generateSurat($penduduk, $surat);

        $pdf = Pdf::loadView('admin.surat.print', compact('surat', 'template', 'isiSurat', 'penduduk'))
                  ->setPaper('a4', 'portrait');
                  

        $namaFile = 'Surat-' . str_replace('/', '-', $surat->nomor_surat) . '.pdf';
        return $pdf->download($namaFile);
    }

    public function verifikasi(Request $request, $id)
    {
        $surat = Surat::with(['penduduk', 'templateSurat'])->findOrFail($id);

        $validated = $request->validate([
            'nomor_surat' => 'required|unique:surat,nomor_surat,' . $id,
        ]);

        // Generate ulang isi surat dengan nomor baru
        $tempSurat = (object) [
            'nomor_surat'   => $validated['nomor_surat'],
            'tanggal_surat' => $surat->tanggal_surat,
            'keperluan'     => $surat->keperluan,
            'keterangan'    => $surat->keterangan ?? '',
        ];

        $isiSuratGenerated = $surat->templateSurat->generateSurat($surat->penduduk, $tempSurat);

        $surat->update([
            'nomor_surat' => $validated['nomor_surat'],
            'isi_surat'   => $isiSuratGenerated,
            'status'      => 'Selesai',
        ]);

        return redirect()->route('admin.surat.index')
            ->with('success', 'Surat berhasil diverifikasi dan siap cetak.');
    }
}