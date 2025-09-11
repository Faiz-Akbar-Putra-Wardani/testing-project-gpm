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
                ->addColumn('alamat_instalasi', fn($row) => $row->pelanggan->alamat_instalasi ?? '-')
                ->addColumn('paket_internet', fn($row) => $row->paket?->nama_paket ?? '-')
                ->addColumn('actions', function ($row) {
                    $editUrl = route('transaksi.edit', $row->id);
                    $deleteUrl = route('transaksi.destroy', $row->id);
                    $pdfUrl = route('transaksi.preview', $row->id);

                    return '
                        <select class="form-select form-select-sm action-select" data-id="'.$row->id.'" data-edit="'.$editUrl.'" data-pdf="'.$pdfUrl.'" data-delete="'.$deleteUrl.'">
                            <option value="">-- Pilih Aksi --</option>
                            <option value="edit">✏️ Edit</option>
                            <option value="pdf">📄 Form</option>
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
                'generated_at'=> now()->format('d F Y H:i:s'),
                'isPdf'       => true,
            ];

            return view('transaksi.pdf', $data);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menampilkan preview PDF: ' . $e->getMessage());
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
        $generatedId = Transaksi::generatePelangganId();

        return view('transaksi.create', compact(
            'provinsi', 'kabupaten', 'kecamatan', 'kelurahan',
            'paketInternet', 'promosi', 'bandwidths', 'pekerjaanOptions', 'tempatTinggalOptions', 'methodPembayaranOptions', 'generatedId'
        ));
    }

    public function store(StoreTransaksi $request)
    {
        try {
            DB::transaction(function () use ($request) {
                // --- Pekerjaan & tempat tinggal ---
                $pekerjaan = $request->pekerjaan === 'Lainnya' ? $request->pekerjaan_lainnya : $request->pekerjaan;
                $jenis_tempat_tinggal = $request->jenis_tempat_tinggal === 'Lainnya' ? $request->jenis_tempat_tinggal_lainnya : $request->jenis_tempat_tinggal;

                // --- Pelanggan ---
                $pelanggan = Pelanggan::firstOrCreate(
                    ['no_ktp' => $request->no_ktp],
                    array_merge(
                        $request->only([
                            'nama_lengkap','tempat_lahir','tanggal_lahir','jenis_kelamin',
                            'status_pernikahan','alamat_ktp','provinsi_ktp_id','kabupaten_ktp_id',
                            'kecamatan_ktp_id','kelurahan_ktp_id','kodepos_ktp','alamat_instalasi',
                            'provinsi_instalasi_id','kabupaten_instalasi_id','kecamatan_instalasi_id',
                            'kelurahan_instalasi_id','kodepos_instalasi','nomor_telepon','nomor_ponsel','no_fax'
                        ]),
                        ['pekerjaan' => $pekerjaan, 'jenis_tempat_tinggal' => $jenis_tempat_tinggal]
                    )
                );

                // --- Bersihkan input ---
                $biayaRegistrasi  = (float) preg_replace('/[^0-9]/', '', $request->biaya_registrasi);
                $biayaMaintenance = (float) preg_replace('/[^0-9]/', '', $request->biaya_maintenance);

                // --- Paket ---
                if ($request->paket_internet_id === 'Lainnya') {
                    $paketBaru = PaketInternet::create([
                        'nama_paket'    => $request->nama_paket,
                        'harga_bulanan' => (float) preg_replace('/[^0-9]/', '', $request->harga_bulanan),
                        'is_active'     => true,
                    ]);
                    $paketInternetId = $paketBaru->id;
                    $biayaPaket = $paketBaru->harga_bulanan;
                } else {
                    $paket = PaketInternet::findOrFail($request->paket_internet_id);
                    $paketInternetId = $paket->id;
                    $biayaPaket = $paket->harga_bulanan;
                }

                // --- Bandwidth ---
                if ($request->bandwidth_id === 'Lainnya') {
                    $bandwidthBaru = Bandwidth::create([
                        'nilai' => $request->nilai,
                    ]);
                    $bandwidthId = $bandwidthBaru->id;
                } else {
                    $bandwidth = Bandwidth::findOrFail($request->bandwidth_id);
                    $bandwidthId = $bandwidth->id;
                }

                // --- Hitung PPN & Total ---
                $ppnPersen = 10;
                $ppnNominal = ($biayaRegistrasi + $biayaPaket + $biayaMaintenance) * ($ppnPersen / 100);
                $total = $biayaRegistrasi + $biayaPaket + $biayaMaintenance + $ppnNominal;

                // --- Simpan Transaksi ---
                Transaksi::create(array_merge(
                    $request->only([
                        'tanggal_daftar','promosi_id','metode_billing','alamat_penagihan',
                        'email_penagihan','metode_pembayaran','nomor_kartu_kredit','masa_berlaku_kartu'
                    ]),
                    [
                        'no_id_pelanggan'        => Transaksi::generatePelangganId(),
                        'pelanggan_id'           => $pelanggan->id,
                        'paket_internet_id'      => $paketInternetId,
                        'bandwidth_id'           => $bandwidthId,
                        'biaya_registrasi'       => $biayaRegistrasi,
                        'biaya_paket_internet'   => $biayaPaket,
                        'biaya_maintenance'      => $biayaMaintenance,
                        'ppn_persen'             => $ppnPersen,
                        'ppn_nominal'            => $ppnNominal,
                        'total_biaya_per_bulan'  => $total,
                    ]
                ));
            });

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat!');
        } catch (\Throwable $th) {
            return back()->withInput()->with('error', 'Gagal menyimpan transaksi: '.$th->getMessage());
        }
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

            // --- Pekerjaan & tempat tinggal ---
            $pekerjaan = $request->pekerjaan === 'Lainnya' ? $request->pekerjaan_lainnya : $request->pekerjaan;
            $jenis_tempat_tinggal = $request->jenis_tempat_tinggal === 'Lainnya' ? $request->tempat_tinggal_lainnya : $request->jenis_tempat_tinggal;

            // --- Pelanggan ---
            $pelanggan = $transaksi->pelanggan;
            $pelanggan->update(array_merge(
                $request->only([
                    'nama_lengkap','tempat_lahir','tanggal_lahir','jenis_kelamin',
                    'status_pernikahan','alamat_ktp','provinsi_ktp_id','kabupaten_ktp_id',
                    'kecamatan_ktp_id','kelurahan_ktp_id','kodepos_ktp','alamat_instalasi',
                    'provinsi_instalasi_id','kabupaten_instalasi_id','kecamatan_instalasi_id',
                    'kelurahan_instalasi_id','kodepos_instalasi','nomor_telepon','nomor_ponsel','no_fax'
                ]),
                ['pekerjaan' => $pekerjaan, 'jenis_tempat_tinggal' => $jenis_tempat_tinggal]
            ));

            // --- Bersihkan input ---
            $biayaRegistrasi  = (float) preg_replace('/[^0-9]/', '', $request->biaya_registrasi);
            $biayaMaintenance = (float) preg_replace('/[^0-9]/', '', $request->biaya_maintenance);

            // --- Paket ---
            if ($request->paket_internet_id === 'Lainnya') {
                $paketBaru = PaketInternet::create([
                    'nama_paket'    => $request->nama_paket,
                    'harga_bulanan' => (float) preg_replace('/[^0-9]/', '', $request->harga_bulanan),
                    'is_active'     => true,
                ]);
                $paketInternetId = $paketBaru->id;
                $biayaPaket = $paketBaru->harga_bulanan;
            } else {
                $paket = PaketInternet::findOrFail($request->paket_internet_id);
                $paketInternetId = $paket->id;
                $biayaPaket = $paket->harga_bulanan;
            }

            // --- Bandwidth ---
            if ($request->bandwidth_id === 'Lainnya') {
                $bandwidthBaru = Bandwidth::create([
                    'nilai' => $request->nilai,
                    'is_active' => true,
                ]);
                $bandwidthId = $bandwidthBaru->id;
            } else {
                $bandwidth = Bandwidth::findOrFail($request->bandwidth_id);
                $bandwidthId = $bandwidth->id;
            }

            // --- Hitung PPN & Total ---
            $ppnPersen = 10;
            $ppnNominal = ($biayaRegistrasi + $biayaPaket + $biayaMaintenance) * ($ppnPersen / 100);
            $total = $biayaRegistrasi + $biayaPaket + $biayaMaintenance + $ppnNominal;

            // --- Update Transaksi ---
            $transaksi->update(array_merge(
                $request->only([
                    'tanggal_daftar','promosi_id','metode_billing','alamat_penagihan',
                    'email_penagihan','metode_pembayaran','nomor_kartu_kredit','masa_berlaku_kartu'
                ]),
                [
                    'no_id_pelanggan'        => $transaksi->no_id_pelanggan, // tetap pakai ID lama
                    'pelanggan_id'           => $pelanggan->id,
                    'paket_internet_id'      => $paketInternetId,
                    'bandwidth_id'           => $bandwidthId,
                    'biaya_registrasi'       => $biayaRegistrasi,
                    'biaya_paket_internet'   => $biayaPaket,
                    'biaya_maintenance'      => $biayaMaintenance,
                    'ppn_persen'             => $ppnPersen,
                    'ppn_nominal'            => $ppnNominal,
                    'total_biaya_per_bulan'  => $total,
                ]
            ));
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate!');
    } catch (\Throwable $th) {
        return back()->withInput()->with('error', 'Gagal update transaksi: '.$th->getMessage());
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
