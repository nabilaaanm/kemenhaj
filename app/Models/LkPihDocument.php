<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LkPihDocument extends Model
{
    protected $table = 'lk_pih_documents';

    protected $fillable = [
        'type',
        'title',
        'description',
        'document_date',
        'file_path',
        'order',
        'is_active',
    ];

    protected $casts = [
        'document_date' => 'date',
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getFileUrlAttribute(): ?string
    {
        if (!$this->file_path) {
            return null;
        }

        return asset($this->file_path);
    }
}
