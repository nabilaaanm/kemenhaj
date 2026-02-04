<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

        $path = ltrim($this->file_path, '/');
        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, 8);
        }
        if (str_starts_with($path, 'lk-pih/')) {
            $path = substr($path, strlen('lk-pih/'));
        }
        if ($path === '' || !Storage::disk('lk_pih')->exists($path)) {
            return null;
        }

        return Storage::disk('lk_pih')->url($path);
    }
}
