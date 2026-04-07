<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Penduduk;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ✅ TAMBAHAN: Wajib di-import untuk Database Transaction
use Illuminate\Support\Facades\Storage; // ✅ TAMBAHAN: Untuk menghapus file jika terjadi error

class PengajuanSuratController extends Controller
{
    public function index()
    {
        $templates = TemplateSurat::where('aktif', true)->get();
        return view('ajukan-surat', compact('templates'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (✅ KOREKSI: Tambahkan validasi tanggal_lahir)
        $request->validate([
            'nik'               => 'required|digits:16',
            'tanggal_lahir'     => 'required|date', // <-- Validasi baru
            'template_surat_id' => 'required|exists:template_surat,id',
            'keperluan'         => 'required|string|max:500',
            'keterangan'        => 'nullable|string|max:1000',
            'file_dokumen'      => 'required|array', 
            'file_dokumen.*'    => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', 
        ], [
            'file_dokumen.required'   => 'Minimal satu dokumen persyaratan wajib diunggah.',
            'file_dokumen.*.mimes'    => 'Format file harus JPG, PNG, atau PDF.',
            'file_dokumen.*.max'      => 'Ukuran file per dokumen maksimal 2MB.',
        ]);

        // 2. Cocokkan NIK dan Tanggal Lahir (✅ KOREKSI: Mencegah pengajuan palsu)
        $penduduk = Penduduk::where('nik', $request->nik)
                            ->where('tanggal_lahir', $request->tanggal_lahir)
                            ->first();
                            
        if (!$penduduk) {
            return back()
                ->withInput()
                ->withErrors(['nik' => 'Data tidak cocok. NIK atau Tanggal Lahir tidak ditemukan di data penduduk desa.']);
        }

        $template = TemplateSurat::findOrFail($request->template_surat_id);
        $nomor = 'DESA-' . date('Y') . '-' . strtoupper(substr(uniqid(), -6));

        // 3. Gunakan Database Transaction (✅ KOREKSI: Mencegah Data Orphan/File Sampah)
        DB::beginTransaction();
        
        try {
            // Simpan Data Surat
            $surat = Surat::create([
                'penduduk_id'       => $penduduk->id,
                'template_surat_id' => $template->id,
                'jenis_surat'       => $template->nama_template,
                'nomor_surat'       => $nomor,
                'tanggal_surat'     => now()->toDateString(),
                'keperluan'         => $request->keperluan,
                'keterangan'        => $request->keterangan,
                'penandatangan'     => $template->penandatangan_nama,
                'status'            => 'Pending',
            ]);

            // Looping untuk menyimpan file dokumen
            if ($request->hasFile('file_dokumen')) {
                foreach ($request->file('file_dokumen') as $file) {
                    $pathDokumen = $file->store('dokumen-surat', 'private');
                    
                    $surat->dokumen()->create([
                        'file_path' => $pathDokumen,
                        'nama_file_asli' => $file->getClientOriginalName()
                    ]);
                }
            }

            // Jika semua proses di atas berhasil, simpan permanen ke database
            DB::commit();

            return redirect()->route('pengajuan.sukses', $surat->nomor_surat)
                             ->with('success', 'Pengajuan berhasil dikirim!');

        } catch (\Exception $e) {
            // Jika terjadi error (misal disk penuh, database timeout)
            DB::rollBack(); // Batalkan penyimpanan tabel Surat dan Dokumen

            // Hapus file yang mungkin terlanjur terupload sebelum error terjadi
            if (isset($pathDokumen) && Storage::disk('private')->exists($pathDokumen)) {
                Storage::disk('private')->delete($pathDokumen);
            }

            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan sistem saat mengunggah dokumen. Silakan coba lagi nanti.']);
        }
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
        $templates = \App\Models\TemplateSurat::all();

        // Jika belum ada input NIK, tampilkan halaman kosong dulu
        if (!$request->filled('nik')) {
            return view('surat.cek', compact('templates'));
        }

        $request->validate([
            'nik'           => 'required|digits:16',
            'tanggal_lahir' => 'required|date',
        ], [
            'nik.required'           => 'NIK wajib diisi.',
            'nik.digits'             => 'NIK harus 16 digit angka.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi untuk keamanan data.',
            'tanggal_lahir.date'     => 'Format tanggal lahir tidak valid.',
        ]);

        $penduduk = Penduduk::where('nik', $request->nik)
                            ->where('tanggal_lahir', $request->tanggal_lahir)
                            ->first();

        // Jika tidak cocok, tolak aksesnya
        if (!$penduduk) {
            return back()
                ->withErrors(['nik' => 'Akses ditolak. Kombinasi NIK dan Tanggal Lahir tidak ditemukan.'])
                ->withInput();
        }

        // Siapkan query dasar untuk mengambil riwayat
        $query = Surat::with('templateSurat')
                    ->where('penduduk_id', $penduduk->id)
                    ->latest();

        // Filter jenis surat
        if ($request->filled('jenis_surat')) {
            $query->whereHas('templateSurat', function ($q) use ($request) {
                $q->where('nama_template', $request->jenis_surat);
            });
        }

        $riwayat = $query->get();

        return view('surat.cek', compact('penduduk', 'riwayat', 'templates'));
    }
}