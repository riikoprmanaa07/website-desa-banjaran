<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenSurat extends Model
{
    use HasFactory;

    protected $table = 'dokumen_surat';
    protected $guarded = ['id']; // Membiarkan semua kolom bisa diisi (mass assignable) kecuali ID

    // Relasi: Dokumen ini milik satu Surat
    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
}