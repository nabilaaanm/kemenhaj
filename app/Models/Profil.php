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
        'sejarah_judul',
        'sejarah_subjudul',
        'sejarah_konten',
        'visi_konten',
        'misi_konten',
        'alamat',
        'alamat_keterangan',
        'telepon',
        'telepon_alt',
        'email',
        'website',
        'maps_url',
        'maps_embed',
        'maps_embed_kbihu',
        'maps_embed_ppiu',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'whatsapp',
    ];

    public function getStrukturGambarUrlAttribute()
    {
        if ($this->struktur_gambar) {
            $path = ltrim($this->struktur_gambar, '/');
            if (str_starts_with($path, 'storage/')) {
                $path = substr($path, 8);
            }
            if (!str_starts_with($path, 'struktur/')) {
                $path = 'struktur/' . $path;
            }
            return asset($path);
        }
        return asset('image/struktur-organisasi.png');
    }
}
