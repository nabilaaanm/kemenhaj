<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostingCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];
}
