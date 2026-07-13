<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['pengirim_id', 'penerima_id', 'pocket_id', 'nominal', 'keterangan', 'status', 'created_at'];

    protected $casts = [
        'nominal' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    /**
     * Get the sender of the transfer.
     */
    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    /**
     * Get the recipient of the transfer.
     */
    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }

    /**
     * Get the pocket used for transfer (if from pocket).
     */
    public function pocket()
    {
        return $this->belongsTo(Pocket::class);
    }

    /**
     * Get transfer source label (Main Balance or Pocket name).
     */
    public function getSourceLabelAttribute()
    {
        if ($this->pocket_id === null) {
            return 'Saldo Utama';
        }
        return $this->pocket->nama ?? 'Unknown';
    }
}

