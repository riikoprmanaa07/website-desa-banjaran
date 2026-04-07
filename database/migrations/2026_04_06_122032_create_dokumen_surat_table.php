<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Buat tabel dokumen_surat
        Schema::create('dokumen_surat', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel surat (cascade berarti jika surat dihapus, dokumennya ikut terhapus)
            $table->foreignId('surat_id')->constrained('surat')->onDelete('cascade');
            $table->string('file_path'); 
            $table->string('nama_file_asli'); // Menyimpan nama asli file (contoh: KTP_Budi.pdf)
            $table->timestamps();
        });

        // 2. Hapus kolom lama dari tabel surat
        Schema::table('surat', function (Blueprint $table) {
            // Pastikan nama kolom sesuai dengan migration kamu sebelumnya
            $table->dropColumn(['file_dokumen', 'jenis_dokumen']);
        });
    }

    public function down(): void
    {
        // Kembalikan ke semula jika di-rollback
        Schema::dropIfExists('dokumen_surat');
        
        Schema::table('surat', function (Blueprint $table) {
            $table->string('file_dokumen')->nullable()->after('keperluan');
            $table->enum('jenis_dokumen', ['KTP', 'KK'])->nullable()->after('file_dokumen');
        });
    }
};