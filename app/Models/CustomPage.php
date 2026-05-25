<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPage extends Model
{
    use HasFactory;

    protected $table = 'custom_pages';

    protected $primaryKey = 'slug';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'title',
        'slug',
        'group',
        'cover_image',
        'description',
        'content',
        'contributor',
        'editor',
        'source',
        'photographer',
        'other_info',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function getCoverUrlAttribute(): ?string
    {
        if ($this->cover_image) {
            $path = ltrim($this->cover_image, '/');
            if (str_starts_with($path, 'storage/')) {
                $path = substr($path, 8);
            }
            if (!str_starts_with($path, 'pages/')) {
                $path = 'pages/' . $path;
            }
            return asset($path);
        }
        return null;
    }
}
