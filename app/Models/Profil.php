<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profil';

    protected $fillable = [
        'struktur_organisasi',
        'struktur_subjudul',
        'struktur_gambar',
        'alamat',
        'alamat_keterangan',
        'telepon',
        'telepon_alt',
        'email',
        'website',
        'maps_url',
        'maps_embed',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
    ];

    public function getStrukturGambarUrlAttribute()
    {
        if ($this->struktur_gambar) {
            return asset('storage/struktur/' . $this->struktur_gambar);
        }
        return asset('image/struktur-organisasi.png');
    }
}
