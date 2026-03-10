<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('surat', function (Blueprint $table) {
        $table->string('file_dokumen')->nullable()->after('keperluan');
        $table->enum('jenis_dokumen', ['KTP', 'KK'])->nullable()->after('file_dokumen');
    });
}

public function down(): void
{
    Schema::table('surat', function (Blueprint $table) {
        $table->dropColumn(['file_dokumen', 'jenis_dokumen']);
    });
}

};
