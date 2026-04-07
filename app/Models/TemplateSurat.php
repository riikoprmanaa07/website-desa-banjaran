<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSurat extends Model
{
    use HasFactory;

    protected $table = 'template_surat';

    protected $fillable = [
        'nama_template',
        'jenis_surat',
        'kop_surat',
        'judul_surat',
        'pembuka',
        'isi_template',
        'penutup',
        'penandatangan_jabatan',
        'penandatangan_nama',
        'penandatangan_nip',
        'aktif',
        'butuh_ttd_pemohon',
        'label_ttd_pemohon',
        'tampil_nama_pemohon',
        // === TAMBAHAN ===
        'masa_berlaku_default', // null = tidak ada masa berlaku
    ];

    protected $casts = [
        'aktif'               => 'boolean',
        'butuh_ttd_pemohon'   => 'boolean',
        'tampil_nama_pemohon' => 'boolean',
        'created_at'          => 'datetime',
        'updated_at'          => 'datetime',
    ];

    // =========================================================
    // KONSTANTA PILIHAN DROPDOWN MASA BERLAKU
    // Dipakai di form create/edit template dan form verifikasi
    // =========================================================
    public static function pilihanMasaBerlaku(): array
    {
        return [
            ''         => '— Tidak ada masa berlaku —',
            '1 minggu' => '1 Minggu',
            '2 minggu' => '2 Minggu',
            '1 bulan'  => '1 Bulan',
            '2 bulan'  => '2 Bulan',
            '3 bulan'  => '3 Bulan',
            '6 bulan'  => '6 Bulan',
            '1 tahun'  => '1 Tahun',
        ];
    }

    public function surat()
    {
        return $this->hasMany(Surat::class, 'template_surat_id');
    }

    // =========================================================
    // GENERATE SURAT
    // berlakuFormat: string opsional, jika diisi langsung dipakai
    //                untuk replace [BERLAKU], tidak perlu hitung ulang
    // =========================================================
    public function generateSurat($penduduk, $surat, string $berlakuFormat = '')
    {
        $content = $this->isi_template;

        // Jika berlakuFormat tidak dikirim, hitung dari data $surat
        if ($berlakuFormat === '') {
            $berlakuFormat = $this->hitungBerlakuFormat($surat);
        }

        $replacements = [
            '[NAMA_PENDUDUK]'         => strtoupper($penduduk->nama),
            '[NIK]'                   => $penduduk->nik,
            '[TEMPAT_LAHIR]'          => $penduduk->tempat_lahir,
            '[TANGGAL_LAHIR]'         => $penduduk->tanggal_lahir->format('d F Y'),
            '[TANGGAL_LAHIR_ANGKA]'   => $penduduk->tanggal_lahir->format('d-m-Y'),
            '[ALAMAT]'                => $penduduk->alamat,
            '[RT]'                    => $penduduk->rt,
            '[RW]'                    => $penduduk->rw,
            '[PEKERJAAN]'             => $penduduk->pekerjaan,
            '[AGAMA]'                 => $penduduk->agama,
            '[STATUS_PERKAWINAN]'     => $penduduk->status_perkawinan,
            '[PENDIDIKAN]'            => $penduduk->pendidikan ?? '-',
            '[JENIS_KELAMIN]'         => $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            '[KEWARGANEGARAAN]'       => $penduduk->kewarganegaraan,
            '[NO_KK]'                 => $penduduk->no_kk ?? '-',
            '[NOMOR_SURAT]'           => $surat->nomor_surat,
            '[TANGGAL_SURAT]'         => $surat->tanggal_surat->format('d F Y'),
            '[TANGGAL_SURAT_ANGKA]'   => $surat->tanggal_surat->format('d-m-Y'),
            '[KEPERLUAN]'             => $surat->keperluan,
            '[KETERANGAN]'            => $surat->keterangan ?? '',
            '[BERLAKU]'               => $berlakuFormat,
            '[PENANDATANGAN_JABATAN]' => $this->penandatangan_jabatan,
            '[PENANDATANGAN_NAMA]'    => $this->penandatangan_nama,
            '[PENANDATANGAN_NIP]'     => $this->penandatangan_nip ?? '',
        ];

        foreach ($replacements as $placeholder => $value) {
            $content = str_replace($placeholder, $value, $content);
        }

        return $content;
    }

    // =========================================================
    // HELPER: hitung format berlaku sebagai string siap pakai
    // Tidak bergantung pada cast model — hitung langsung dari Carbon
    // =========================================================
    private function hitungBerlakuFormat($surat): string
    {
        if (empty($surat->masa_berlaku) || empty($surat->tanggal_surat)) {
            return '';
        }

        $tanggalMulai = $surat->tanggal_surat instanceof \Carbon\Carbon
            ? $surat->tanggal_surat->copy()
            : \Carbon\Carbon::parse($surat->tanggal_surat);

        // Gunakan berlaku_sampai dari DB jika ada, jika tidak hitung ulang
        if (! empty($surat->berlaku_sampai)) {
            $berlakuSampai = $surat->berlaku_sampai instanceof \Carbon\Carbon
                ? $surat->berlaku_sampai->copy()
                : \Carbon\Carbon::parse($surat->berlaku_sampai);
        } else {
            $berlakuSampai = Surat::hitungBerlakuSampai($surat->masa_berlaku, $tanggalMulai);
        }

        if (! $berlakuSampai) {
            return $surat->masa_berlaku;
        }

        $bulanId = [
            1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
            5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
            9=>'September',10=>'Oktober',11=>'November',12=>'Desember',
        ];

        $fmt = fn($d) => $d->format('d') . ' ' . $bulanId[(int)$d->format('n')] . ' ' . $d->format('Y');

        return $fmt($tanggalMulai) . ' s/d ' . $fmt($berlakuSampai);
    }

    // =========================================================
    // DAFTAR PLACEHOLDER
    // =========================================================
    public static function getAvailablePlaceholders(): array
    {
        return [
            'Data Penduduk' => [
                '[NAMA_PENDUDUK]'       => 'Nama lengkap penduduk (UPPERCASE)',
                '[NIK]'                 => 'Nomor Induk Kependudukan',
                '[TEMPAT_LAHIR]'        => 'Tempat lahir',
                '[TANGGAL_LAHIR]'       => 'Tanggal lahir (14 Februari 2024)',
                '[TANGGAL_LAHIR_ANGKA]' => 'Tanggal lahir (14-02-2024)',
                '[ALAMAT]'              => 'Alamat lengkap',
                '[RT]'                  => 'Nomor RT',
                '[RW]'                  => 'Nomor RW',
                '[PEKERJAAN]'           => 'Pekerjaan',
                '[AGAMA]'               => 'Agama',
                '[STATUS_PERKAWINAN]'   => 'Status perkawinan',
                '[PENDIDIKAN]'          => 'Pendidikan terakhir',
                '[JENIS_KELAMIN]'       => 'Jenis kelamin (Laki-laki/Perempuan)',
                '[KEWARGANEGARAAN]'     => 'Kewarganegaraan',
                '[NO_KK]'               => 'Nomor Kartu Keluarga',
            ],
            'Data Surat' => [
                '[NOMOR_SURAT]'         => 'Nomor surat',
                '[TANGGAL_SURAT]'       => 'Tanggal surat (14 Februari 2024)',
                '[TANGGAL_SURAT_ANGKA]' => 'Tanggal surat (14-02-2024)',
                '[KEPERLUAN]'           => 'Keperluan surat',
                '[KETERANGAN]'          => 'Keterangan tambahan',
                '[BERLAKU]'             => 'Masa berlaku (01 Jan 2026 s/d 01 Feb 2026) — otomatis dari template',
            ],
            'Data Penandatangan' => [
                '[PENANDATANGAN_JABATAN]' => 'Jabatan penandatangan',
                '[PENANDATANGAN_NAMA]'    => 'Nama penandatangan',
                '[PENANDATANGAN_NIP]'     => 'NIP penandatangan',
            ],
        ];
    }
}