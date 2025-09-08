<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksi;
use App\Http\Requests\UpdateTransaksi;
use App\Models\Bandwidth;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\PaketInternet;
use App\Models\Pelanggan;
use App\Models\Promosi;
use App\Models\Provinsi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('transaksi.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaksi::with(['pelanggan', 'paket', 'promosi', 'bandwidth'])->select('transaksis.*');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('no_ktp', fn($row) => $row->pelanggan->no_ktp ?? '-')
                ->addColumn('nama_lengkap', fn($row) => $row->pelanggan->nama_lengkap ?? '-')
                ->addColumn('alamat_ktp', fn($row) => $row->pelanggan->alamat_ktp ?? '-')
                ->addColumn('alamat_instalasi', fn($row) => $row->pelanggan->alamat_instalasi ?? '-')
                ->addColumn('paket_internet', fn($row) =>
                    $row->paket->paket_internet
                        ? $row->paket->paket_internet
                        : ($row->paket_internet_custom ?? '-')
                )
                ->addColumn('actions', function ($row) {
                $editUrl = route('transaksi.edit', $row->id);
                $deleteUrl = route('transaksi.destroy', $row->id);
                $pdfUrl = route('transaksi.preview', $row->id);

                 return '
                    <select class="form-select form-select-sm action-select" data-id="'.$row->id.'" data-edit="'.$editUrl.'" data-pdf="'.$pdfUrl.'" data-delete="'.$deleteUrl.'">
                        <option value="">-- Pilih Aksi --</option>
                        <option value="edit">✏️ Edit</option>
                        <option value="pdf">📄 PDF</option>
                        <option value="delete">🗑️ Delete</option>
                    </select>
                ';
            })

                ->rawColumns(['actions'])
                ->make(true);
        }
    }


public function previewPdf($id)
{
    try {
        // Ambil data transaksi dengan relasi
        $transaksi = Transaksi::with([
            'pelanggan.provinsiKtp',
            'pelanggan.kabupatenKtp',
            'pelanggan.kecamatanKtp',
            'pelanggan.kelurahanKtp',
            'pelanggan.provinsiInstalasi',
            'pelanggan.kabupatenInstalasi',
            'pelanggan.kecamatanInstalasi',
            'pelanggan.kelurahanInstalasi',
            'paket',
            'promosi',
            'bandwidth'
        ])->findOrFail($id);

        $data = [
            'transaksi'   => $transaksi,
            'title'       => 'Preview Formulir Berlangganan',
            'generated_at'=> now()->format('d F Y H:i:s')
        ];

        return view('transaksi.pdf', $data);

    } catch (\Exception $e) {
        return back()->with('error', 'Gagal menampilkan preview PDF: ' . $e->getMessage());
    }
}

