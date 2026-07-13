<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pocket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama', 'warna', 'saldo'];

    protected $casts = [
        'saldo' => 'decimal:2',
    ];

    /**
     * Get the user that owns the pocket.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

