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
            $path = ltrim($this->foto, '/');
            if (str_starts_with($path, 'storage/')) {
                $path = substr($path, 8);
            }
            if (!str_starts_with($path, 'tim/')) {
                $path = 'tim/' . $path;
            }
            return asset($path);
        }
        return asset('image/lambang.png');
    }
}
