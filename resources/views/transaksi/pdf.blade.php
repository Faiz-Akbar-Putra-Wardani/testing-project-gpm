<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Formulir Berlangganan - PDF Optimized</title>
  <style>
    /* Optimized for single-page PDF generation */
    body {
      font-family: Arial, sans-serif;
      font-size: 10px; /* Reduced from 12px */
      margin: 0;
      padding: 0;
      background: #fff;
      line-height: 1.2; /* Tighter line height */
    }

    .a4 {
      width: 19cm; /* Slightly smaller to ensure margins */
      max-height: 27cm; /* Strict height limit */
      margin: 0.5cm auto;
      background: #fff;
      padding: 0.5cm; /* Reduced padding */
      box-sizing: border-box;
      overflow: hidden; /* Prevent overflow */
    }

    /* Simplified table styling for better PDF compatibility */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 3px; /* Reduced spacing */
    }

    td, th {
      border: 1px solid #000; /* Thinner borders */
      padding: 2px 4px; /* Much smaller padding */
      vertical-align: middle;
      font-size: 10px;
    }

    .no-border {
      border: none !important;
    }

    .title {
      font-size: 14px; /* Reduced from 16px */
      font-weight: bold;
      text-align: center;
      margin: 5px 0;
    }

    /* Simplified input styling */
    input[type="text"] {
      border: none;
      outline: none;
      width: 100%;
      height: 16px; /* Reduced height */
      box-sizing: border-box;
      font-size: 10px;
    }

    /* Improved checkbox styling for better alignment */
    input[type="checkbox"] {
      width: 12px;
      height: 12px;
      vertical-align: middle;
      margin: 0 3px 0 0;
      position: relative;
      top: -1px;
    }

    /* Better label styling for checkbox groups */
    label {
      display: inline-block;
      margin-right: 15px;
      margin-bottom: 2px;
      font-size: 9px;
      vertical-align: middle;
      white-space: nowrap;
    }

    /* Specific styling for checkbox rows to ensure proper alignment */
    .checkbox-row {
      display: block;
      line-height: 1.4;
      margin: 1px 0;
    }

    .checkbox-row label {
      margin-right: 20px;
      vertical-align: top;
    }

    /* Simplified layout without flexbox */
    .label {
      width: 180px; /* Reduced width */
      font-weight: bold;
      padding: 3px;
      border-right: 1px solid #000;
      vertical-align: top;
    }

    .input-cell {
      padding: 3px;
      vertical-align: middle;
    }

    /* Replace flexbox with simple table layout */
    .gender-status {
      float: right;
      font-size: 9px;
    }

    /* Improved gender status checkbox alignment */
    .gender-status input[type="checkbox"] {
      margin: 0 2px;
      vertical-align: baseline;
    }

    .three-col {
      display: table;
      width: 100%;
      table-layout: fixed;
    }

    .three-col > div {
      display: table-cell;
      padding: 2px;
      border-left: 1px solid #000;
    }

    .three-col > div:first-child {
      border-left: none;
    }

    /* Compact box styling */
    .box {
      border: 1px solid #000;
      padding: 5px; /* Reduced padding */
      margin: 3px 0; /* Reduced margin */
      font-size: 10px;
    }

    .section {
      margin-bottom: 8px; /* Reduced spacing */
    }

    /* Removed conflicting label styling from section */
    .section label {
      margin-right: 15px;
      font-size: 9px;
      display: inline-block;
      vertical-align: middle;
    }

    .line {
      border-top: 1px solid #000;
      margin: 5px 0;
    }

    .dots {
      border-bottom: 1px dotted #000;
      display: inline-block;
      min-width: 80px; /* Reduced width */
    }

    /* Simplified two-column layout for payment section */
    .payment-section {
      display: table;
      width: 100%;
      margin: 5px 0;
    }

    .payment-left {
      display: table-cell;
      width: 55%;
      border: 1px solid #000;
      padding: 5px;
      vertical-align: top;
    }

    .payment-right {
      display: table-cell;
      width: 45%;
      border: 1px solid #000;
      border-left: none;
      padding: 5px;
      vertical-align: top;
    }

    /* Improved payment option styling for better checkbox alignment */
    .payment-option {
      margin: 3px 0;
      font-size: 9px;
      line-height: 1.3;
      display: block;
    }

    .payment-option input[type="checkbox"] {
      margin-right: 5px;
      vertical-align: middle;
    }

    .total-line {
      margin: 3px 0;
      font-size: 9px;
    }

    .dashed-line {
      border-bottom: 1px dashed #000;
      display: inline-block;
      min-width: 60px; /* Reduced width */
    }

    /* Print-specific optimizations */
    @page {
      size: A4;
      margin: 0.5cm;
    }

    @media print {
      body {
        background: none;
        font-size: 9px; /* Even smaller for print */
      }
      .a4 {
        box-shadow: none;
        margin: 0;
        max-height: none;
      }
    }
  </style>
