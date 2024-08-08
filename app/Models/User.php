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

    protected $admin_emails = [
        'maximilian.hofstetter@gmx.net',
        'florian.kick@googlemail.com'
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
        return in_array($this->email, $this->admin_emails) && $this->hasVerifiedEmail();
    }

    public function isResponsible(): bool
    {
        return $this->responsibilities()->count() > 0;
    }
}
