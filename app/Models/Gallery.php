<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    // Get image URL (either from file_path or url)
    public function getImageUrlAttribute()
    {
        if ($this->file_path) {
            // Check if file exists in public disk
            if (Storage::disk('public')->exists($this->file_path)) {
                return asset('storage/' . $this->file_path);
            }
            // If file doesn't exist but path is set, return placeholder
            return 'https://via.placeholder.com/400x300/ECB176/FFFFFF?text=File+Not+Found';
        }
        return $this->url ?: 'https://via.placeholder.com/400x300/ECB176/FFFFFF?text=No+Image';
    }

    // Get video URL
    public function getVideoUrlAttribute()
    {
        if ($this->file_path) {
            if (Storage::disk('public')->exists($this->file_path)) {
                return asset('storage/' . $this->file_path);
            }
            return $this->url;
        }
        return $this->url;
    }

    // Get thumbnail URL
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            if (Storage::disk('public')->exists($this->thumbnail)) {
                return asset('storage/' . $this->thumbnail);
            }
        }
        if ($this->file_path && $this->type === 'foto') {
            return $this->getImageUrlAttribute();
        }
        return $this->url;
    }

    public function getVideoThumbnailUrlAttribute()
    {
        if ($this->thumbnail && Storage::disk('public')->exists($this->thumbnail)) {
            return asset('storage/' . $this->thumbnail);
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
