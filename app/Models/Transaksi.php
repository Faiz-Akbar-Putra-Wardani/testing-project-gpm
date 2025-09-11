<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_id_pelanggan',
        'tanggal_daftar',
        'pelanggan_id',
        'paket_internet_id',
        'bandwidth_id',
        'bandwidth_manual',
        'paket_internet_custom',
        'paket_internet_harga_custom',
        'promosi_id',
        'metode_billing',
        'alamat_penagihan',
        'email_penagihan',
        'metode_pembayaran',
        'nomor_kartu_kredit',
        'masa_berlaku_kartu',
        'biaya_registrasi',
        'biaya_paket_internet',
        'biaya_maintenance',
        'ppn_persen',
        'ppn_nominal',
        'total_biaya_per_bulan',
    ];

        public static function generatePelangganId()
        {
            $last = self::orderBy('id', 'desc')->first();

            if ($last && $last->no_id_pelanggan) {
                $lastNumber = (int) substr($last->no_id_pelanggan, 5);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            return 'IDGPM' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
        }


    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function paket()
    {
        return $this->belongsTo(PaketInternet::class, 'paket_internet_id');
    }

    public function promosi()
    {
        return $this->belongsTo(Promosi::class, 'promosi_id');
    }

    public function bandwidth()
    {
        return $this->belongsTo(Bandwidth::class, 'bandwidth_id');
    }

    // 🔹 Static data untuk metode pembayaran
    public static function metodePembayaranOptions(): array
    {
        return [
            'Transfer',
            'Auto Debit Kartu Kredit',
            'BCA Card',
            'Master Card',
            'Visa Card',
            'Lainnya',
        ];
    }
}
