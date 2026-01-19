<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimKemenhaj extends Model
{
    use HasFactory;

    protected $table = 'tim_kemenhaj';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/tim/' . $this->foto);
        }
        return asset('image/lambang.png');
    }
}
