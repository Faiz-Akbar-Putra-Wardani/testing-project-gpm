<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Formulir Berlangganan</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      margin: 0;
      padding: 0;
      background: #f2f2f2;
    }
    .a4 {
      width: 21cm;
      min-height: 29.7cm;
      margin: auto;
      background: #fff;
      padding: 1cm;
      box-sizing: border-box;
      box-shadow: 0 0 5px rgba(0,0,0,0.3);
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    td, th {
      border: 2px solid #000;
      padding: 0;
      vertical-align: middle;
    }
    .no-border {
      border: none !important;
    }
    .title {
      font-size: 16px;
      font-weight: bold;
      text-align: center;
    }
    .small-checkbox {
      width: 14px;
      height: 14px;
      vertical-align: middle;
    }
    td.label {
      width: 220px;
      font-weight: 700;
      padding: 6px;
      border-top: none;
      border-left: none;
      border-bottom: none;
      border-right: 2px solid #000;
      box-sizing: border-box;
    }
    td.input-cell {
      padding: 0;
      box-sizing: border-box;
    }
    .split {
      display: flex;
      align-items: stretch;
      min-height: 34px;
      width: 100%;
    }
    .split > .left {
      flex: 1;
      padding: 6px;
      box-sizing: border-box;
    }
    .split > .right {
      border-left: 2px solid #000;
      padding: 6px;
      min-width: 280px;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      box-sizing: border-box;
    }
    .opts {
      display: flex;
      gap: 12px;
      align-items: center;
      flex-wrap: wrap;
    }
    .two-cols {
      display: flex;
      gap: 0;
      align-items: stretch;
    }
    .two-cols > .c1,
    .two-cols > .c2,
    .two-cols > .c3 {
      padding: 6px;
      box-sizing: border-box;
    }
    .two-cols > .c2 { border-left: 2px solid #000; width: 200px; }
    .two-cols > .c3 { border-left: 2px solid #000; width: 200px; }
    .dots { border-bottom: 1px dotted #000; display: inline-block; min-width: 120px; }
    .dashed { border-bottom: 1px dashed #000; display: inline-block; min-width: 120px; }
    .small { font-size: 10px; color: #555; }
    .footer { margin-top: 20px; font-size: 11px; }
    .signature { text-align: center; height: 80px; vertical-align: bottom; }

    /* --- STYLE REVISI BANDWIDTH SAMPE METODE BILLING --- */
    .box {
      border: 1px solid #000;
      padding: 10px 15px;
      margin: 15px 0;
    }
    .section {
      margin-bottom: 50px;
    }
    .section3 { margin-bottom: 15px; }
    .section4 { margin-bottom: 20px; }
    .section label { margin-right: 20px; }
    .line { border-top: 1px solid #000; margin: 10px 0; }
    .full-dots {
      border-bottom: 1px dotted #000;
      display: inline-block;
      width: 100%;
    }
    .row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 20px;
    }
    .row .col { flex: 1; }
    .lainnya {
      float: right;
      margin-top: 30px;
    }

    /* Style untuk section pembayaran baru - JARAK DIRAPATKAN */
    .form-wrapper {
      width: 100%;
      margin-top: 5px;
      display: flex;
      gap: 3px;
    }
    .left-section {
      width: 50%;
    }
    .right-section {
      width: 50%;
    }
    .payment-table {
      margin-bottom: 8px;
    }
    .payment-table td {
      border: 2px solid #000;
      border-right: none;
      padding: 8px;
    }
    .promotion-table {
      margin-top: 0;
    }
    .promotion-table td {
      border: 2px solid #000;
      border-right: none;
      padding: 8px;
      padding-left: 3px;
    }
    .checkbox {
      display: inline-block;
      width: 12px;
      height: 12px;
      border: 1px solid #000;
      margin-right: 5px;
      vertical-align: middle;
    }
    .dashed-line {
      border-bottom: 1px dashed #000;
      display: inline-block;
      min-width: 200px;
      margin-left: 8px;
    }
    .dotted-line {
      border-bottom: 1px dotted #000;
      display: inline-block;
      min-width: 200px;
      margin-left: 5px;
    }
    .small-text {
      font-size: 9px;
      color: #666;
    }
    .right-column-full {
      border: 2px solid #000;
      padding: 11px;
      height: 310px;
      margin-left: -4px
    }
    .total-section {
      margin: 8px 0;
    }
    .total-line {
      display: flex;
      justify-content: space-between;
      margin: 3px 0;
    }

    /* Footer styles */
    .footer-wrapper {
      margin-top: 5px;
      width: 100%;
      display: flex;
    }
    .footer-cs {
      padding: 10px;
      width: 25%;
      vertical-align: top;
    }
    .footer-pelanggan {
      padding: 10px;
      width: 37.5%;
      text-align: center;
      vertical-align: top;
    }
    .footer-pt {
      padding: 10px;
      width: 37.5%;
      text-align: center;
      vertical-align: top;
    }

    .footer-cs div:last-child {
      border: 1px solid #000;
      padding: 10px;
      font-size: 10px;
    }

    @page { size: A4; margin: 0; }
    @media print {
      body { background: none; }
      .a4 { box-shadow: none; margin: 0; }
      .no-print {
        display: none !important;
      }
    }
  </style>
</head>
<body>
<div class="a4">

  <!-- HEADER -->
  <table>
    <tr>
      <td class="no-border" style="width:50%;"><strong style="font-size:20px;">GPM</strong></td>
      <td class="no-border" style="width:25%; text-align:right;">Tanggal Daftar: {{ $transaksi->tanggal_daftar ? \Carbon\Carbon::parse($transaksi->tanggal_daftar)->format('d/m/Y') : '_/_/20....' }}</td>
      <td class="no-border" style="width:25%; text-align:right;">No ID: {{ $transaksi->no_id_pelanggan ?? '____' }}</td>
      <a href="javascript:window.print();" class="no-print">Print</a>
    </tr>
    <tr>
      <td colspan="3" class="no-border title">FORMULIR BERLANGGANAN</td>
    </tr>
  </table>

  <!-- DATA PELANGGAN -->
  <table>
    <tr>
      <td class="label">Nama Lengkap sesuai KTP</td>
      <td class="input-cell">
        <div class="split">
          <div class="left">{{ $transaksi->pelanggan->nama_lengkap ?? '' }}</div>
          <div class="right">
            <div class="opts">
              <label>L <input class="small-checkbox" type="checkbox" {{ ($transaksi->pelanggan->jenis_kelamin ?? '') == 'L' ? 'checked' : '' }} disabled></label>
              <label>P <input class="small-checkbox" type="checkbox" {{ ($transaksi->pelanggan->jenis_kelamin ?? '') == 'P' ? 'checked' : '' }} disabled></label>
              <label><input class="small-checkbox" type="checkbox" {{ ($transaksi->pelanggan->status_pernikahan ?? '') == 'Menikah' ? 'checked' : '' }} disabled> Menikah</label>
              <label><input class="small-checkbox" type="checkbox" {{ ($transaksi->pelanggan->status_pernikahan ?? '') == 'Belum Menikah' ? 'checked' : '' }} disabled> Belum Menikah</label>
            </div>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td class="label">Alamat Instalasi</td>
      <td class="input-cell"><div style="padding:6px;">{{ $transaksi->pelanggan->alamat_instalasi ?? '' }}</div></td>
    </tr>
    <tr>
      <td class="label">Kota</td>
      <td class="input-cell">
        <div class="two-cols">
          <div class="c1">{{ $transaksi->pelanggan->kabupatenInstalasi->name ?? '' }}</div>
          <div class="c2">Propinsi: {{ $transaksi->pelanggan->provinsiInstalasi->name ?? '' }}</div>
          <div class="c3">Kode Pos: {{ $transaksi->pelanggan->kodepos_instalasi ?? '' }}</div>
        </div>
      </td>
    </tr>
    <tr>
      <td class="label">Nomor Telepon</td>
      <td class="input-cell">
        <div class="two-cols">
          <div class="c1">{{ $transaksi->pelanggan->nomor_telepon ?? '' }}</div>
          <div class="c2">No Fax: {{ $transaksi->pelanggan->no_fax ?? '' }}</div>
          <div class="c3">No Ponsel: {{ $transaksi->pelanggan->nomor_ponsel ?? '' }}</div>
        </div>
      </td>
    </tr>
    <tr>
      <td class="label">Nomor KTP</td>
      <td class="input-cell"><div style="padding:6px;">{{ $transaksi->pelanggan->no_ktp ?? '' }}</div></td>
    </tr>
    <tr>
      <td class="label">Tempat/Tgl Lahir</td>
      <td class="input-cell"><div style="padding:6px;">{{ ($transaksi->pelanggan->tempat_lahir ?? '') . ($transaksi->pelanggan->tanggal_lahir ? ', ' . \Carbon\Carbon::parse($transaksi->pelanggan->tanggal_lahir)->format('d/m/Y') : '') }}</div></td>
    </tr>
    <tr>
      <td class="label">Alamat sesuai KTP</td>
      <td class="input-cell"><div style="padding:6px;">{{ $transaksi->pelanggan->alamat_ktp ?? '' }}</div></td>
    </tr>
    <tr>
      <td class="label">Kota</td>
      <td class="input-cell">
        <div class="two-cols">
          <div class="c1">{{ $transaksi->pelanggan->kabupatenKtp->name ?? '' }}</div>
          <div class="c2">Propinsi: {{ $transaksi->pelanggan->provinsiKtp->name ?? '' }}</div>
          <div class="c3">Kode Pos: {{ $transaksi->pelanggan->kodepos_ktp ?? '' }}</div>
        </div>
      </td>
    </tr>
    <tr>
      <td class="label">Pekerjaan</td>
      <td class="input-cell">
        <div style="padding:6px;">
          <label><input class="small-checkbox" type="checkbox" {{ ($transaksi->pelanggan->pekerjaan ?? '') == 'Wiraswasta' ? 'checked' : '' }} disabled> Wiraswasta</label>&nbsp;&nbsp;
          <label><input class="small-checkbox" type="checkbox" {{ ($transaksi->pelanggan->pekerjaan ?? '') == 'Karyawan' ? 'checked' : '' }} disabled> Karyawan</label>&nbsp;&nbsp;
          <label><input class="small-checkbox" type="checkbox" {{ ($transaksi->pelanggan->pekerjaan ?? '') == 'Ibu Rumah Tangga' ? 'checked' : '' }} disabled> Ibu Rumah Tangga</label>&nbsp;&nbsp;
          <label><input class="small-checkbox" type="checkbox" {{ !in_array($transaksi->pelanggan->pekerjaan ?? '', ['Wiraswasta', 'Karyawan', 'Ibu Rumah Tangga']) && $transaksi->pelanggan->pekerjaan ? 'checked' : '' }} disabled> Lainnya {{ $transaksi->pelanggan->pekerjaan ?? '' }}</label>
        </div>
      </td>
    </tr>
    <tr>
      <td class="label">Jenis Tempat Tinggal</td>
      <td class="input-cell">
        <div style="padding:6px;">
          <label><input class="small-checkbox" type="checkbox" {{ ($transaksi->pelanggan->jenis_tempat_tinggal ?? '') == 'Rumah Tinggal' ? 'checked' : '' }} disabled> Rumah Tinggal</label>&nbsp;&nbsp;
          <label><input class="small-checkbox" type="checkbox" {{ ($transaksi->pelanggan->jenis_tempat_tinggal ?? '') == 'Apartemen' ? 'checked' : '' }} disabled> Apartemen</label>&nbsp;&nbsp;
          <label><input class="small-checkbox" type="checkbox" {{ !in_array($transaksi->pelanggan->jenis_tempat_tinggal ?? '', ['Rumah Tinggal', 'Apartemen']) && $transaksi->pelanggan->jenis_tempat_tinggal ? 'checked' : '' }} disabled> Lainnya {{ $transaksi->pelanggan->jenis_tempat_tinggal ?? '' }}</label>
        </div>
      </td>
    </tr>
  </table>

  <!-- REVISI: PAKET INTERNET + METODE BILLING -->
  <div class="box">
    <div class="section">
      <b>Kebutuhan Bandwidth</b>
      <label><input type="checkbox" {{ ($transaksi->bandwidth->bandwidth ?? '') == '5 Mbps' ? 'checked' : '' }} disabled> 5 Mbps</label>
      <label><input type="checkbox" {{ ($transaksi->bandwidth->bandwidth ?? '') == '10 Mbps' ? 'checked' : '' }} disabled> 10 Mbps</label>
      <label><input type="checkbox" {{ ($transaksi->bandwidth->bandwidth ?? '') == '20 Mbps' ? 'checked' : '' }} disabled> 20 Mbps</label>
      <div class="lainnya">Lainnya <span class="dots">{{ $transaksi->bandwidth_manual ?? '' }}</span></div>
    </div>
    <div class="line"></div>
    <div class="section paket-internet">
      <b>Paket Internet</b>
      <label><input type="checkbox" {{ ($transaksi->paket->paket_internet ?? '') == 'Silver' ? 'checked' : '' }} disabled> Silver</label>
      <label><input type="checkbox" {{ ($transaksi->paket->paket_internet ?? '') == 'Gold' ? 'checked' : '' }} disabled> Gold</label>
      <label><input type="checkbox" {{ ($transaksi->paket->paket_internet ?? '') == 'Platinum' ? 'checked' : '' }} disabled> Platinum</label>
      <div class="lainnya">Lainnya <span class="dots">{{ $transaksi->paket_internet_custom ?? '' }}</span></div>
    </div>
    <div class="line"></div>
    <div class="section3">
      <b>Pilihan Paket Internet</b>
      &nbsp; Nama Paket : <span class="dots" style="width: 212px;">{{ $transaksi->paket_internet_id ? ($transaksi->paket->paket_internet ?? '') : ($transaksi->paket_internet_custom ?? '') }}</span>
      &nbsp;&nbsp; Harga : Rp <span class="dots" style="width: 180px;">{{ number_format($transaksi->paket_internet_id ? ($transaksi->paket->harga ?? 0) : ($transaksi->paket_internet_harga_custom ?? 0), 0, ',', '.') }}</span>
    </div>
  </div>

  <div class="box">
    <div class="section4"><b>Metode Billing:</b></div>
    <div class="section4 row">
      <div class="col"><label><input type="checkbox" {{ ($transaksi->metode_billing ?? '') == 'Cetak' ? 'checked' : '' }} disabled> Cetak</label></div>
      <div class="col" style="text-align:left;"><label><input type="checkbox" {{ ($transaksi->metode_billing ?? '') == 'E-Billing' ? 'checked' : '' }} disabled> E-Billing</label></div>
    </div>
    <div class="section4 row">
      <div class="col">Alamat Penagihan: <span class="dots" style="width: 200px;">{{ $transaksi->alamat_penagihan ?? '' }}</span></div>
      <div class="col" style="text-align:left;">Email: <span class="dots" style="width: 250px;">{{ $transaksi->email_penagihan ?? '' }}</span></div>
    </div>
  </div>

  <!-- PEMBAYARAN + TOTAL BIAYA -->
  <div class="form-wrapper">
    <!-- SECTION KIRI -->
    <div class="left-section">
      <!-- TABEL PEMBAYARAN -->
      <table class="payment-table">
        <tr>
          <td>
            <div style="font-weight: bold; margin-bottom: 8px;">Pilihan Cara Pembayaran:</div>

            <!-- Baris pertama -->
            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
              <div>
                <span class="checkbox {{ ($transaksi->metode_pembayaran ?? '') == 'Transfer' ? 'checked' : '' }}"></span> Transfer
              </div>
              <div class="small-text" style="margin-left: auto;">
                *Melampirkan foto copy kartu kredit
              </div>
            </div>

            <!-- Baris kedua -->
            <div style="margin-bottom: 5px;">
              <span class="checkbox {{ ($transaksi->metode_pembayaran ?? '') == 'Auto Debit Kartu Kredit' ? 'checked' : '' }}"></span> Auto Debit Kartu Kredit
              <span style="margin-left: 63px;">
                <span class="checkbox {{ !in_array($transaksi->metode_pembayaran ?? '', ['Transfer', 'Auto Debit Kartu Kredit', 'BCA Card', 'Visa Card', 'Master Card']) && $transaksi->metode_pembayaran ? 'checked' : '' }}"></span> Lainnya
              </span>
            </div>

            <!-- Baris ketiga -->
            <div style="margin-bottom: 5px; margin-left: 20px;">
              <span class="checkbox {{ ($transaksi->metode_pembayaran ?? '') == 'BCA Card' ? 'checked' : '' }}"></span> BCA Card
              <span style="margin-left: 30px;">*</span>
              <span style="margin-left: 12px;">
                <span class="checkbox {{ ($transaksi->metode_pembayaran ?? '') == 'Visa Card' ? 'checked' : '' }}"></span> Visa Card
              </span>
            </div>

            <!-- Baris keempat -->
            <div style="margin-left: 20px; margin-bottom: 10px;">
              <span class="checkbox {{ ($transaksi->metode_pembayaran ?? '') == 'Master Card' ? 'checked' : '' }}"></span> Master Card
            </div>

            <!-- Field input -->
            <div style="margin-bottom: 5px; display: flex; align-items: center;">
              <span>Nomor Kartu Kredit</span>
              <span style="margin-left: 15px;">:</span>
              <span class="dashed-line" style="min-width: 210px;">{{ $transaksi->nomor_kartu_kredit ?? '' }}</span>
            </div>

            <div style="margin-bottom: 5px; display: flex; align-items: center;">
              <span>Masa berlaku kartu</span>
              <span style="margin-left: 15px;">:</span>
              <span class="dashed-line" style="min-width: 210px;">{{ $transaksi->masa_berlaku_kartu ?? '' }}</span>
            </div>
          </td>
        </tr>
      </table>

      <!-- TABEL PROMOSI -->
      <table class="promotion-table">
        <tr>
          <td>
            <div style="margin-bottom: 8px;">
              <div><span style="font-weight: bold;">Kode Promosi</span><span style="margin-left: 28px; font-weight: bold;">:</span></div>
              <span class="dotted-line" style="min-width: 340px;">{{ $transaksi->promosi->kode_promosi ?? '' }}</span>
            </div>

            <div style="margin-bottom: 8px;">
              <div><span style="font-weight: bold;">Program Promosi</span><span style="margin-left: 9px; font-weight: bold;">:</span></div>
              <span class="dotted-line" style="min-width: 340px;">{{ $transaksi->promosi->program_promosi ?? '' }}</span>
            </div>

            <div style="margin-bottom: 8px;">
              <div><span style="font-weight: bold;">Periode</span><span style="margin-left: 65px; font-weight: bold;">:</span></div>
              <div style="margin-top: 3px; position: relative;">
                <span class="dotted-line" style="min-width: 340px;">{{ $transaksi->promosi ? (\Carbon\Carbon::parse($transaksi->promosi->periode_mulai)->format('d/m/Y') . ' s/d ' . \Carbon\Carbon::parse($transaksi->promosi->periode_selesai)->format('d/m/Y')) : '' }}</span>
              </div>
            </div>

            <div style="margin-bottom: 5px;">
              <div><span style="font-weight: bold;">Note</span><span style="margin-left: 83px; font-weight: bold;">:</span></div>
              <span class="dotted-line" style="min-width: 340px;">{{ $transaksi->promosi->note ?? '' }}</span>
            </div>
          </td>
        </tr>
      </table>
    </div>

    <!-- SECTION KANAN - TOTAL BIAYA -->
    <div class="right-section">
      <div class="right-column-full">
        <div style="font-weight: bold; margin-top: 20px; margin-bottom: 10px;">Total Biaya Berlangganan Per Bulan: <span class="small-text" style="margin-left: 10px;">*Kosongkan jika tidak ada</span></div>

        <div class="total-section">
          <div class="total-line">
            <span>Biaya Registrasi</span>
            <span>= Rp <span class="dashed-line" style="min-width: 160px;">{{ number_format($transaksi->biaya_registrasi ?? 0, 0, ',', '.') }}</span></span>
          </div>
          <div class="small-text">( untuk biaya awal saja )</div>

          <div class="total-line" style="margin-top: 10px;">
            <span>Biaya Paket Internet</span>
            <span>= Rp <span class="dashed-line" style="min-width: 160px;">{{ number_format($transaksi->biaya_paket_internet ?? 0, 0, ',', '.') }}</span></span>
          </div>
          <div class="small-text">( Untuk paket perbulan )</div>

          <div class="total-line" style="margin-top: 10px;">
            <span>Biaya Maintenance</span>
            <span>= Rp <span class="dashed-line" style="min-width: 160px;">{{ number_format($transaksi->biaya_maintenance ?? 0, 0, ',', '.') }}</span></span>
          </div>
          <div class="small-text">( Untuk Biaya Pemeliharaan jika ada )</div>

          <div class="total-line" style="margin-top: 10px;">
            <span>PPN 10%</span>
            <span>= Rp <span class="dashed-line" style="min-width: 160px;">{{ number_format($transaksi->ppn_nominal ?? 0, 0, ',', '.') }}</span></span>
          </div>

          <div style="margin: 20px 0;">
            <div style="border-top: 2px solid #000; width: 150px; margin-left: 165px; position: relative; margin-bottom: 15px;">
              <span style="position: absolute; right: -15px; top: -12px; font-size: 14px; font-weight: bold;">+</span>
            </div>
            <div style="display: flex; justify-content: flex-end; align-items: center;">
              <span style="font-size: 14px; margin-right: 10px;"><strong>Total</strong></span>
              <span>= Rp <span class="dashed-line" style="min-width: 160px;">{{ number_format($transaksi->total_biaya_per_bulan ?? 0, 0, ',', '.') }}</span></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- SECTION BAWAH - CUSTOMER SERVICE DAN TANDA TANGAN -->
  <div class="footer-wrapper">
    <!-- Customer Service -->
    <div class="footer-cs">
      <div style="margin-bottom: 3px;">Customer Service:</div>
      <div style="margin-bottom: 15px;">0853-5254-5016</div>
      <div style="border: 1px solid #000; padding: 10px; font-size: 10px;">
        <div style="font-weight: bold; margin-bottom: 3px;">Lembar 1: Customer Service</div>
        <div style="font-weight: bold; margin-bottom: 3px;">Lembar 2: Pelanggan</div>
        <div style="font-weight: bold; margin-bottom: 3px;">Lembar 3: Arsip Office</div>
      </div>
    </div>

    <!-- Pelanggan -->
    <div class="footer-pelanggan">
      <div style="font-weight: bold; font-size: 12px; margin-bottom: 40px;">Pelanggan</div>
      <div style="margin-top: 40px;">
        <div style="margin-bottom: 5px; height: 35px;"></div>
        <div style="font-size: 12px;">Nama dan Tanda Tangan</div>
      </div>
    </div>

    <!-- PT. Giga Patra Multimedia -->
    <div class="footer-pt">
      <div style="font-weight: bold; font-size: 12px; margin-bottom: 5px;">PT. Giga Patra Multimedia</div>
      <div style="margin-bottom: 40px; font-size: 12px;">Happyhome</div>
      <div style="margin-top: 20px;">
        <div style="margin-bottom: 5px; height: 17px;"></div>
        <div style="font-size: 12px;">Nama dan Tanda Tangan</div>
      </div>
    </div>
  </div>

</div>
</body>
</html>
