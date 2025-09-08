<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketBandwidth extends Model
{
    use HasFactory;

    protected $fillable = [
        'paket_id',
        'bandwidth_id',
    ];

    public function paket()
    {
        return $this->belongsTo(PaketInternet::class, 'paket_id');
    }

    public function bandwidth()
    {
        return $this->belongsTo(Bandwidth::class, 'bandwidth_id');
    }
}