</head>
<body>
   @if(empty($isPdf))
    <a href="{{ route('transaksi.export-pdf', $transaksi->id) }}"
       class="btn btn-sm btn-outline-danger">
        <i class="bi bi-download"></i> Download PDF
    </a>
@endif
<div class="a4">

  <!-- Compact header -->
  <table style="margin-bottom: 5px;">
    <tr>
      <td class="no-border" style="width:40%;"><strong style="font-size:16px;">GPM</strong></td>
      <td class="no-border" style="width:35%; text-align:center; font-size:9px;">Tanggal Daftar: {{ \Carbon\Carbon::parse($transaksi->tanggal_daftar)->format("d/m/Y") ?? "_/_/...." }}</td>
      <td class="no-border" style="width:25%; text-align:right; font-size:9px;">No ID: {{ $transaksi->no_id_pelanggan ?? "____" }}</td>
    </tr>
    <tr>
      <td colspan="3" class="no-border title">FORMULIR BERLANGGANAN</td>
    </tr>
  </table>

  <!-- Compact data pelanggan section -->
  <table style="margin-bottom: 5px;">
    <tr>
      <td class="label">Nama Lengkap sesuai KTP</td>
      <td class="input-cell">
        <input type="text" style="width: 60%;" value="{{ $transaksi->pelanggan->nama_lengkap ?? "" }}">
       <span class="gender-status">
            L <input class="small-checkbox" type="checkbox" {{ ($transaksi->pelanggan->jenis_kelamin ?? "") == "L" ? "checked" : "" }}>
            P <input class="small-checkbox" type="checkbox" {{ ($transaksi->pelanggan->jenis_kelamin ?? "") == "P" ? "checked" : "" }}>

            <input class="small-checkbox" type="checkbox" {{ ($transaksi->pelanggan->status_pernikahan ?? "") == "Menikah" ? "checked" : "" }}> Menikah
            <input class="small-checkbox" type="checkbox" {{ ($transaksi->pelanggan->status_pernikahan ?? "") == "Belum Menikah" ? "checked" : "" }}> Belum Menikah
        </span>

      </td>
    </tr>
    <tr>
      <td class="label">Alamat Instalasi</td>
      <td class="input-cell"><input type="text" value="{{ $transaksi->pelanggan->alamat_instalasi ?? "" }}"></td>
    </tr>
    <tr>
      <td class="label">Kota</td>
      <td class="input-cell">
        <div class="three-col">
          <div><input type="text" value="{{ $transaksi->pelanggan->kabupatenInstalasi->name ?? "" }}"></div>
          <div>Propinsi: <input type="text" style="width:60px;" value="{{ $transaksi->pelanggan->provinsiInstalasi->name ?? "" }}"></div>
          <div>Kode Pos: <input type="text" style="width:60px;" value="{{ $transaksi->pelanggan->kodepos_instalasi ?? "" }}"></div>
        </div>
      </td>
    </tr>
    <tr>
      <td class="label">Nomor Telepon</td>
      <td class="input-cell">
        <div class="three-col">
          <div><input type="text" value="{{ $transaksi->pelanggan->nomor_telepon ?? "" }}"></div>
          <div>No Fax: <input type="text" style="width:60px;" value="{{ $transaksi->pelanggan->no_fax ?? '' }}"></div>
          <div>No Ponsel: <input type="text" style="width:60px;" value="{{ $transaksi->pelanggan->nomor_ponsel ?? "" }}" ></div>
        </div>
      </td>
    </tr>
    <tr><td class="label">Nomor KTP</td><td class="input-cell"><input type="text" value={{ $transaksi->pelanggan->no_ktp ?? "" }}></td></tr>
    <tr><td class="label">Tempat/Tgl Lahir</td><td class="input-cell"><input type="text" value="{{ ($transaksi->pelanggan->tempat_lahir ?? '') . '/' . (\Carbon\Carbon::parse($transaksi->pelanggan->tanggal_lahir)->format('d/m/Y') ?? '') }}"></td></tr>
    <tr><td class="label">Alamat sesuai KTP</td><td class="input-cell"><input type="text" value="{{ $transaksi->pelanggan->alamat_ktp ?? '' }}" ></td></tr>
    <tr>
      <td class="label">Kota</td>
      <td class="input-cell">
        <div class="three-col">
          <div><input type="text" value="{{ $transaksi->pelanggan->kabupatenKtp->name ?? '' }}"></div>
          <div>Propinsi: <input type="text" style="width:60px;" value="{{ $transaksi->pelanggan->provinsiKtp->name ?? '' }}"></div>
          <div>Kode Pos: <input type="text" style="width:60px;" value="{{ $transaksi->pelanggan->kodepos_ktp ?? '' }}"></div>
        </div>
      </td>
    </tr>
    <tr>
      <td class="label">Pekerjaan</td>
      <td class="input-cell">
        <!-- Wrapped checkboxes in checkbox-row div for better alignment -->
        <div class="checkbox-row">
          <label><input type="checkbox" {{ ($transaksi->pelanggan->pekerjaan ?? '') == 'Wiraswasta' ? 'checked' : '' }}> Wiraswasta</label>
          <label><input type="checkbox"{{ ($transaksi->pelanggan->pekerjaan ?? '') == 'Karyawan' ? 'checked' : '' }}> Karyawan</label>
          <label><input type="checkbox" {{ ($transaksi->pelanggan->pekerjaan ?? '') == 'Ibu Rumah Tangga' ? 'checked' : '' }}> Ibu Rumah Tangga</label>
          <label><input type="checkbox" {{ !in_array(($transaksi->pelanggan->pekerjaan ?? ''), ['Wiraswasta', 'Karyawan', 'Ibu Rumah Tangga']) ? 'checked' : '' }}> Lainnya <span class="dots" style="width: 80px;">{{ !in_array(($transaksi->pelanggan->pekerjaan ?? ''), ['Wiraswasta', 'Karyawan', 'Ibu Rumah Tangga']) ? ($transaksi->pelanggan->pekerjaan ?? '') : '' }}</span></label>
        </div>
      </td>
    </tr>
    <tr>
      <td class="label">Jenis Tempat Tinggal</td>
      <td class="input-cell">
        <!-- Wrapped checkboxes in checkbox-row div for better alignment -->
        <div class="checkbox-row">
          <label><input type="checkbox"  {{ ($transaksi->pelanggan->jenis_tempat_tinggal ?? '') == 'Rumah Tinggal' ? 'checked' : '' }}> Rumah Tinggal</label>
          <label><input type="checkbox" {{ ($transaksi->pelanggan->jenis_tempat_tinggal ?? '') == 'Apartemen' ? 'checked' : '' }}> Apartemen</label>
          <label><input type="checkbox"{{ !in_array(($transaksi->pelanggan->jenis_tempat_tinggal ?? ''), ['Rumah Tinggal', 'Apartemen']) ? 'checked' : '' }}> Lainnya <span class="dots" style="width: 80px;">{{ !in_array(($transaksi->pelanggan->jenis_tempat_tinggal ?? ''), ['Rumah Tinggal', 'Apartemen']) ? ($transaksi->pelanggan->jenis_tempat_tinggal ?? '') : '' }}</span></label>
        </div>
      </td>
    </tr>
  </table>

  <!-- Compact paket section -->
  <div class="box">
    <div class="section">
      <strong>Kebutuhan Bandwidth</strong>
      <!-- Improved checkbox layout in bandwidth section -->
      <label><input type="checkbox" {{ ($transaksi->bandwidth->nilai ?? '') == '5 Mbps' ? 'checked' : '' }}> 5 Mbps</label>
      <label><input type="checkbox" {{ ($transaksi->bandwidth->nilai ?? '') == '10 Mbps' ? 'checked' : '' }}> 10 Mbps</label>
      <label><input type="checkbox" {{ ($transaksi->bandwidth->nilai ?? '') == '20 Mbps' ? 'checked' : '' }}> 20 Mbps</label>
      <span style="float:right;">Lainnya <span class="dots">{{ ($transaksi->bandwidth_manual ?? '') != '' ? $transaksi->bandwidth_manual : '' }}</span></span>
    </div>
    <div class="line"></div>
    <div class="section">
      <strong>Paket Internet</strong>
      <!-- Improved checkbox layout in internet package section -->
      <label><input type="checkbox" {{ ($transaksi->paket->paket_internet ?? '') == 'Silver' ? 'checked' : '' }}> Silver</label>
      <label><input type="checkbox" {{ ($transaksi->paket->paket_interent ?? '') == 'Gold' ? 'checked' : '' }}> Gold</label>
      <label><input type="checkbox" {{ ($transaksi->paket->paket_internet ?? '') == 'Platinum' ? 'checked' : '' }}> Platinum</label>
      <span style="float:right;">Lainnya <span class="dots">{{ ($transaksi->paket_internet_custom ?? '') != '' ? $transaksi->paket_internet_custom : '' }}</span></span>
    </div>
    <div class="line"></div>
    <div class="section">
      <strong>Pilihan Paket Internet</strong>
      Nama Paket: <span class="dots" style="width:120px;">{{ $transaksi->paket->nama_paket ?? $transaksi->paket_internet_custom ?? '' }}</span>
      Harga: Rp <span class="dots" style="width:100px;">{{ number_format($transaksi->paket->harga ?? $transaksi->paket_internet_harga_custom ?? 0, 0, ',', '.') }}</span>
    </div>
  </div>

  <!-- Compact billing section -->
  <div class="box">
    <div class="section">
      <strong>Metode Billing:</strong>
      <!-- Improved checkbox layout in billing section -->
      <label><input type="checkbox" {{ ($transaksi->metode_billing ?? '') == 'Cetak' ? 'checked' : '' }}> Cetak</label>
      <label><input type="checkbox"  {{ ($transaksi->metode_billing ?? '') == 'E-Billing' ? 'checked' : '' }}> E-Billing</label>
    </div>
    <div class="section">
      Alamat Penagihan: <span class="dots" style="width:150px;">{{ $transaksi->alamat_penagihan ?? '' }}</span>
      Email: <span class="dots" style="width:120px;">{{ $transaksi->email_penagihan ?? '' }}</span>
    </div>
  </div>

  <!-- Compact payment and total section -->
  <div class="payment-section">
    <div class="payment-left">
      <div style="font-weight:bold; margin-bottom:5px;">Pilihan Cara Pembayaran:</div>

