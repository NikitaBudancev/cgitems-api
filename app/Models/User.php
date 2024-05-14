<?php

namespace App\Models;

use App\Contracts\Media\MediaFileContract;
use App\Traits\Media\HasAvatarFile;
use App\Traits\Media\HasMediaFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property $id
 * @property $first_name
 * @property $last_name
 * @property $email
 * @property $nickname
 * @property $is_verified
 * @property $initials
 * @property $email_verification_token
 * @property $email_verified_at
 */
class User extends Authenticatable implements MediaFileContract
{
    use HasApiTokens;
    use HasAvatarFile;
    use HasFactory;
    use HasMediaFile;
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'nickname',
        'email_verified_at',
        'email_verification_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getRouteKeyName(): string
    {
        return 'nickname';
    }

    public function info(): HasOne
    {
        return $this->hasOne(UserInfo::class);
    }

    public function role()
    {
        return $this->roles();
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function getIsVerifiedAttribute(): bool
    {
        return (bool) $this->email_verified_at;
    }

    public function getInitialsAttribute(): string
    {
        return mb_substr($this->first_name, 0, 1) . mb_substr($this->last_name, 0, 1);
    }
}
