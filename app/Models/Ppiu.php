<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppiu extends Model
{
    protected $table = 'ppiu';
    
    protected $fillable = [
        'nama',
        'no_izin',
        'direktur',
        'alamat',
        'no_telp',
        'terakreditasi',
        'latitude',
        'longitude',
        'maps_url',
        'status',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
