<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('template_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_template'); // Surat Keterangan, SKCK, dll
            $table->string('jenis_surat'); // Kategori surat
            $table->text('kop_surat'); // Header surat (nama desa, alamat)
            $table->string('judul_surat'); // SURAT KETERANGAN DOMISILI
            $table->text('pembuka'); // Yang bertanda tangan di bawah ini...
            $table->text('isi_template'); // Template dengan [PLACEHOLDER]
            $table->text('penutup')->nullable(); // Demikian surat ini dibuat...
            $table->string('penandatangan_jabatan'); // Kepala Desa
            $table->string('penandatangan_nama'); // Nama Kepala Desa
            $table->string('penandatangan_nip')->nullable(); // NIP
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('template_surat');
    }
};