public function exportPdf($id)
{
    try {
        // Ambil data transaksi dengan relasi
        $transaksi = Transaksi::with([
            'pelanggan.provinsiKtp',
            'pelanggan.kabupatenKtp',
            'pelanggan.kecamatanKtp',
            'pelanggan.kelurahanKtp',
            'pelanggan.provinsiInstalasi',
            'pelanggan.kabupatenInstalasi',
            'pelanggan.kecamatanInstalasi',
            'pelanggan.kelurahanInstalasi',
            'paket',
            'promosi',
            'bandwidth'
        ])->findOrFail($id);

        $data = [
            'transaksi'   => $transaksi,
            'title'       => 'Data Transaksi - ' . ($transaksi->pelanggan->nama_lengkap ?? 'Unknown'),
            'generated_at'=> now()->format('d F Y H:i:s'),
              'isPdf'       => true,
        ];

        $pdf = Pdf::loadView('transaksi.pdf', $data)->setPaper('A4', 'portrait');

        $filename = 'transaksi_' . $transaksi->no_id_pelanggan . '_' . now()->format('YmdHis') . '.pdf';

        // Return PDF sebagai download
        return $pdf->download($filename);

    } catch (\Exception $e) {
        return back()->with('error', 'Gagal mengexport PDF: ' . $e->getMessage());
    }
}

    public function create()
    {
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        $paketInternet = PaketInternet::all();
        $promosi = Promosi::all();
        $bandwidths = Bandwidth::all();
        $pekerjaanOptions = Pelanggan::pekerjaanOptions();
        $tempatTinggalOptions = Pelanggan::tempatTinggalOptions();
        $methodPembayaranOptions = Transaksi::metodePembayaranOptions();

        return view('transaksi.create', compact(
            'provinsi', 'kabupaten', 'kecamatan', 'kelurahan',
            'paketInternet', 'promosi', 'bandwidths', 'pekerjaanOptions', 'tempatTinggalOptions', 'methodPembayaranOptions'
        ));
    }

        public function store(StoreTransaksi $request)
    {
        try {
            DB::transaction(function () use ($request) {

                // Pekerjaan dan jenis tempat tinggal
                $pekerjaan = $request->pekerjaan === 'Lainnya' ? $request->pekerjaan_lainnya : $request->pekerjaan;
                $jenis_tempat_tinggal = $request->jenis_tempat_tinggal === 'Lainnya' ? $request->jenis_tempat_tinggal_lainnya : $request->jenis_tempat_tinggal;

                // Cek apakah pelanggan sudah ada berdasarkan no_ktp
                $pelanggan = Pelanggan::firstOrCreate(
                    ['no_ktp' => $request->no_ktp],
                    [
                        'nama_lengkap'          => $request->nama_lengkap,
                        'tempat_lahir'          => $request->tempat_lahir,
                        'tanggal_lahir'         => $request->tanggal_lahir,
                        'jenis_kelamin'         => $request->jenis_kelamin,
                        'status_pernikahan'     => $request->status_pernikahan,
                        'alamat_ktp'            => $request->alamat_ktp,
                        'provinsi_ktp_id'       => $request->provinsi_ktp_id,
                        'kabupaten_ktp_id'      => $request->kabupaten_ktp_id,
                        'kecamatan_ktp_id'      => $request->kecamatan_ktp_id,
                        'kelurahan_ktp_id'      => $request->kelurahan_ktp_id,
                        'kodepos_ktp'           => $request->kodepos_ktp,
                        'alamat_instalasi'      => $request->alamat_instalasi,
                        'provinsi_instalasi_id' => $request->provinsi_instalasi_id,
                        'kabupaten_instalasi_id'=> $request->kabupaten_instalasi_id,
                        'kecamatan_instalasi_id'=> $request->kecamatan_instalasi_id,
                        'kelurahan_instalasi_id'=> $request->kelurahan_instalasi_id,
                        'kodepos_instalasi'     => $request->kodepos_instalasi,
                        'pekerjaan'             => $pekerjaan,
                        'jenis_tempat_tinggal'  => $jenis_tempat_tinggal,
                        'nomor_telepon'         => $request->nomor_telepon,
                        'nomor_ponsel'          => $request->nomor_ponsel,
                        'no_fax'                => $request->no_fax,
                    ]
                );

                // Bersihkan input rupiah
                $biayaRegistrasi  = (float) preg_replace('/[^0-9]/', '', $request->biaya_registrasi);
                $biayaPaket       = (float) preg_replace('/[^0-9]/', '', $request->biaya_paket_internet);
                $biayaMaintenance = (float) preg_replace('/[^0-9]/', '', $request->biaya_maintenance);

                // Hitung PPN nominal & total
                $ppnPersen = 10;
                $ppnNominal = ($biayaPaket + $biayaMaintenance) * ($ppnPersen / 100);
                $total = $biayaRegistrasi + $biayaPaket + $biayaMaintenance + $ppnNominal;

                // Paket internet
                if ($request->paket_internet_id !== 'Lainnya') {
                    $paketInternetId = $request->paket_internet_id;
                    $paketInternetCustom = null;
                    $paketInternetHargaCustom = null;
                } else {
                    $paketInternetId = null;
                    $paketInternetCustom = $request->paket_internet_custom;
                    $paketInternetHargaCustom = (float) preg_replace('/[^0-9]/', '', $request->paket_internet_harga_custom);
                }

                // Bandwidth
                $bandwidthId = $request->bandwidth_id !== 'Lainnya' ? $request->bandwidth_id : null;
                $bandwidthManual = $request->bandwidth_id === 'Lainnya' ? $request->bandwidth_manual : null;

                // Simpan transaksi
                Transaksi::create([
                    'no_id_pelanggan'              => $request->no_id_pelanggan,
                    'tanggal_daftar'               => $request->tanggal_daftar,
                    'pelanggan_id'                 => $pelanggan->id,
                    'paket_internet_id'            => $paketInternetId,
                    'paket_internet_custom'        => $paketInternetCustom,
                    'paket_internet_harga_custom'  => $paketInternetHargaCustom,
                    'promosi_id'                   => $request->promosi_id,
                    'bandwidth_id'                 => $bandwidthId,
                    'bandwidth_manual'             => $bandwidthManual,
                    'metode_billing'               => $request->metode_billing,
                    'alamat_penagihan'             => $request->alamat_penagihan,
                    'email_penagihan'              => $request->email_penagihan,
                    'metode_pembayaran'            => $request->metode_pembayaran,
                    'nomor_kartu_kredit'           => $request->nomor_kartu_kredit,
                    'masa_berlaku_kartu'           => $request->masa_berlaku_kartu,
                    'biaya_registrasi'             => $biayaRegistrasi,
                    'biaya_paket_internet'         => $biayaPaket,
                    'biaya_maintenance'            => $biayaMaintenance,
                    'ppn_persen'                   => $ppnPersen,
                    'ppn_nominal'                  => $ppnNominal,
                    'total_biaya_per_bulan'        => $total,
                ]);
            });

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat!');
        } catch (\Throwable $th) {
            return back()->withInput()->with('error', 'Gagal menyimpan transaksi: ' . $th->getMessage());
        }
    }


    public function show($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'paket', 'promosi', 'bandwidth'])->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'paket', 'promosi', 'bandwidth'])->findOrFail($id);
        $provinsi = Provinsi::all();
        $paketInternet = PaketInternet::all();
        $promosi = Promosi::all();
        $bandwidths = Bandwidth::all();
        $pekerjaanOptions = Pelanggan::pekerjaanOptions();
        $tempatTinggalOptions = Pelanggan::tempatTinggalOptions();
        $methodPembayaranOptions = Transaksi::metodePembayaranOptions();

        return view('transaksi.edit', compact(
            'transaksi', 'provinsi', 'paketInternet', 'promosi', 'bandwidths',
            'pekerjaanOptions', 'tempatTinggalOptions', 'methodPembayaranOptions'
        ));
    }

    public function update(UpdateTransaksi $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $transaksi = Transaksi::findOrFail($id);

                // Pekerjaan dan jenis tempat tinggal
                $pekerjaan = $request->pekerjaan === 'Lainnya' ? $request->pekerjaan_lainnya : $request->pekerjaan;
                $jenis_tempat_tinggal = $request->jenis_tempat_tinggal === 'Lainnya' ? $request->jenis_tempat_tinggal_lainnya : $request->jenis_tempat_tinggal;

                // Cek apakah no_ktp diganti
                if ($request->no_ktp !== $transaksi->pelanggan->no_ktp) {
                    // Cari pelanggan dengan KTP baru
                    $pelanggan = Pelanggan::firstOrCreate(
                        ['no_ktp' => $request->no_ktp],
                        [
                            'nama_lengkap'          => $request->nama_lengkap,
                            'tempat_lahir'          => $request->tempat_lahir,
                            'tanggal_lahir'         => $request->tanggal_lahir,
                            'jenis_kelamin'         => $request->jenis_kelamin,
                            'status_pernikahan'     => $request->status_pernikahan,
                            'alamat_ktp'            => $request->alamat_ktp,
                            'provinsi_ktp_id'       => $request->provinsi_ktp_id,
                            'kabupaten_ktp_id'      => $request->kabupaten_ktp_id,
                            'kecamatan_ktp_id'      => $request->kecamatan_ktp_id,
                            'kelurahan_ktp_id'      => $request->kelurahan_ktp_id,
                            'kodepos_ktp'           => $request->kodepos_ktp,
                            'alamat_instalasi'      => $request->alamat_instalasi,
                            'provinsi_instalasi_id' => $request->provinsi_instalasi_id,
                            'kabupaten_instalasi_id'=> $request->kabupaten_instalasi_id,
                            'kecamatan_instalasi_id'=> $request->kecamatan_instalasi_id,
                            'kelurahan_instalasi_id'=> $request->kelurahan_instalasi_id,
                            'kodepos_instalasi'     => $request->kodepos_instalasi,
                            'pekerjaan'             => $pekerjaan,
                            'jenis_tempat_tinggal'  => $jenis_tempat_tinggal,
                            'nomor_telepon'         => $request->nomor_telepon,
                            'nomor_ponsel'          => $request->nomor_ponsel,
                            'no_fax'                => $request->no_fax,
                        ]
                    );
                } else {
                    // Update pelanggan lama
                    $pelanggan = $transaksi->pelanggan;
                    $pelanggan->update([
                        'nama_lengkap'          => $request->nama_lengkap,
                        'tempat_lahir'          => $request->tempat_lahir,
                        'tanggal_lahir'         => $request->tanggal_lahir,
                        'jenis_kelamin'         => $request->jenis_kelamin,
                        'status_pernikahan'     => $request->status_pernikahan,
                        'alamat_ktp'            => $request->alamat_ktp,
                        'provinsi_ktp_id'       => $request->provinsi_ktp_id,
                        'kabupaten_ktp_id'      => $request->kabupaten_ktp_id,
                        'kecamatan_ktp_id'      => $request->kecamatan_ktp_id,
                        'kelurahan_ktp_id'      => $request->kelurahan_ktp_id,
                        'kodepos_ktp'           => $request->kodepos_ktp,
                        'alamat_instalasi'      => $request->alamat_instalasi,
                        'provinsi_instalasi_id' => $request->provinsi_instalasi_id,
                        'kabupaten_instalasi_id'=> $request->kabupaten_instalasi_id,
                        'kecamatan_instalasi_id'=> $request->kecamatan_instalasi_id,
                        'kelurahan_instalasi_id'=> $request->kelurahan_instalasi_id,
                        'kodepos_instalasi'     => $request->kodepos_instalasi,
                        'pekerjaan'             => $pekerjaan,
                        'jenis_tempat_tinggal'  => $jenis_tempat_tinggal,
                        'nomor_telepon'         => $request->nomor_telepon,
                        'nomor_ponsel'          => $request->nomor_ponsel,
                        'no_fax'                => $request->no_fax,
                    ]);
                }

                // Bersihkan input rupiah
                $biayaRegistrasi  = (float) preg_replace('/[^0-9]/', '', $request->biaya_registrasi);
                $biayaPaket       = (float) preg_replace('/[^0-9]/', '', $request->biaya_paket_internet);
                $biayaMaintenance = (float) preg_replace('/[^0-9]/', '', $request->biaya_maintenance);

                // Hitung PPN nominal & total
                $ppnPersen = 10;
                $ppnNominal = ($biayaPaket + $biayaMaintenance) * ($ppnPersen / 100);
                $total = $biayaRegistrasi + $biayaPaket + $biayaMaintenance + $ppnNominal;

                // Paket internet
                if ($request->paket_internet_id !== 'Lainnya') {
                    $paketInternetId = $request->paket_internet_id;
                    $paketInternetCustom = null;
                    $paketInternetHargaCustom = null;
                } else {
                    $paketInternetId = null;
                    $paketInternetCustom = $request->paket_internet_custom;
                    $paketInternetHargaCustom = (float) preg_replace('/[^0-9]/', '', $request->paket_internet_harga_custom);
                }

                // Bandwidth
                $bandwidthId = $request->bandwidth_id !== 'Lainnya' ? $request->bandwidth_id : null;
                $bandwidthManual = $request->bandwidth_id === 'Lainnya' ? $request->bandwidth_manual : null;

                // Update transaksi
                $transaksi->update([
                    'no_id_pelanggan'              => $request->no_id_pelanggan,
                    'tanggal_daftar'               => $request->tanggal_daftar,
                    'pelanggan_id'                 => $pelanggan->id,
                    'paket_internet_id'            => $paketInternetId,
                    'paket_internet_custom'        => $paketInternetCustom,
                    'paket_internet_harga_custom'  => $paketInternetHargaCustom,
                    'promosi_id'                   => $request->promosi_id,
                    'bandwidth_id'                 => $bandwidthId,
                    'bandwidth_manual'             => $bandwidthManual,
                    'metode_billing'               => $request->metode_billing,
                    'alamat_penagihan'             => $request->alamat_penagihan,
                    'email_penagihan'              => $request->email_penagihan,
                    'metode_pembayaran'            => $request->metode_pembayaran,
                    'nomor_kartu_kredit'           => $request->nomor_kartu_kredit,
                    'masa_berlaku_kartu'           => $request->masa_berlaku_kartu,
                    'biaya_registrasi'             => $biayaRegistrasi,
                    'biaya_paket_internet'         => $biayaPaket,
                    'biaya_maintenance'            => $biayaMaintenance,
                    'ppn_persen'                   => $ppnPersen,
                    'ppn_nominal'                  => $ppnNominal,
                    'total_biaya_per_bulan'        => $total,
                ]);
            });

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate!');
        } catch (\Throwable $th) {
            return back()->withInput()->with('error', 'Gagal update transaksi: ' . $th->getMessage());
        }
    }

  public function destroy(Request $request, $id)
    {
        try {
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->delete();

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Transaksi berhasil dihapus.'
                ]);
            }

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
        } catch (\Throwable $th) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal hapus transaksi: ' . $th->getMessage()
                ], 500);
            }

            return back()->with('error', 'Gagal hapus transaksi: ' . $th->getMessage());
        }
    }

}
