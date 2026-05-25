<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostingKategori extends Model
{
    protected $table = 'posting_kategori';

    protected $primaryKey = 'slug';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'slug',
    ];
}
