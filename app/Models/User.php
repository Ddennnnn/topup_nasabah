<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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

    /**
     * Get the pockets for the user.
     */
    public function pockets()
    {
        return $this->hasMany(Pocket::class);
    }

    /**
     * Get the topups for the user.
     */
    public function topups()
    {
        return $this->hasMany(Topup::class);
    }

    /**
     * Get total saldo from all pockets.
     */
    public function getTotalSaldoAttribute()
    {
        return $this->pockets()->sum('saldo');
    }

    /**
     * Get total topup amount.
     */
    public function getTotalTopupAttribute()
    {
        return $this->topups()->where('status', 'SUCCESS')->sum('nominal');
    }
}
