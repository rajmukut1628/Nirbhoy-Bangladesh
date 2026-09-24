<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',

        'role',

        'division_id',
        'district_id',
        'upazila_id',
        'union_id',

        'preferred_language',
        'status',

        'is_verified',

        'suspended_until',
        'blocked_reason',

        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
            'suspended_until' => 'datetime',
            'last_login_at' => 'datetime',
        ];
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }

    public function union(): BelongsTo
    {
        return $this->belongsTo(Union::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSeniorModerator(): bool
    {
        return $this->role === 'senior_moderator';
    }

    public function isModerator(): bool
    {
        return $this->role === 'moderator';
    }

    public function isNormalUser(): bool
    {
        return $this->role === 'user';
    }

    public function canModerate(): bool
    {
        return in_array(
            $this->role,
            ['moderator', 'senior_moderator', 'admin'],
            true
        );
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isBlocked(): bool
    {
        return $this->status === 'blocked';
    }

    public function isSuspended(): bool
    {
        if ($this->status !== 'suspended') {
            return false;
        }

        if ($this->suspended_until === null) {
            return true;
        }

        return $this->suspended_until->isFuture();
    }

    public function usesBangla(): bool
    {
        return $this->preferred_language === 'bn';
    }
}