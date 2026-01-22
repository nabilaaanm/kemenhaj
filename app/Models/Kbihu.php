<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kbihu extends Model
{
    protected $table = 'kbihu';
    
    protected $fillable = [
        'nama',
        'alamat',
        'tahun_berdiri',
        'nama_pimpinan',
        'telp',
        'latitude',
        'longitude',
        'maps_url',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
