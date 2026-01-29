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
        'baris',
        'slot',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'baris' => 'integer',
        'slot' => 'integer',
    ];

    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('tim/' . $this->foto);
        }
        return asset('image/lambang.png');
    }
}