<div class="payment-option">
  <input type="checkbox" {{ ($transaksi->metode_pembayaran ?? '') == 'Transfer' ? 'checked' : '' }}>
  Transfer
  <span style="font-size:8px;">*Melampirkan foto copy kartu kredit</span>
</div>

    <div class="payment-option">
    <input type="checkbox" {{ ($transaksi->metode_pembayaran ?? '') == 'Auto Debit Kartu Kredit' ? 'checked' : '' }}>
    Auto Debit Kartu Kredit

    <input type="checkbox" {{ !in_array(($transaksi->metode_pembayaran ?? ''), ['Transfer','Auto Debit Kartu Kredit','BCA Card','Visa Card','Master Card']) ? 'checked' : '' }}>
    Lainnya
    </div>

    <div class="payment-option" style="margin-left:15px;">
    <input type="checkbox" {{ ($transaksi->metode_pembayaran ?? '') == 'BCA Card' ? 'checked' : '' }}>
    BCA Card *

    <input type="checkbox" {{ ($transaksi->metode_pembayaran ?? '') == 'Visa Card' ? 'checked' : '' }}>
    Visa Card
    </div>

    <div class="payment-option" style="margin-left:15px;">
    <input type="checkbox" {{ ($transaksi->metode_pembayaran ?? '') == 'Master Card' ? 'checked' : '' }}>
    Master Card
    </div>

      <div style="margin:3px 0;">Nomor Kartu Kredit: <span class="dashed-line" style="width:100px;">{{ $transaksi->nomor_kartu_kredit ?? '' }}</span></div>
      <div style="margin:3px 0;">Masa berlaku kartu: <span class="dashed-line" style="width:100px;">{{ $transaksi->masa_berlaku_kartu ?? '' }}</span></div>
      <div style="margin:5px 0;">
        <div><strong>Kode Promosi:</strong> <span class="dots" style="width:120px;">{{ $transaksi->promosi->kode_promosi ?? '' }}</span>
        </div>
        <div><strong>Program Promosi:</strong> <span class="dots" style="width:100px;">{{ $transaksi->promosi->nama_program_promosi ?? '' }}</span>
        </div>
        <div><strong>Periode:</strong> <span class="dots" style="width:80px;">{{ $transaksi->promosi->tanggal_mulai ?? '' }}</span> s/d <span class="dots" style="width:80px;">{{ $transaksi->promosi->tanggal_berakhir ?? '' }}</span></div>
        <div><strong>Note:</strong> <span class="dots" style="width:150px;">{{ $transaksi->promosi->note ?? '' }}</span></div>
      </div>
    </div>

    <div class="payment-right">
      <div style="font-weight:bold; margin-bottom:5px;">Total Biaya Berlangganan Per Bulan:</div>
      <div style="font-size:8px; margin-bottom:5px;">*Kosongkan jika tidak ada</div>

      <div class="total-line">Biaya Registrasi = Rp <span class="dashed-line">{{ number_format($transaksi->biaya_registrasi ?? 0, 0, ',', '.') }}</span></div>
      <div style="font-size:8px;">(untuk biaya awal saja)</div>

      <div class="total-line">Biaya Paket Internet = Rp <span class="dashed-line">{{ number_format($transaksi->biaya_paket_internet ?? 0, 0, ',', '.') }}</span></div>
      <div style="font-size:8px;">(Untuk paket perbulan)</div>

      <div class="total-line">Biaya Maintenance = Rp <span class="dashed-line">{{ number_format($transaksi->biaya_maintenance ?? 0, 0, ',', '.') }}</span></div>
      <div style="font-size:8px;">(Untuk Biaya Pemeliharaan jika ada)</div>

      <div class="total-line">PPN 10% = Rp <span class="dashed-line">{{ number_format($transaksi->ppn_nominal ?? 0, 0, ',', '.') }}</span></div>

      <div style="border-top:1px solid #000; margin:5px 0; padding-top:3px;">
        <div class="total-line"><strong>Total = Rp <span class="dashed-line">{{ number_format($transaksi->total_biaya_per_bulan ?? 0, 0, ',', '.') }}</span></strong></div>
      </div>
    </div>
  </div>

  <!-- Compact footer -->
  <div class="footer-section">
    <div class="footer-col">
      <div>Customer Service:</div>
      <div>0853-5254-5016</div>
      <div style="border:1px solid #000; padding:3px; margin-top:5px; font-size:8px;">
        <div>Lembar 1: Customer Service</div>
        <div>Lembar 2: Pelanggan</div>
        <div>Lembar 3: Arsip Office</div>
      </div>
    </div>

    <div class="footer-col">
      <div style="font-weight:bold;">Pelanggan</div>
      <div class="signature-space"></div>
      <div>Nama dan Tanda Tangan</div>
    </div>

    <div class="footer-col">
      <div style="font-weight:bold;">PT.Giga Patra Multimedia</div>
      <div>Happyhome</div>
      <div class="signature-space"></div>
      <div>Nama dan Tanda Tangan</div>
    </div>
  </div>

</div>
</body>
</html>

