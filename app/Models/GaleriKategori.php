<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriKategori extends Model
{
    protected $table = 'galeri_kategori';

    protected $primaryKey = ['type', 'name'];

    public $incrementing = false;

    protected $fillable = [
        'type',
        'name',
    ];
}
