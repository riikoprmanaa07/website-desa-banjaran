<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Penduduk;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;

class PengajuanSuratController extends Controller
{
    public function index()
    {
        $templates = TemplateSurat::where('aktif', true)->get();
        return view('ajukan-surat', compact('templates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'               => 'required|digits:16',
            'template_surat_id' => 'required|exists:template_surat,id',
            'keperluan'         => 'required|string|max:500',
            'jenis_dokumen'     => 'required|in:KTP,KK',
            'file_dokumen'      => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'jenis_dokumen.required' => 'Pilih jenis dokumen (KTP atau KK).',
            'file_dokumen.required'  => 'Dokumen identitas wajib diunggah.',
            'file_dokumen.mimes'     => 'Format file harus JPG, PNG, atau PDF.',
            'file_dokumen.max'       => 'Ukuran file maksimal 2MB.',
        ]);

        $penduduk = Penduduk::where('nik', $request->nik)->first();
        if (!$penduduk) {
            return back()
                ->withInput()
                ->withErrors(['nik' => 'NIK tidak ditemukan di data penduduk desa. Silakan hubungi kantor desa.']);
        }

        $template = TemplateSurat::findOrFail($request->template_surat_id);

        $nomor = 'DESA-' . date('Y') . '-' . strtoupper(substr(uniqid(), -6));

        // Simpan file dokumen ke storage private
        $pathDokumen = $request->file('file_dokumen')->store('dokumen-surat', 'private');

        $surat = Surat::create([
            'penduduk_id'       => $penduduk->id,
            'template_surat_id' => $template->id,
            'jenis_surat'       => $template->nama_template,
            'nomor_surat'       => $nomor,
            'tanggal_surat'     => now()->toDateString(),
            'keperluan'         => $request->keperluan,
            'penandatangan'     => $template->penandatangan_nama,
            'status'            => 'Pending',
            'jenis_dokumen'     => $request->jenis_dokumen,
            'file_dokumen'      => $pathDokumen,
        ]);

        return redirect()->route('pengajuan.sukses', $surat->nomor_surat)
                         ->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function sukses($nomor)
    {
        $surat = Surat::with('penduduk')
                    ->where('nomor_surat', $nomor)
                    ->firstOrFail();

        return view('surat.sukses', compact('surat'));
    }

    public function cek(Request $request)
    {
        // ✅ FIX: Jika belum ada input NIK, tampilkan halaman kosong dulu
        if (!$request->filled('nik')) {
            return view('surat.cek');
        }

        $request->validate([
            'nik' => 'required|digits:16',
        ]);

        $penduduk = Penduduk::where('nik', $request->nik)->first();

        if (!$penduduk) {
            return back()
                ->withErrors(['nik' => 'NIK tidak ditemukan di data penduduk desa.'])
                ->withInput();
        }

        $riwayat = Surat::with('templateSurat')
                    ->where('penduduk_id', $penduduk->id)
                    ->latest()
                    ->get();

        return view('surat.cek', compact('penduduk', 'riwayat'));
    }
}