<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge',
        'title',
        'description',
        'button_text',
        'button_url',
        'image_path',
        'order',
        'is_active',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return '';
        }

        return asset('storage/slideshows/' . rawurlencode($this->image_path));
    }
}
