<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HajiJamaah extends Model
{
    protected $table = 'haji_jamaahs';

    protected $primaryKey = 'nomor_porsi';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'nomor_porsi',
        'nama',
        'pendidikan',
        'kbihu',
        'alamat',
        'kelurahan',
        'kecamatan',
        'usia',
        'jenis_kelamin',
        'tahun_keberangkatan',
    ];

    protected $casts = [
        'usia' => 'integer',
        'tahun_keberangkatan' => 'integer',
    ];
}
