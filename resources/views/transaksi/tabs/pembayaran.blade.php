<h6 class="mb-3">Metode Pembayaran</h6>
<div class="row">
  <div class="col-md-4 mb-3">
    <label for="metode_pembayaran" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
    <select class="form-select" id="metode_pembayaran" name="metode_pembayaran">
      <option value="">-- Pilih Metode --</option>
      @foreach($methodPembayaranOptions as $methodPembayaran)
        <option value="{{ $methodPembayaran }}"
          {{ old('metode_pembayaran', $transaksi->metode_pembayaran ?? '') == $methodPembayaran ? 'selected' : '' }}>
          {{ $methodPembayaran }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-md-4 mb-3">
    <label for="nomor_kartu_kredit" class="form-label">No Kartu Kredit <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="nomor_kartu_kredit" name="nomor_kartu_kredit"
      value="{{ old('nomor_kartu_kredit', $transaksi->nomor_kartu_kredit ?? '') }}">
  </div>

  <div class="col-md-4 mb-3">
    <label for="masa_berlaku_kartu" class="form-label">Masa Berlaku Kartu <span class="text-danger">*</span></label>
    <input type="month" class="form-control" id="masa_berlaku_kartu" name="masa_berlaku_kartu"
      value="{{ old('masa_berlaku_kartu', $transaksi->masa_berlaku_kartu ?? '') }}">
  </div>
</div>

<div class="row">
  <div class="col-md-3 mb-3">
    <label for="biaya_registrasi" class="form-label">Biaya Registrasi <span class="text-danger">*</span></label>
    <input type="number" class="form-control" id="biaya_registrasi" name="biaya_registrasi"
      value="{{ old('biaya_registrasi', $transaksi->biaya_registrasi ?? 0) }}">
  </div>

  <div class="col-md-3 mb-3">
    <label for="biaya_paket_internet" class="form-label">Biaya Paket Internet <span class="text-danger">*</span></label>
    <input type="number" class="form-control" id="biaya_paket_internet" name="biaya_paket_internet"
      value="{{ old('biaya_paket_internet', $transaksi->biaya_paket_internet ?? 0) }}">
  </div>

  <div class="col-md-3 mb-3">
    <label for="biaya_maintenance" class="form-label">Biaya Maintenance <span class="text-danger">*</span></label>
    <input type="number" class="form-control" id="biaya_maintenance" name="biaya_maintenance"
      value="{{ old('biaya_maintenance', $transaksi->biaya_maintenance ?? 0) }}">
  </div>
 <div class="col-md-3 mb-3">
     <label for="ppn_nominal" class="form-label">PPN (10%) <span class="text-danger">*</span></label>
    <input type="number" step="0.01" id="ppn_nominal" name="ppn_nominal"
           value="{{ old('ppn_nominal', $transaksi->ppn_nominal ?? 0) }}"
           class="form-control d-none" readonly>
    <div id="display_ppn_nominal" class="form-control">Rp 0</div>
 </div>
</div>

<div class="row">
 <div class="col-md-3 mb-3">
    <label for="total_biaya_per_bulan" class="form-label">Grand Total <span class="text-danger">*</span></label>
    <input type="number" step="0.01" id="total_biaya_per_bulan" name="total_biaya_per_bulan"
           value="{{ old('total_biaya_per_bulan', $transaksi->total_biaya_per_bulan ?? 0) }}"
           class="form-control d-none" readonly>
    <div id="display_total_biaya" class="form-control fw-bold text-primary">Rp 0</div>
</div>
</div>
