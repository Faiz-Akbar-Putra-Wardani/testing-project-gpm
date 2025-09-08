<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Transaksi; // <- Import model
use App\Models\Pelanggan; // <- Import Pelanggan untuk ignore no_ktp

class UpdateTransaksi extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $transaksiParam = $this->route('transaksi');

        // Ambil model Transaksi jika bukan objek
        $transaksi = is_object($transaksiParam) ? $transaksiParam : Transaksi::find($transaksiParam);

        $transaksiId = $transaksi?->id;
        $pelangganId = $transaksi?->pelanggan_id;

        return [
            // Data Pelanggan
            'no_ktp' => [
                'sometimes', 'string', 'size:16',
                Rule::unique('pelanggans', 'no_ktp')->ignore($pelangganId)
            ],
            'nama_lengkap'          => 'sometimes|string|max:255',
            'tempat_lahir'          => 'sometimes|string|max:100',
            'tanggal_lahir'         => 'sometimes|date',
            'jenis_kelamin'         => 'sometimes|in:L,P',
            'status_pernikahan'     => 'sometimes|in:Menikah,Belum Menikah',
            'alamat_ktp'            => 'sometimes|string',
            'provinsi_ktp_id'       => 'sometimes|exists:provinsis,id',
            'kabupaten_ktp_id'      => 'sometimes|exists:kabupatens,id',
            'kecamatan_ktp_id'      => 'sometimes|exists:kecamatans,id',
            'kelurahan_ktp_id'      => 'sometimes|exists:kelurahans,id',
            'kodepos_ktp'           => 'nullable|string|max:10',
            'alamat_instalasi'      => 'sometimes|string',
            'provinsi_instalasi_id' => 'sometimes|exists:provinsis,id',
            'kabupaten_instalasi_id'=> 'sometimes|exists:kabupatens,id',
            'kecamatan_instalasi_id'=> 'sometimes|exists:kecamatans,id',
            'kelurahan_instalasi_id'=> 'sometimes|exists:kelurahans,id',
            'kodepos_instalasi'     => 'nullable|string|max:10',
            'pekerjaan'             => 'sometimes|string|max:100',
            'pekerjaan_lainnya'     => 'nullable|string|max:100',
            'jenis_tempat_tinggal'  => 'sometimes|string|max:100',
            'tempat_tinggal_lainnya'=> 'nullable|string|max:100',
            'nomor_telepon'         => 'sometimes|string|max:20',
            'nomor_ponsel'          => 'sometimes|string|max:20',
            'no_fax'                => 'nullable|string|max:20',

            // Data Transaksi
            'no_id_pelanggan' => [
                'sometimes', 'string', 'max:20',
                Rule::unique('transaksis', 'no_id_pelanggan')->ignore($transaksiId)
            ],
            'tanggal_daftar'         => 'sometimes|date',
            'pelanggan_id'           => 'nullable|exists:pelanggans,id',
            'paket_internet_id'      => 'sometimes|exists:paket_internets,id',
            'bandwidth_id'           => 'sometimes|exists:bandwidths,id',
            'bandwidth_manual'       => 'nullable|string|max:100',
            'paket_internet_custom'  => 'nullable|string|max:255',
            'paket_internet_harga_custom'=> 'nullable|numeric|min:0',
            'promosi_id'             => 'nullable|exists:promosis,id',
            'metode_billing'         => 'sometimes|in:Cetak,E-Billing',
            'alamat_penagihan'       => 'sometimes|string',
            'email_penagihan'        => 'sometimes|email|max:255',
            'metode_pembayaran'      => 'sometimes|string|max:100',
            'metode_pembayaran_lainnya'=> 'nullable|string|max:100',
            'nomor_kartu_kredit'     => 'nullable|string|max:50',
            'masa_berlaku_kartu'     => 'nullable|string|max:10',
            'biaya_registrasi'       => 'sometimes|numeric|min:0',
            'biaya_paket_internet'   => 'sometimes|numeric|min:0',
            'biaya_maintenance'      => 'nullable|numeric|min:0',
            'ppn_nominal'            => 'sometimes|numeric|min:0',
            'total_biaya_per_bulan'  => 'sometimes|numeric|min:0',
        ];
    }

    protected function prepareForValidation()
    {
        // Jika user pilih pekerjaan = "Lainnya"
        if ($this->pekerjaan === 'Lainnya' && $this->filled('pekerjaan_lainnya')) {
            $this->merge(['pekerjaan' => $this->pekerjaan_lainnya]);
        }

        // Jika user pilih tempat tinggal = "Lainnya"
        if ($this->jenis_tempat_tinggal === 'Lainnya' && $this->filled('tempat_tinggal_lainnya')) {
            $this->merge(['jenis_tempat_tinggal' => $this->tempat_tinggal_lainnya]);
        }

        // Jika user pilih metode pembayaran = "Lainnya"
        if ($this->metode_pembayaran === 'Lainnya' && $this->filled('metode_pembayaran_lainnya')) {
            $this->merge(['metode_pembayaran' => $this->metode_pembayaran_lainnya]);
        }
    }
}
