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
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke surat
    public function surat()
    {
        return $this->hasMany(Surat::class, 'template_surat_id');
    }

    // Helper: Generate surat dari template dengan data penduduk
    public function generateSurat($penduduk, $surat)
    {
        $content = $this->isi_template;

        // Replace placeholder penduduk
        $replacements = [
            '[NAMA_PENDUDUK]' => strtoupper($penduduk->nama),
            '[NIK]' => $penduduk->nik,
            '[TEMPAT_LAHIR]' => $penduduk->tempat_lahir,
            '[TANGGAL_LAHIR]' => $penduduk->tanggal_lahir->format('d F Y'),
            '[TANGGAL_LAHIR_ANGKA]' => $penduduk->tanggal_lahir->format('d-m-Y'),
            '[ALAMAT]' => $penduduk->alamat,
            '[RT]' => $penduduk->rt,
            '[RW]' => $penduduk->rw,
            '[PEKERJAAN]' => $penduduk->pekerjaan,
            '[AGAMA]' => $penduduk->agama,
            '[STATUS_PERKAWINAN]' => $penduduk->status_perkawinan,
            '[PENDIDIKAN]' => $penduduk->pendidikan ?? '-',
            '[JENIS_KELAMIN]' => $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            '[KEWARGANEGARAAN]' => $penduduk->kewarganegaraan,
            '[NO_KK]' => $penduduk->no_kk ?? '-',
            
            // Replace data surat
            '[NOMOR_SURAT]' => $surat->nomor_surat,
            '[TANGGAL_SURAT]' => $surat->tanggal_surat->format('d F Y'),
            '[TANGGAL_SURAT_ANGKA]' => $surat->tanggal_surat->format('d-m-Y'),
            '[KEPERLUAN]' => $surat->keperluan,
            '[KETERANGAN]' => $surat->keterangan ?? '',
            
            // Replace data penandatangan
            '[PENANDATANGAN_JABATAN]' => $this->penandatangan_jabatan,
            '[PENANDATANGAN_NAMA]' => $this->penandatangan_nama,
            '[PENANDATANGAN_NIP]' => $this->penandatangan_nip ?? '',
        ];

        // Replace semua placeholder
        foreach ($replacements as $placeholder => $value) {
            $content = str_replace($placeholder, $value, $content);
        }

        return $content;
    }

    // Helper: Daftar placeholder yang tersedia
    public static function getAvailablePlaceholders()
    {
        return [
            'Data Penduduk' => [
                '[NAMA_PENDUDUK]' => 'Nama lengkap penduduk (UPPERCASE)',
                '[NIK]' => 'Nomor Induk Kependudukan',
                '[TEMPAT_LAHIR]' => 'Tempat lahir',
                '[TANGGAL_LAHIR]' => 'Tanggal lahir (14 Februari 2024)',
                '[TANGGAL_LAHIR_ANGKA]' => 'Tanggal lahir (14-02-2024)',
                '[ALAMAT]' => 'Alamat lengkap',
                '[RT]' => 'Nomor RT',
                '[RW]' => 'Nomor RW',
                '[PEKERJAAN]' => 'Pekerjaan',
                '[AGAMA]' => 'Agama',
                '[STATUS_PERKAWINAN]' => 'Status perkawinan',
                '[PENDIDIKAN]' => 'Pendidikan terakhir',
                '[JENIS_KELAMIN]' => 'Jenis kelamin (Laki-laki/Perempuan)',
                '[KEWARGANEGARAAN]' => 'Kewarganegaraan',
                '[NO_KK]' => 'Nomor Kartu Keluarga',
            ],
            'Data Surat' => [
                '[NOMOR_SURAT]' => 'Nomor surat',
                '[TANGGAL_SURAT]' => 'Tanggal surat (14 Februari 2024)',
                '[TANGGAL_SURAT_ANGKA]' => 'Tanggal surat (14-02-2024)',
                '[KEPERLUAN]' => 'Keperluan surat',
                '[KETERANGAN]' => 'Keterangan tambahan',
            ],
            'Data Penandatangan' => [
                '[PENANDATANGAN_JABATAN]' => 'Jabatan penandatangan',
                '[PENANDATANGAN_NAMA]' => 'Nama penandatangan',
                '[PENANDATANGAN_NIP]' => 'NIP penandatangan',
            ],
        ];
    }
}