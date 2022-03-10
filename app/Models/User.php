<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public function participations(): HasMany
    {
        return $this->hasMany(Participation::class, 'user_id');
    }

    public function responsibilities(): HasMany
    {
        return $this->hasMany(Responsibility::class, 'user_id');
    }

    public function isAdmin(): bool
    {
        return $this->email == 'florian.kick@googlemail.com' && $this->hasVerifiedEmail();
    }

    public function isResponsible(): bool
    {
        return $this->responsibilities()->count() > 0;
    }
}
