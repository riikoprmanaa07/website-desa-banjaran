<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom untuk konfigurasi TTD pemohon di template surat.
     * TTD pemohon berupa space kosong yang dicetak (tidak menyimpan gambar).
     */
    public function up(): void
    {
        Schema::table('template_surat', function (Blueprint $table) {
            // Apakah template ini memerlukan TTD pemohon?
            $table->boolean('butuh_ttd_pemohon')->default(false)->after('aktif');

            // Label nama kolom TTD pemohon (default: "Pemohon")
            $table->string('label_ttd_pemohon')->default('Pemohon')->after('butuh_ttd_pemohon');

            // Placeholder nama pemohon di bawah TTD (diambil dari data penduduk saat generate)
            // Kolom ini digunakan jika ingin nama pemohon tercetak di bawah garis TTD
            $table->boolean('tampil_nama_pemohon')->default(true)->after('label_ttd_pemohon');
        });
    }

    public function down(): void
    {
        Schema::table('template_surat', function (Blueprint $table) {
            $table->dropColumn(['butuh_ttd_pemohon', 'label_ttd_pemohon', 'tampil_nama_pemohon']);
        });
    }
};
