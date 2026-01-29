<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regulation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'regulation_date',
        'file_path',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'regulation_date' => 'date',
    ];

    // Accessor for badge text based on category
    public function getBadgeTextAttribute()
    {
        $badges = [
            'uu' => 'UNDANG UNDANG',
            'perpres' => 'PERATURAN PRESIDEN',
            'lainnya' => 'PERATURAN LAINNYA',
        ];

        return $badges[$this->category] ?? 'PERATURAN LAINNYA';
    }

    // Accessor for file URL
    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            $path = ltrim($this->file_path, '/');
            if (str_starts_with($path, 'storage/')) {
                $path = substr($path, 8);
            }
            if (!str_starts_with($path, 'regulations/')) {
                $path = 'regulations/' . $path;
            }
            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }
        return null;
    }
}
