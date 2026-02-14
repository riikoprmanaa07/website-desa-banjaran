<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';

    protected $fillable = [
        'nomor_surat',
        'jenis_surat',
        'penduduk_id',
        'keperluan',
        'tanggal_surat',
        'penandatangan',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }

    public function scopeDiproses($query)
    {
        return $query->where('status', 'Diproses');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'Selesai');
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'Pending' => 'bg-yellow-100 text-yellow-800',
            'Diproses' => 'bg-blue-100 text-blue-800',
            'Selesai' => 'bg-green-100 text-green-800',
            'Ditolak' => 'bg-red-100 text-red-800',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }
}