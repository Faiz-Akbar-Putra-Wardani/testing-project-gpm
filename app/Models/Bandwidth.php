<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bandwidth extends Model
{
    use HasFactory;

    protected $table = 'bandwidths';

    protected $fillable = [
        'nilai',
    ];

    public static function Options()
    {
        return [
            '5 Mbps',
            '10 Mbps',
            '20 Mbps',
        ];
    }


    public function paketInternet()
    {
        return $this->belongsToMany(PaketInternet::class, 'paket_bandwidth', 'bandwidth_id', 'paket_internet_id');
    }


}
