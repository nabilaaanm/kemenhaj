<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppiu extends Model
{
    protected $table = 'ppiu';
    
    protected $fillable = [
        'nama',
        'no_izin',
        'alamat',
        'status',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
