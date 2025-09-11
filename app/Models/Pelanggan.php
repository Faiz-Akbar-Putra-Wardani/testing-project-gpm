<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';

    protected $fillable = [
        'no_ktp',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_pernikahan',
        'alamat_ktp',
        'provinsi_ktp_id',
        'kabupaten_ktp_id',
        'kecamatan_ktp_id',
        'kelurahan_ktp_id',
        'kodepos_ktp',
        'alamat_instalasi',
        'provinsi_instalasi_id',
        'kabupaten_instalasi_id',
        'kecamatan_instalasi_id',
        'kelurahan_instalasi_id',
        'kodepos_instalasi',
        'pekerjaan',
        'jenis_tempat_tinggal',
        'nomor_telepon',
        'nomor_ponsel',
        'no_fax'
    ];

    public static function pekerjaanOptions(): array
    {
        return [
            'Wiraswasta' => 'Wiraswasta',
            'Karyawan' => 'Karyawan',
            'Ibu Rumah Tangga' => 'Ibu Rumah Tangga',
            'Lainnya' => 'Lainnya',
        ];
    }

    public static function tempatTinggalOptions(): array
    {
        return [
            'Apartemen' => 'Apartemen',
            'Rumah' => 'Rumah',
            'Lainnya' => 'Lainnya',
        ];
    }


    public function provinsiKtp()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_ktp_id');
    }

    public function kabupatenKtp()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_ktp_id');
    }

    public function kecamatanKtp()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_ktp_id');
    }

    public function kelurahanKtp()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_ktp_id');
    }

    public function provinsiInstalasi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_instalasi_id');
    }

    public function kabupatenInstalasi()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_instalasi_id');
    }

    public function kecamatanInstalasi()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_instalasi_id');
    }

    public function kelurahanInstalasi()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_instalasi_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'pelanggan_id');
    }
}
