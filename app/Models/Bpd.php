<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bpd extends Model
{
    use HasFactory;

    protected $table = 'bpd';

    protected $fillable = [
        'jabatan',
        'nama',
        'nip',
        'pendidikan',
        'no_hp',
        'foto',
        'urutan',
        'status',
    ];

    protected $casts = [
        'urutan' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
