<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->foreignId('template_surat_id')->nullable()->after('jenis_surat')->constrained('template_surat')->onDelete('set null');
            $table->text('isi_surat')->nullable()->after('keterangan'); // Hasil generate dari template
        });
    }

    public function down(): void
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->dropForeign(['template_surat_id']);
            $table->dropColumn(['template_surat_id', 'isi_surat']);
        });
    }
};