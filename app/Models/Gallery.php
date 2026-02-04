<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'category',
        'file_path',
        'url',
        'thumbnail',
        'duration',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    private function normalizePublicPath(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        $path = ltrim($path, '/');
        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, 8);
        }

        return $path;
    }

    // Get image URL (either from file_path or url)
    public function getImageUrlAttribute()
    {
        if ($this->file_path) {
            $path = $this->normalizePublicPath($this->file_path);
            if ($path) {
                return asset($path);
            }
        }
        return $this->url ?: 'https://via.placeholder.com/400x300/ECB176/FFFFFF?text=No+Image';
    }

    // Get video URL
    public function getVideoUrlAttribute()
    {
        if ($this->file_path) {
            $path = $this->normalizePublicPath($this->file_path);
            if ($path) {
                return asset($path);
            }
        }
        return $this->url;
    }

    // Get thumbnail URL
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            $path = $this->normalizePublicPath($this->thumbnail);
            if ($path) {
                return asset($path);
            }
        }
        if ($this->file_path && $this->type === 'foto') {
            return $this->getImageUrlAttribute();
        }
        return $this->url;
    }

    public function getVideoThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            $path = $this->normalizePublicPath($this->thumbnail);
            if ($path) {
                return asset($path);
            }
        }

        if (!$this->url) {
            return $this->getImageUrlAttribute();
        }

        if (strpos($this->url, 'youtube.com') !== false || strpos($this->url, 'youtu.be') !== false) {
            $videoId = '';
            if (strpos($this->url, 'youtube.com/watch?v=') !== false) {
                $parts = parse_url($this->url);
                parse_str($parts['query'] ?? '', $query);
                $videoId = $query['v'] ?? '';
            } elseif (strpos($this->url, 'youtu.be/') !== false) {
                $parts = parse_url($this->url);
                $videoId = trim($parts['path'] ?? '', '/');
            }
            if ($videoId) {
                return 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg';
            }
        }

        return $this->getImageUrlAttribute();
    }
}
