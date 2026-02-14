<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    use HasFactory;

    protected $table = 'rt';

    protected $fillable = [
        'nomor_rt',
        'rw_id',
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
    public function rw()
    {
        return $this->belongsTo(RW::class);
    }

    // Methods
    public function updateStatistik()
    {
        if ($this->rw) {
            $this->jumlah_kk = Penduduk::where('rt', $this->nomor_rt)
                ->where('rw', $this->rw->nomor_rw)
                ->distinct('no_kk')
                ->count('no_kk');

            $this->jumlah_penduduk = Penduduk::where('rt', $this->nomor_rt)
                ->where('rw', $this->rw->nomor_rw)
                ->count();

            $this->save();
        }
    }

    // Accessors
    public function getNomorRtFormatAttribute()
    {
        return 'RT ' . str_pad($this->nomor_rt, 3, '0', STR_PAD_LEFT);
    }

    public function getRtRwFormatAttribute()
    {
        if ($this->rw) {
            return 'RT ' . str_pad($this->nomor_rt, 3, '0', STR_PAD_LEFT) . ' / RW ' . str_pad($this->rw->nomor_rw, 3, '0', STR_PAD_LEFT);
        }
        return 'RT ' . str_pad($this->nomor_rt, 3, '0', STR_PAD_LEFT);
    }
}