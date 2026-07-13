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
        'nomor_rekening',
        'role',
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

    /**
     * Get the pocket transfers for the user.
     */
    public function pocketTransfers()
    {
        return $this->hasMany(PocketTransfer::class);
    }

    /**
     * Get transfers sent by the user.
     */
    public function transfersSent()
    {
        return $this->hasMany(Transfer::class, 'pengirim_id');
    }

    /**
     * Get transfers received by the user.
     */
    public function transfersReceived()
    {
        return $this->hasMany(Transfer::class, 'penerima_id');
    }

    /**
     * Generate unique account number.
     */
    public static function generateNomorRekening()
    {
        do {
            $nomor = '90' . rand(10000000, 99999999);
        } while (self::where('nomor_rekening', $nomor)->exists());

        return $nomor;
    }
}
