<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Transaksi;

class UpdateTransaksi extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $transaksiParam = $this->route('transaksi');
        $transaksi = is_object($transaksiParam) ? $transaksiParam : Transaksi::find($transaksiParam);
        $transaksiId = $transaksi?->id;
        $pelangganId = $transaksi?->pelanggan_id;

        return [
            // Data Pelanggan
            'no_ktp' => [
                'sometimes', 'string', 'size:16',
                Rule::unique('pelanggans', 'no_ktp')->ignore($pelangganId)
            ],
            'nama_lengkap'           => 'sometimes|string|max:255',
            'tempat_lahir'           => 'sometimes|string|max:100',
            'tanggal_lahir'          => 'sometimes|date',
            'jenis_kelamin'          => 'sometimes|in:L,P',
            'status_pernikahan'      => 'sometimes|in:Menikah,Belum Menikah',
            'alamat_ktp'             => 'sometimes|string',
            'provinsi_ktp_id'        => 'sometimes|exists:provinsis,id',
            'kabupaten_ktp_id'       => 'sometimes|exists:kabupatens,id',
            'kecamatan_ktp_id'       => 'sometimes|exists:kecamatans,id',
            'kelurahan_ktp_id'       => 'sometimes|exists:kelurahans,id',
            'kodepos_ktp'            => 'sometimes|string|max:10',

            'alamat_instalasi'       => 'sometimes|string',
            'provinsi_instalasi_id'  => 'sometimes|exists:provinsis,id',
            'kabupaten_instalasi_id' => 'sometimes|exists:kabupatens,id',
            'kecamatan_instalasi_id' => 'sometimes|exists:kecamatans,id',
            'kelurahan_instalasi_id' => 'sometimes|exists:kelurahans,id',
            'kodepos_instalasi'      => 'sometimes|string|max:10',

            'pekerjaan'              => 'sometimes|string|max:100',
            'pekerjaan_lainnya'      => 'required_if:pekerjaan,Lainnya|string|max:100',

            'jenis_tempat_tinggal'   => 'sometimes|string|max:100',
            'tempat_tinggal_lainnya' => 'required_if:jenis_tempat_tinggal,Lainnya|string|max:100',


            'nomor_telepon'          => 'nullable|string|max:20',
            'nomor_ponsel'           => 'sometimes|string|max:20',
            'no_fax'                 => 'nullable|string|max:20',

            // Data Transaksi
            'no_id_pelanggan' => [
                'sometimes', 'string', 'max:20',
                Rule::unique('transaksis', 'no_id_pelanggan')->ignore($transaksiId)
            ],
            'tanggal_daftar'        => 'sometimes|date',
            'pelanggan_id'          => 'nullable|exists:pelanggans,id',

            'paket_internet_id'     => 'sometimes|required',
            'nama_paket'            => 'required_if:paket_internet_id,Lainnya|string|max:150',
            'harga_bulanan'         => 'required_if:paket_internet_id,Lainnya|numeric|min:0',

            'bandwidth_id'          => 'sometimes|required|string',
            'nilai'                 => 'required_if:bandwidth_id,Lainnya|string|max:100',

            'promosi_id'            => 'nullable|exists:promosis,id',

            'metode_billing'        => 'sometimes|in:Cetak,E-Billing',
            'alamat_penagihan'      => 'sometimes|string',
            'email_penagihan'       => 'sometimes|email:rfc|max:255',

            'metode_pembayaran'         => 'sometimes|string|max:100',
            'metode_pembayaran_lainnya' => 'nullable|string|max:100',

            'nomor_kartu_kredit'    => 'sometimes|string|max:50',
            'masa_berlaku_kartu'    => 'sometimes|string|max:10',

            'biaya_registrasi'      => 'sometimes|numeric|min:0',
            'biaya_paket_internet'  => 'sometimes|numeric|min:0',
            'biaya_maintenance'     => 'sometimes|numeric|min:0',
            'ppn_nominal'           => 'sometimes|numeric|min:0',
            'total_biaya_per_bulan' => 'sometimes|numeric|min:0',
        ];
    }

   public function messages(): array
{
    return [
        // Data Pelanggan
        'no_ktp.size'               => 'No KTP harus terdiri dari 16 digit.',
        'no_ktp.unique'             => 'No KTP sudah terdaftar, silakan gunakan yang lain.',
        'nama_lengkap.required'     => 'Nama lengkap wajib diisi.',
        'nama_lengkap.max'          => 'Nama lengkap maksimal 255 karakter.',
        'tempat_lahir.required'     => 'Tempat lahir wajib diisi.',
        'tempat_lahir.max'          => 'Tempat lahir maksimal 100 karakter.',
        'tanggal_lahir.date'        => 'Tanggal lahir harus berupa format tanggal yang valid.',
        'jenis_kelamin.in'          => 'Jenis kelamin hanya boleh L (Laki-laki) atau P (Perempuan).',
        'status_pernikahan.in'      => 'Status pernikahan hanya boleh Menikah atau Belum Menikah.',
        'alamat_ktp.required'       => 'Alamat KTP wajib diisi.',
        'provinsi_ktp_id.exists'    => 'Provinsi KTP yang dipilih tidak valid.',
        'kabupaten_ktp_id.exists'   => 'Kabupaten KTP yang dipilih tidak valid.',
        'kecamatan_ktp_id.exists'   => 'Kecamatan KTP yang dipilih tidak valid.',
        'kelurahan_ktp_id.exists'   => 'Kelurahan KTP yang dipilih tidak valid.',
        'kodepos_ktp.required'      => 'Kode pos KTP wajib diisi.',
        'kodepos_ktp.max'           => 'Kode pos KTP maksimal 10 karakter.',

        'alamat_instalasi.required'       => 'Alamat instalasi wajib diisi.',
        'provinsi_instalasi_id.exists'    => 'Provinsi instalasi tidak valid.',
        'kabupaten_instalasi_id.exists'   => 'Kabupaten instalasi tidak valid.',
        'kecamatan_instalasi_id.exists'   => 'Kecamatan instalasi tidak valid.',
        'kelurahan_instalasi_id.exists'   => 'Kelurahan instalasi tidak valid.',
        'kodepos_instalasi.required'      => 'Kode pos instalasi wajib diisi.',
        'kodepos_instalasi.max'           => 'Kode pos instalasi maksimal 10 karakter.',

        'pekerjaan.max'              => 'Pekerjaan maksimal 100 karakter.',
        'pekerjaan_lainnya.max'      => 'Pekerjaan lainnya maksimal 100 karakter.',
        'jenis_tempat_tinggal.max'   => 'Jenis tempat tinggal maksimal 100 karakter.',
        'tempat_tinggal_lainnya.max' => 'Jenis tempat tinggal lainnya maksimal 100 karakter.',

        'nomor_telepon.max'          => 'Nomor telepon maksimal 20 karakter.',
        'nomor_ponsel.max'           => 'Nomor ponsel maksimal 20 karakter.',
        'no_fax.max'                 => 'No Fax maksimal 20 karakter.',

        // Data Transaksi
        'no_id_pelanggan.unique'     => 'No ID Pelanggan sudah digunakan.',
        'tanggal_daftar.date'        => 'Tanggal daftar harus berupa tanggal yang valid.',
        'pelanggan_id.exists'        => 'Pelanggan yang dipilih tidak valid.',

        'paket_internet_id.required' => 'Paket internet wajib dipilih.',
        'nama_paket.required_if'     => 'Nama paket wajib diisi jika memilih Lainnya.',
        'nama_paket.max'             => 'Nama paket maksimal 150 karakter.',
        'harga_bulanan.required_if'  => 'Harga bulanan wajib diisi jika memilih Lainnya.',
        'harga_bulanan.numeric'      => 'Harga bulanan harus berupa angka.',
        'harga_bulanan.min'          => 'Harga bulanan minimal 0.',

        'bandwidth_id.required'      => 'Bandwidth wajib dipilih.',
        'nilai.required_if'          => 'Nilai bandwidth wajib diisi jika memilih Lainnya.',
        'nilai.max'                  => 'Nilai bandwidth maksimal 100 karakter.',

        'promosi_id.exists'          => 'Promosi yang dipilih tidak valid.',

        'metode_billing.in'          => 'Metode billing hanya boleh Cetak atau E-Billing.',
        'alamat_penagihan.required'  => 'Alamat penagihan wajib diisi.',
        'email_penagihan.email'      => 'Format email penagihan tidak valid.',
        'email_penagihan.max'        => 'Email penagihan maksimal 255 karakter.',

        'metode_pembayaran.max'          => 'Metode pembayaran maksimal 100 karakter.',
        'metode_pembayaran_lainnya.max'  => 'Metode pembayaran lainnya maksimal 100 karakter.',

        'nomor_kartu_kredit.max'     => 'Nomor kartu kredit maksimal 50 karakter.',
        'masa_berlaku_kartu.max'     => 'Masa berlaku kartu maksimal 10 karakter.',

        'biaya_registrasi.numeric'   => 'Biaya registrasi harus berupa angka.',
        'biaya_registrasi.min'       => 'Biaya registrasi minimal 0.',
        'biaya_paket_internet.numeric' => 'Biaya paket internet harus berupa angka.',
        'biaya_paket_internet.min'   => 'Biaya paket internet minimal 0.',
        'biaya_maintenance.numeric'  => 'Biaya maintenance harus berupa angka.',
        'biaya_maintenance.min'      => 'Biaya maintenance minimal 0.',
        'ppn_nominal.numeric'        => 'PPN harus berupa angka.',
        'ppn_nominal.min'            => 'PPN minimal 0.',
        'total_biaya_per_bulan.numeric' => 'Total biaya per bulan harus berupa angka.',
        'total_biaya_per_bulan.min'  => 'Total biaya per bulan minimal 0.',
    ];
}

    protected function prepareForValidation()
    {
        if ($this->pekerjaan === 'Lainnya' && $this->filled('pekerjaan_lainnya')) {
            $this->merge(['pekerjaan' => $this->pekerjaan_lainnya]);
        }

        if ($this->jenis_tempat_tinggal === 'Lainnya' && $this->filled('tempat_tinggal_lainnya')) {
            $this->merge(['jenis_tempat_tinggal' => $this->tempat_tinggal_lainnya]);
        }

        if ($this->metode_pembayaran === 'Lainnya' && $this->filled('metode_pembayaran_lainnya')) {
            $this->merge(['metode_pembayaran' => $this->metode_pembayaran_lainnya]);
        }
    }
}
