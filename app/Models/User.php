<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
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
        'nombre', // minimal change.
        'dni', // minimal change.
        'fecha_nacimiento', // minimal change.
        'domicilio', // minimal change.
        'telefono', // minimal change.
        'role', // minimal change.
        'profile_locked', // minimal change.
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
        'fecha_nacimiento' => 'date', // minimal change.
        'profile_locked' => 'boolean', // minimal change.
    ];

    public function getIsAdminAttribute(): bool
    {
        // minimal change.
        return $this->role === 'admin';
    }

    public function persona(): HasOne
    {
        return $this->hasOne(Persona::class);
    }
}
