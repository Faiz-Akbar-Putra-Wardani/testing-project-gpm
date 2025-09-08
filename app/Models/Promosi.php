<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promosi extends Model
{
    use HasFactory;
    protected $table = 'promosis';
    protected $fillable = [
        'kode_promosi',
        'nama_program_promosi',
        'periode_mulai',
        'periode_selesai',
        'note',
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'promosi_id');
    }

}
