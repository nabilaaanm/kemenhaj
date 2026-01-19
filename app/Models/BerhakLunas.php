<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerhakLunas extends Model
{
    protected $table = 'berhak_lunas';
    
    protected $fillable = [
        'nama',
        'nomor_porsi',
        'provinsi',
        'status',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
