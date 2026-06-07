<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        'nama_kemenhaj',
        'kota',
        'lambang',
    ];

    protected static ?self $cached = null;

    public static function current(): self
    {
        if (static::$cached) {
            return static::$cached;
        }

        if (!Schema::hasTable('site_settings')) {
            return static::$cached = static::make(static::defaults());
        }

        $setting = static::query()->first();

        if (!$setting) {
            $setting = static::query()->create(static::defaults());
        }

        return static::$cached = $setting;
    }

    public static function refreshCache(): void
    {
        static::$cached = null;
        static::current();
    }

    public static function defaults(): array
    {
        return [
            'nama_kemenhaj' => 'Kementerian Haji dan Umrah',
            'kota' => 'Kota Cirebon',
            'lambang' => 'lambang.png',
        ];
    }

    public function getLambangUrlAttribute(): string
    {
        $filename = ltrim((string) ($this->lambang ?: 'lambang.png'), '/');

        if (str_starts_with($filename, 'image/')) {
            $filename = substr($filename, strlen('image/'));
        }

        try {
            if ($filename !== '' && Storage::disk('image')->exists($filename)) {
                return Storage::disk('image')->url($filename);
            }
        } catch (\Throwable $e) {
            // Abaikan jika disk production belum tersedia di environment lokal.
        }

        if ($filename !== '' && file_exists(public_path('image/' . $filename))) {
            return asset('image/' . $filename);
        }

        return asset('image/lambang.png');
    }

    public function getTitleSuffixAttribute(): string
    {
        return trim($this->nama_kemenhaj . ' ' . $this->kota);
    }
}
