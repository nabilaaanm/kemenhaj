<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public const MAX_ADMIN_ACCOUNTS = 2;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'email';

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAuthIdentifierName(): string
    {
        return 'email';
    }

    public static function adminCount(): int
    {
        return static::where('role', 'admin')->count();
    }

    public static function canCreateAdmin(): bool
    {
        return static::adminCount() < self::MAX_ADMIN_ACCOUNTS;
    }

    public static function roleOptions(bool $includeAdmin = false): array
    {
        $roles = [
            'kontributor' => 'Kontributor',
            'editor' => 'Editor',
        ];

        if ($includeAdmin) {
            return ['admin' => 'Admin'] + $roles;
        }

        return $roles;
    }
}
