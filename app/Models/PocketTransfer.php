<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PocketTransfer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'from_pocket', 'to_pocket', 'nominal', 'keterangan'];

    protected $casts = [
        'nominal' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    /**
     * Get the user that owns the transfer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the source pocket.
     */
    public function fromPocket()
    {
        return $this->belongsTo(Pocket::class, 'from_pocket');
    }

    /**
     * Get the destination pocket.
     */
    public function toPocket()
    {
        return $this->belongsTo(Pocket::class, 'to_pocket');
    }

    /**
     * Get transfer type label.
     */
    public function getTransferTypeAttribute()
    {
        if ($this->from_pocket === null && $this->to_pocket !== null) {
            return 'Saldo Utama → Pocket';
        } elseif ($this->from_pocket !== null && $this->to_pocket === null) {
            return 'Pocket → Saldo Utama';
        } elseif ($this->from_pocket !== null && $this->to_pocket !== null) {
            return 'Pocket → Pocket';
        }
        return 'Unknown';
    }

    /**
     * Get transfer source label.
     */
    public function getSourceLabelAttribute()
    {
        if ($this->from_pocket === null) {
            return 'Saldo Utama';
        }
        return $this->fromPocket->nama ?? 'Unknown';
    }

    /**
     * Get transfer destination label.
     */
    public function getDestinationLabelAttribute()
    {
        if ($this->to_pocket === null) {
            return 'Saldo Utama';
        }
        return $this->toPocket->nama ?? 'Unknown';
    }
}

