<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    use HasFactory;

    protected $primaryKey = 'title';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
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

        $path = ltrim($this->image_path, '/');
        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, 8);
        }
        if (!str_starts_with($path, 'slideshows/')) {
            $path = 'slideshows/' . $path;
        }
        $dir = trim(dirname($path), '.');
        $file = rawurlencode(basename($path));
        $path = $dir === '' ? $file : $dir . '/' . $file;

        return asset($path);
    }
}
