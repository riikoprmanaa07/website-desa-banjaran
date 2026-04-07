<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom masa_berlaku di tabel surat.
     *
     * masa_berlaku  → durasi yang diisi admin saat buat surat
     *                 contoh: "1 bulan", "2 minggu", "3 bulan"
     *                 Disimpan sebagai string bebas.
     *
     * berlaku_sampai → tanggal akhir masa berlaku (dihitung otomatis
     *                  dari tanggal_surat + masa_berlaku di controller).
     *                  Disimpan agar bisa dipakai query/filter nantinya.
     */
    public function up(): void
    {
        Schema::table('surat', function (Blueprint $table) {
            // Durasi bebas dari admin, contoh: "1 bulan", "2 minggu"
            $table->string('masa_berlaku')->nullable()->after('keterangan');

            // Tanggal akhir berlaku (dihitung otomatis di controller)
            $table->date('berlaku_sampai')->nullable()->after('masa_berlaku');
        });
    }

    public function down(): void
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->dropColumn(['masa_berlaku', 'berlaku_sampai']);
        });
    }
};
