<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TemplateSurat;

class TemplateSuratSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'nama_template'         => 'Surat Keterangan Domisili',
                'jenis_surat'           => 'Keterangan',
                'kop_surat'             => "PEMERINTAH DESA BANJARAN\nKECAMATAN [NAMA KECAMATAN] KABUPATEN [NAMA KABUPATEN]\nAlamat: Jl. Desa Banjaran No.1 | Telp: (0xxx) xxxx",
                'judul_surat'           => 'SURAT KETERANGAN DOMISILI',
                'pembuka'               => 'Yang bertanda tangan di bawah ini, [PENANDATANGAN_JABATAN] Desa Banjaran, dengan ini menerangkan bahwa:',
                'isi_template'          => "Nama Lengkap       : [NAMA_PENDUDUK]\nNIK                : [NIK]\nTempat/Tgl Lahir   : [TEMPAT_LAHIR], [TANGGAL_LAHIR]\nJenis Kelamin      : [JENIS_KELAMIN]\nAgama              : [AGAMA]\nStatus Perkawinan  : [STATUS_PERKAWINAN]\nPekerjaan          : [PEKERJAAN]\nAlamat             : [ALAMAT] RT [RT] / RW [RW]\n\nAdalah benar warga yang berdomisili di Desa Banjaran. Surat ini dibuat untuk keperluan [KEPERLUAN] dan agar dapat dipergunakan sebagaimana mestinya.",
                'penutup'               => 'Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.',
                'penandatangan_jabatan' => 'Kepala Desa',
                'penandatangan_nama'    => '[Nama Kepala Desa]',
                'penandatangan_nip'     => null,
                'aktif'                 => true,
            ],
            [
                'nama_template'         => 'Surat Keterangan Tidak Mampu',
                'jenis_surat'           => 'Keterangan',
                'kop_surat'             => "PEMERINTAH DESA BANJARAN\nKECAMATAN [NAMA KECAMATAN] KABUPATEN [NAMA KABUPATEN]\nAlamat: Jl. Desa Banjaran No.1 | Telp: (0xxx) xxxx",
                'judul_surat'           => 'SURAT KETERANGAN TIDAK MAMPU',
                'pembuka'               => 'Yang bertanda tangan di bawah ini, [PENANDATANGAN_JABATAN] Desa Banjaran, dengan ini menerangkan bahwa:',
                'isi_template'          => "Nama Lengkap       : [NAMA_PENDUDUK]\nNIK                : [NIK]\nTempat/Tgl Lahir   : [TEMPAT_LAHIR], [TANGGAL_LAHIR]\nJenis Kelamin      : [JENIS_KELAMIN]\nAgama              : [AGAMA]\nPekerjaan          : [PEKERJAAN]\nAlamat             : [ALAMAT] RT [RT] / RW [RW]\n\nAdalah benar merupakan warga tidak mampu di Desa Banjaran. Surat ini dibuat untuk keperluan [KEPERLUAN].",
                'penutup'               => 'Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.',
                'penandatangan_jabatan' => 'Kepala Desa',
                'penandatangan_nama'    => '[Nama Kepala Desa]',
                'penandatangan_nip'     => null,
                'aktif'                 => true,
            ],
            [
                'nama_template'         => 'Surat Keterangan Usaha',
                'jenis_surat'           => 'Keterangan',
                'kop_surat'             => "PEMERINTAH DESA BANJARAN\nKECAMATAN [NAMA KECAMATAN] KABUPATEN [NAMA KABUPATEN]\nAlamat: Jl. Desa Banjaran No.1 | Telp: (0xxx) xxxx",
                'judul_surat'           => 'SURAT KETERANGAN USAHA',
                'pembuka'               => 'Yang bertanda tangan di bawah ini, [PENANDATANGAN_JABATAN] Desa Banjaran, dengan ini menerangkan bahwa:',
                'isi_template'          => "Nama Lengkap       : [NAMA_PENDUDUK]\nNIK                : [NIK]\nTempat/Tgl Lahir   : [TEMPAT_LAHIR], [TANGGAL_LAHIR]\nJenis Kelamin      : [JENIS_KELAMIN]\nAlamat             : [ALAMAT] RT [RT] / RW [RW]\n\nAdalah benar warga Desa Banjaran yang mempunyai usaha di wilayah Desa Banjaran. Surat ini dibuat untuk keperluan [KEPERLUAN].",
                'penutup'               => 'Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.',
                'penandatangan_jabatan' => 'Kepala Desa',
                'penandatangan_nama'    => '[Nama Kepala Desa]',
                'penandatangan_nip'     => null,
                'aktif'                 => true,
            ],
            [
                'nama_template'         => 'Surat Pengantar Nikah',
                'jenis_surat'           => 'Pengantar',
                'kop_surat'             => "PEMERINTAH DESA BANJARAN\nKECAMATAN [NAMA KECAMATAN] KABUPATEN [NAMA KABUPATEN]\nAlamat: Jl. Desa Banjaran No.1 | Telp: (0xxx) xxxx",
                'judul_surat'           => 'SURAT PENGANTAR NIKAH',
                'pembuka'               => 'Yang bertanda tangan di bawah ini, [PENANDATANGAN_JABATAN] Desa Banjaran, dengan ini menerangkan bahwa:',
                'isi_template'          => "Nama Lengkap       : [NAMA_PENDUDUK]\nNIK                : [NIK]\nTempat/Tgl Lahir   : [TEMPAT_LAHIR], [TANGGAL_LAHIR]\nJenis Kelamin      : [JENIS_KELAMIN]\nAgama              : [AGAMA]\nStatus Perkawinan  : [STATUS_PERKAWINAN]\nPekerjaan          : [PEKERJAAN]\nAlamat             : [ALAMAT] RT [RT] / RW [RW]\n\nBermaksud untuk melangsungkan pernikahan. Surat pengantar ini dibuat untuk keperluan [KEPERLUAN].",
                'penutup'               => 'Demikian surat pengantar ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.',
                'penandatangan_jabatan' => 'Kepala Desa',
                'penandatangan_nama'    => '[Nama Kepala Desa]',
                'penandatangan_nip'     => null,
                'aktif'                 => true,
            ],
        ];

        foreach ($templates as $template) {
            TemplateSurat::create($template);
        }
    }
}