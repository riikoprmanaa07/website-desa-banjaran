<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rw', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_rw', 3);
            $table->string('nama_ketua');
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('jumlah_kk')->default(0);
            $table->integer('jumlah_penduduk')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rw');
    }
};