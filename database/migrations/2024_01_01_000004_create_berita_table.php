<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('konten');
            $table->string('gambar')->nullable();
            $table->string('kategori');
            $table->foreignId('admin_user_id')->constrained('admin_users')->onDelete('cascade');
            $table->enum('status', ['Draft', 'Published'])->default('Draft');
            $table->integer('views')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};