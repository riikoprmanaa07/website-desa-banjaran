<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RW extends Model
{
    use HasFactory;

    protected $table = 'rw';

    protected $fillable = [
        'nomor_rw',
        'nama_ketua',
        'no_hp',
        'alamat',
        'jumlah_kk',
        'jumlah_penduduk',
    ];

    protected $casts = [
        'jumlah_kk' => 'integer',
        'jumlah_penduduk' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function rt()
{
    return $this->hasMany(RT::class, 'rw_id', 'id');
}

    // Methods
    public function updateStatistik()
    {
        $this->jumlah_kk = Penduduk::where('rw', $this->nomor_rw)
            ->distinct('no_kk')
            ->count('no_kk');

        $this->jumlah_penduduk = Penduduk::where('rw', $this->nomor_rw)->count();

        $this->save();
    }

    // Accessors
    public function getNomorRwFormatAttribute()
    {
        return 'RW ' . str_pad($this->nomor_rw, 3, '0', STR_PAD_LEFT);
    }
}