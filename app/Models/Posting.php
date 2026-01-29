<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content',
        'cover_image',
        'editor_name',
        'contributor_name',
        'photographer_name',
        'writer_name',
        'location',
        'source',
        'published_at',
        'views',
        'is_active',
    ];

    protected $casts = [
        'published_at' => 'date',
        'views' => 'integer',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(PostingCategory::class, 'category_id');
    }

    public function getCoverUrlAttribute()
    {
        if (!$this->cover_image) {
            return '';
        }

        $path = ltrim($this->cover_image, '/');
        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, 8);
        }
        if (!str_starts_with($path, 'postings/')) {
            $path = 'postings/' . $path;
        }
        $dir = trim(dirname($path), '.');
        $file = rawurlencode(basename($path));
        $path = $dir === '' ? $file : $dir . '/' . $file;

        return asset($path);
    }
}
