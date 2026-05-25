<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerhakLunas extends Model
{
    protected $table = 'berhak_lunas';

    protected $primaryKey = 'nomor_porsi';

    protected $keyType = 'string';

    public $incrementing = false;
    
    protected $fillable = [
        'nama',
        'nama_ayah',
        'nomor_porsi',
        'status',
        'keterangan',
        'nomor_paspor',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
