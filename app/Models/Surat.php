<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';

    protected $fillable = [
        'penduduk_id',
        'template_surat_id',
        'nomor_surat',
        'jenis_surat',
        'tanggal_surat',
        'keperluan',
        'keterangan',
        'isi_surat',
        'penandatangan',
        'status',
        'masa_berlaku',     // string bebas: "1 bulan", "2 minggu", dll
        'berlaku_sampai',   // date: dihitung otomatis di controller
    ];

    protected $casts = [
        'tanggal_surat'  => 'date',
        'berlaku_sampai' => 'date',  // === TAMBAHAN ===
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function templateSurat()
    {
        return $this->belongsTo(TemplateSurat::class);
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenSurat::class);
    }
    
    // ✅ PERUBAHAN: Parameter ke-2 sekarang menggunakan Union Type (Carbon|string)
    public static function hitungBerlakuSampai(string $masaBerlaku, Carbon|string $tanggalSurat): ?Carbon
    {
        // ✅ PERUBAHAN: Jika tanggal berbentuk string (dari form), ubah jadi Carbon
        if (is_string($tanggalSurat)) {
            $tanggalSurat = Carbon::parse($tanggalSurat);
        }

        $input = strtolower(trim($masaBerlaku));

        // Ekstrak angka dan satuan
        preg_match('/(\d+)\s*(bulan|minggu|hari|tahun|month|week|day|year)?/i', $input, $matches);

        if (empty($matches[1])) {
            return null; // format tidak dikenali
        }

        $angka  = (int) $matches[1];
        $satuan = $matches[2] ?? 'hari';

        $tanggal = $tanggalSurat->copy();

        return match (true) {
            in_array($satuan, ['bulan', 'month'])  => $tanggal->addMonths($angka),
            in_array($satuan, ['minggu', 'week'])  => $tanggal->addWeeks($angka),
            in_array($satuan, ['tahun', 'year'])   => $tanggal->addYears($angka),
            default                                => $tanggal->addDays($angka),
        };
    }

    // =========================================================
    // HELPER: Format masa berlaku untuk ditampilkan di surat
    // Output: "01 Januari 2026 s/d 01 Februari 2026"
    // =========================================================
    public function formatMasaBerlaku(): string
    {
        // Jika berlaku_sampai belum dihitung, kembalikan string kosong
        // agar placeholder [BERLAKU] tidak menampilkan karakter aneh di surat
        if (! $this->tanggal_surat || ! $this->berlaku_sampai) {
            return '';
        }

        $bulanId = [
            1  => 'Januari',   2  => 'Februari', 3  => 'Maret',
            4  => 'April',     5  => 'Mei',       6  => 'Juni',
            7  => 'Juli',      8  => 'Agustus',   9  => 'September',
            10 => 'Oktober',   11 => 'November',  12 => 'Desember',
        ];

        $mulai  = $this->tanggal_surat;
        $sampai = $this->berlaku_sampai;

        $formatTgl = fn(Carbon $d) =>
            $d->format('d') . ' ' . $bulanId[(int)$d->format('n')] . ' ' . $d->format('Y');

        return $formatTgl($mulai) . ' s/d ' . $formatTgl($sampai);
    }
}