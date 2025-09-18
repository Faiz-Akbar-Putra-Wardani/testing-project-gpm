<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksi extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Data Pelanggan
            'no_ktp'                => 'required|string|size:16|unique:pelanggans,no_ktp',
            'nama_lengkap'          => 'required|string|max:255',
            'tempat_lahir'          => 'required|string|max:100',
            'tanggal_lahir'         => 'required|date',
            'jenis_kelamin'         => 'required|in:L,P',
            'status_pernikahan'     => 'required|in:Menikah,Belum Menikah',

            'alamat_ktp'            => 'required|string',
            'provinsi_ktp_id'       => 'required|exists:provinsis,id',
            'kabupaten_ktp_id'      => 'required|exists:kabupatens,id',
            'kecamatan_ktp_id'      => 'required|exists:kecamatans,id',
            'kelurahan_ktp_id'      => 'required|exists:kelurahans,id',
            'kodepos_ktp'           => 'required|string|max:10',

            'alamat_instalasi'      => 'required|string',
            'provinsi_instalasi_id' => 'required|exists:provinsis,id',
            'kabupaten_instalasi_id'=> 'required|exists:kabupatens,id',
            'kecamatan_instalasi_id'=> 'required|exists:kecamatans,id',
            'kelurahan_instalasi_id'=> 'required|exists:kelurahans,id',
            'kodepos_instalasi'     => 'required|string|max:10',

            'pekerjaan'             => 'required|string|max:100',
            'pekerjaan_lainnya'     => 'required_if:pekerjaan,Lainnya|string|max:100',
            'jenis_tempat_tinggal'  => 'required|string|max:100',
            'tempat_tinggal_lainnya' => 'required_if:jenis_tempat_tinggal,Lainnya|string|max:100',

            'nomor_telepon'         => 'nullable|string|max:20',
            'nomor_ponsel'          => 'required|string|max:20',
            'no_fax'                => 'nullable|string|max:20',

            // Data Transaksi
            'no_id_pelanggan'       => 'required|string|max:20|unique:transaksis,no_id_pelanggan',
            'tanggal_daftar'        => 'required|date',
            'pelanggan_id'          => 'nullable|exists:pelanggans,id',

            'paket_internet_id'     => 'required',
            'nama_paket'            => 'required_if:paket_internet_id,Lainnya|string|max:150',
            'harga_bulanan'         => 'required_if:paket_internet_id,Lainnya|numeric|min:0',

            'bandwidth_id'          => 'required|string',
            'nilai'                 => 'required_if:bandwidth_id,Lainnya|string|max:100',


            'promosi_id'            => 'nullable|exists:promosis,id',

            'metode_billing'        => 'required|in:Cetak,E-Billing',
            'alamat_penagihan'      => 'required|string',
            'email_penagihan'       => 'required|email:rfc|max:255',

            'metode_pembayaran'         => 'required|string|max:100',
            'metode_pembayaran_lainnya' => 'nullable|string|max:100',

            'nomor_kartu_kredit'    => 'required|string|max:50',
            'masa_berlaku_kartu'    => 'required|string|max:10',

            'biaya_registrasi'      => 'required|numeric|min:0',
            'biaya_paket_internet'  => 'required|numeric|min:0',
            'biaya_maintenance'     => 'required|numeric|min:0',
            'ppn_nominal'           => 'required|numeric|min:0',
            'total_biaya_per_bulan' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'no_ktp.required'    => 'Nomor KTP wajib diisi.',
            'no_ktp.size'        => 'Nomor KTP harus 16 digit.',
            'no_ktp.unique'      => 'Nomor KTP sudah terdaftar.',

            'nama_lengkap.required'  => 'Nama lengkap wajib diisi.',
            'tempat_lahir.required'  => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'status_pernikahan.required' => 'Status pernikahan wajib dipilih.',

            'alamat_ktp.required'     => 'Alamat KTP wajib diisi.',
            'provinsi_ktp_id.required'=> 'Provinsi KTP wajib dipilih.',
            'kabupaten_ktp_id.required'=> 'Kabupaten/Kota KTP wajib dipilih.',
            'kecamatan_ktp_id.required'=> 'Kecamatan KTP wajib dipilih.',
            'kelurahan_ktp_id.required'=> 'Kelurahan KTP wajib dipilih.',
            'kodepos_ktp.required'     => 'Kode pos KTP wajib diisi.',

            'alamat_instalasi.required' => 'Alamat instalasi wajib diisi.',
            'provinsi_instalasi_id.required'=> 'Provinsi instalasi wajib dipilih.',
            'kabupaten_instalasi_id.required'=> 'Kabupaten/Kota instalasi wajib dipilih.',
            'kecamatan_instalasi_id.required'=> 'Kecamatan instalasi wajib dipilih.',
            'kelurahan_instalasi_id.required'=> 'Kelurahan instalasi wajib dipilih.',
            'kodepos_instalasi.required' => 'Kode pos instalasi wajib diisi.',

            'pekerjaan.required'    => 'Pekerjaan wajib diisi.',
            'pekerjaan_lainnya.required_if' => 'Pekerjaan lainnya wajib diisi jika memilih Lainnya.',
            'jenis_tempat_tinggal.required' => 'Jenis tempat tinggal wajib dipilih.',
            'tempat_tinggal_lainnya.required_if' => 'Jenis tempat tinggal lainnya wajib diisi jika memilih Lainnya.',
            'nomor_ponsel.required' => 'Nomor ponsel wajib diisi.',

            'no_id_pelanggan.required' => 'Nomor ID Pelanggan wajib diisi.',
            'no_id_pelanggan.unique'   => 'Nomor ID Pelanggan sudah terdaftar.',
            'tanggal_daftar.required'  => 'Tanggal daftar wajib diisi.',

            'paket_internet_id.required' => 'Paket internet wajib dipilih.',
            'nama_paket.required_if'     => 'Nama paket wajib diisi jika memilih Lainnya.',
            'harga_bulanan.required_if'  => 'Harga paket wajib diisi jika memilih Lainnya.',

            'bandwidth_id.required' => 'Bandwidth wajib dipilih.',
             'nilai.required_if'     => 'Nilai wajib diisi jika memilih Lainnya.',
            'promosi_id.exists'    => 'Promosi yang dipilih tidak valid.',

            'metode_billing.required'   => 'Metode billing wajib dipilih.',
            'alamat_penagihan.required' => 'Alamat penagihan wajib diisi.',
            'email_penagihan.required'  => 'Email penagihan wajib diisi.',
            'email_penagihan.email'     => 'Email penagihan harus mengandung @.',

            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih.',

            'nomor_kartu_kredit.required' => 'Nomor kartu kredit wajib diisi.',
            'masa_berlaku_kartu.required' => 'Masa berlaku kartu kredit wajib diisi.',

            'biaya_registrasi.required'     => 'Biaya registrasi wajib diisi.',
            'biaya_paket_internet.required' => 'Biaya paket internet wajib diisi.',
            'biaya_maintenance.required'    => 'Biaya maintenance wajib diisi.',
            'biaya_maintenance.numeric'     => 'Biaya maintenance harus berupa angka.',
            'ppn_nominal.required'          => 'PPN wajib diisi.',
            'total_biaya_per_bulan.required'=> 'Total biaya per bulan wajib diisi.',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->pekerjaan === 'Lainnya' && $this->filled('pekerjaan_lainnya')) {
            $this->merge([
                'pekerjaan' => $this->pekerjaan_lainnya,
            ]);
        }

        if ($this->jenis_tempat_tinggal === 'Lainnya' && $this->filled('tempat_tinggal_lainnya')) {
            $this->merge([
                'jenis_tempat_tinggal' => $this->tempat_tinggal_lainnya,
            ]);
        }

        if ($this->metode_pembayaran === 'Lainnya' && $this->filled('metode_pembayaran_lainnya')) {
            $this->merge([
                'metode_pembayaran' => $this->metode_pembayaran_lainnya,
            ]);
        }
    }
}
