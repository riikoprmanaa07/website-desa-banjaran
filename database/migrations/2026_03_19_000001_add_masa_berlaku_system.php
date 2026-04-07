<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Dua perubahan:
     *
     * 1. template_surat → tambah kolom masa_berlaku_default
     *    Nilai: null = tidak ada masa berlaku, atau string pilihan
     *    (contoh: "1 minggu", "1 bulan", "3 bulan", "6 bulan", "1 tahun")
     *
     * 2. surat → tambah masa_berlaku + berlaku_sampai
     *    masa_berlaku  : durasi aktual surat (bisa sama/berbeda dengan default template)
     *    berlaku_sampai: tanggal akhir, dihitung otomatis di controller
     */
    public function up(): void
    {
        // Tambah kolom default masa berlaku di template
        Schema::table('template_surat', function (Blueprint $table) {
            $table->string('masa_berlaku_default')->nullable()->after('aktif');
            // null = template ini tidak menggunakan masa berlaku
        });

        // Tambah kolom masa berlaku di tabel surat (jika belum ada)
        if (! Schema::hasColumn('surat', 'masa_berlaku')) {
            Schema::table('surat', function (Blueprint $table) {
                $table->string('masa_berlaku')->nullable()->after('keterangan');
                $table->date('berlaku_sampai')->nullable()->after('masa_berlaku');
            });
        }
    }

    public function down(): void
    {
        Schema::table('template_surat', function (Blueprint $table) {
            $table->dropColumn('masa_berlaku_default');
        });

        Schema::table('surat', function (Blueprint $table) {
            $table->dropColumn(['masa_berlaku', 'berlaku_sampai']);
        });
    }
};
