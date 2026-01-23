<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPage extends Model
{
    use HasFactory;

    protected $table = 'custom_pages';

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
            return asset('storage/pages/' . $this->cover_image);
        }
        return null;
    }
}
