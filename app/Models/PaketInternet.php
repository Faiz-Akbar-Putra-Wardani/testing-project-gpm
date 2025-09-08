<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketInternet extends Model
{
    use HasFactory;
    protected $fillable = [
        'paket_internet',
        'harga_bulanan',
        'is_active',
    ];

    public const Paket_Internet = [
        'Silver',
        'Gold',
        'Platinum',
        'Lainnya',
    ];

     public function bandwidths()
    {
        return $this->belongsToMany(
            Bandwidth::class,
            'paket_bandwidths',
            'paket_internet_id',
            'bandwidth_id'
        );
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'paket_internet_id');
    }
}
