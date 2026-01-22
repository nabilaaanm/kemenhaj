<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteAppearance extends Model
{
    protected $table = 'site_appearances';

    protected $fillable = [
        'primary_color',
        'mode',
    ];
}
