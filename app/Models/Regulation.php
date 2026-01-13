<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
            if (Storage::disk('public')->exists($this->file_path)) {
                return asset('storage/' . $this->file_path);
            }
        }
        return null;
    }
}
