<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Regulasi extends Model
{
    public const CATEGORY_UU = 'uu';
    public const CATEGORY_PERPRES = 'perpres';
    public const CATEGORY_KEPPRES = 'keppres';
    public const CATEGORY_KEPMEN = 'kepmen';
    public const CATEGORY_PERMEN = 'permen';
    public const CATEGORY_LAINNYA = 'lainnya';

    protected $table = 'regulasi';

    protected $primaryKey = ['title', 'regulation_date'];

    public $incrementing = false;

    protected $fillable = [
        'title',
        'description',
        'category',
        'regulation_date',
        'file_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'regulation_date' => 'date',
    ];

    protected function setKeysForSaveQuery($query)
    {
        if (! is_array($this->primaryKey)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($this->primaryKey as $keyName) {
            $query->where(
                $keyName,
                '=',
                $this->getOriginal($keyName) ?? $this->getAttribute($keyName)
            );
        }

        return $query;
    }

    public static function categoryOptions(): array
    {
        return [
            self::CATEGORY_UU => 'Undang Undang',
            self::CATEGORY_PERPRES => 'Peraturan Presiden',
            self::CATEGORY_KEPPRES => 'Keputusan Presiden',
            self::CATEGORY_KEPMEN => 'Keputusan Menteri',
            self::CATEGORY_PERMEN => 'Peraturan Menteri',
            self::CATEGORY_LAINNYA => 'Peraturan Lainnya',
        ];
    }

    public static function categoryKeys(): array
    {
        return array_keys(self::categoryOptions());
    }

    public static function filterCategories(): array
    {
        return ['all' => 'Semua'] + self::categoryOptions();
    }

    public function getBadgeTextAttribute()
    {
        $badges = [
            self::CATEGORY_UU => 'UNDANG UNDANG',
            self::CATEGORY_PERPRES => 'PERATURAN PRESIDEN',
            self::CATEGORY_KEPPRES => 'KEPUTUSAN PRESIDEN',
            self::CATEGORY_KEPMEN => 'KEPUTUSAN MENTERI',
            self::CATEGORY_PERMEN => 'PERATURAN MENTERI',
            self::CATEGORY_LAINNYA => 'PERATURAN LAINNYA',
        ];

        return $badges[$this->category] ?? 'PERATURAN LAINNYA';
    }

    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            $path = ltrim($this->file_path, '/');
            if (str_starts_with($path, 'storage/')) {
                $path = substr($path, 8);
            }
            if (str_starts_with($path, 'regulations/')) {
                $path = substr($path, strlen('regulations/'));
            }
            if ($path !== '' && Storage::disk('regulations')->exists($path)) {
                return Storage::disk('regulations')->url($path);
            }
        }
        return null;
    }

    public function routeParams(): array
    {
        return [
            'judul' => self::encodeRouteTitle($this->title),
            'tanggal' => $this->regulation_date->format('Y-m-d'),
        ];
    }

    public static function encodeRouteTitle(string $title): string
    {
        return rtrim(strtr(base64_encode($title), '+/', '-_'), '=');
    }

    public static function decodeRouteTitle(string $judul): string
    {
        $judul = urldecode($judul);

        $base64 = strtr($judul, '-_', '+/');
        $padding = strlen($base64) % 4;
        if ($padding) {
            $base64 .= str_repeat('=', 4 - $padding);
        }

        $decoded = base64_decode($base64, true);
        if ($decoded !== false && mb_check_encoding($decoded, 'UTF-8')) {
            return $decoded;
        }

        return $judul;
    }
}
