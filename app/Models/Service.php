<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'url',
        'icon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getIconUrlAttribute(): ?string
    {
        if (!$this->icon) {
            return null;
        }

        $path = ltrim($this->icon, '/');
        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, 8);
        }
        if (!str_starts_with($path, 'services/')) {
            $path = 'services/' . $path;
        }

        return asset($path);
    }
}
