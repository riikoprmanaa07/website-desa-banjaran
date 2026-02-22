<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';

    protected $fillable = [
        'penduduk_id',
        'template_surat_id',
        'nomor_surat',
        'jenis_surat',
        'tanggal_surat',
        'keperluan',
        'keterangan',
        'isi_surat',
        'penandatangan',  // ✅ INI YANG KURANG — penyebab error utama
        'status',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function templateSurat()
    {
        return $this->belongsTo(TemplateSurat::class);
    }
}