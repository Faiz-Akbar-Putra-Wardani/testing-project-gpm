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
            'nomor_telepon'         => 'nullable|string|max:20',
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

    public function messages(): array
        {
            return [
                // Data Pelanggan
                'no_ktp.required'     => 'Nomor KTP wajib diisi.',
                'no_ktp.size'         => 'Nomor KTP harus 16 digit.',
                'no_ktp.unique'       => 'Nomor KTP sudah terdaftar.',

                'nama_lengkap.required'   => 'Nama lengkap wajib diisi.',
                'tempat_lahir.required'   => 'Tempat lahir wajib diisi.',
                'tanggal_lahir.required'  => 'Tanggal lahir wajib diisi.',
                'jenis_kelamin.required'  => 'Jenis kelamin wajib dipilih.',
                'status_pernikahan.required' => 'Status pernikahan wajib dipilih.',

                'alamat_ktp.required'     => 'Alamat KTP wajib diisi.',
                'provinsi_ktp_id.required'=> 'Provinsi KTP wajib dipilih.',
                'kabupaten_ktp_id.required'=> 'Kabupaten/Kota KTP wajib dipilih.',
                'kecamatan_ktp_id.required'=> 'Kecamatan KTP wajib dipilih.',
                'kelurahan_ktp_id.required'=> 'Kelurahan KTP wajib dipilih.',

                'alamat_instalasi.required' => 'Alamat instalasi wajib diisi.',
                'provinsi_instalasi_id.required'=> 'Provinsi instalasi wajib dipilih.',
                'kabupaten_instalasi_id.required'=> 'Kabupaten/Kota instalasi wajib dipilih.',
                'kecamatan_instalasi_id.required'=> 'Kecamatan instalasi wajib dipilih.',
                'kelurahan_instalasi_id.required'=> 'Kelurahan instalasi wajib dipilih.',

                'pekerjaan.required'     => 'Pekerjaan wajib diisi.',
                'jenis_tempat_tinggal.required' => 'Jenis tempat tinggal wajib dipilih.',
                'nomor_ponsel.required'  => 'Nomor ponsel wajib diisi.',

                // Data Transaksi
                'no_id_pelanggan.required' => 'Nomor ID Pelanggan wajib diisi.',
                'no_id_pelanggan.unique'   => 'Nomor ID Pelanggan sudah terdaftar.',
                'tanggal_daftar.required'  => 'Tanggal daftar wajib diisi.',

                'paket_internet_id.required' => 'Paket internet wajib dipilih.',
                'paket_internet_custom.string' => 'Paket internet custom harus berupa teks.',
                'paket_internet_harga_custom.numeric' => 'Harga paket internet custom harus berupa angka.',

                'bandwidth_id.required'   => 'Bandwidth wajib dipilih.',
                'bandwidth_manual.string' => 'Bandwidth manual harus berupa teks.',
                'promosi_id.exists'       => 'Promosi yang dipilih tidak valid.',

                'metode_billing.required'   => 'Metode billing wajib dipilih.',
                'alamat_penagihan.required' => 'Alamat penagihan wajib diisi.',
                'email_penagihan.required'  => 'Email penagihan wajib diisi.',
                'email_penagihan.email'     => 'Email penagihan harus valid.',

                'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih.',
                'nomor_kartu_kredit.string'  => 'Nomor kartu kredit harus berupa teks.',
                'masa_berlaku_kartu.string'  => 'Masa berlaku kartu harus berupa teks.',

                'biaya_registrasi.required'     => 'Biaya registrasi wajib diisi.',
                'biaya_paket_internet.required' => 'Biaya paket internet wajib diisi.',
                'biaya_maintenance.numeric'     => 'Biaya maintenance harus berupa angka.',
                'ppn_nominal.required'          => 'PPN wajib diisi.',
                'total_biaya_per_bulan.required'=> 'Total biaya per bulan wajib diisi.',
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
