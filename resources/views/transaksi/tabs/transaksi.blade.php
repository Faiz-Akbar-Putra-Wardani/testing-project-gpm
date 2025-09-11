<h6 class="mb-3">Data Transaksi</h6>
<div class="row">
 {{-- No ID Pelanggan --}}
  <div class="col-md-3 mb-3">
    <label for="no_id_pelanggan" class="form-label">No ID Pelanggan <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="no_id_pelanggan" name="no_id_pelanggan"
     value="{{ old('no_id_pelanggan', $transaksi->no_id_pelanggan ?? $generatedId) }}"
      readonly>
  </div>

  <div class="col-md-3 mb-3">
    <label for="tanggal_daftar" class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
    <input type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar"
      value="{{ old('tanggal_daftar', $transaksi->tanggal_daftar ?? '') }}">
  </div>

  <div class="col-md-3 mb-3">
    <label for="paket_internet_id" class="form-label">Paket Internet <span class="text-danger">*</span></label>
    <select class="form-select" id="paket_internet_id" name="paket_internet_id" required>
    <option value="">-- Pilih Paket --</option>
    @foreach($paketInternet as $paket)
        <option value="{{ $paket->id }}"
            {{ old('paket_internet_id', $transaksi->paket_internet_id ?? '') == $paket->id ? 'selected' : '' }}>
            {{ $paket->nama_paket ?? $paket->paket_internet }}
        </option>
    @endforeach

    {{-- Opsi custom --}}
    <option value="Lainnya"
        {{ old('paket_internet_id', $transaksi->paket_internet_id ?? '') == 'Lainnya' ? 'selected' : '' }}>
        Lainnya
    </option>
</select>

    {{-- input custom hanya muncul kalau pilih Lainnya --}}
<input type="text" class="form-control mt-2 @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket"
    placeholder="Nama Paket Custom"
    value="{{ old('nama_paket') }}"
    style="display: none;" disabled>

@error('nama_paket')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror

<input type="number" class="form-control mt-2 @error('harga_bulanan') is-invalid @enderror" id="harga_bulanan" name="harga_bulanan""
    placeholder="Harga Paket Custom"
    value="{{ old('harga_bulanan') }}"
    style="display: none;" disabled>

@error('harga_bulanan')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror

  </div>

  <div class="col-md-3 mb-3">
    <label for="promosi_id" class="form-label">Promosi</label>
    <select class="form-select" id="promosi_id" name="promosi_id">
      <option value="">-- Pilih Promosi --</option>
      @foreach($promosi as $promo)
        <option value="{{ $promo->id }}"
          data-kode="{{ $promo->kode_promosi }}"
          data-mulai="{{ $promo->periode_mulai }}"
          data-selesai="{{ $promo->periode_selesai }}"
          data-note="{{ $promo->note }}"
          {{ old('promosi_id', $transaksi->promosi_id ?? '') == $promo->id ? 'selected' : '' }}>
          {{ $promo->nama_program_promosi }}
        </option>
      @endforeach
    </select>
  </div>
</div>

<div id="promosi_fields" style="display: none;">
  <div class="row">
    <div class="col-md-3 mb-3">
      <label for="kode_promosi" class="form-label">Kode Promosi</label>
      <input type="text" class="form-control" id="kode_promosi" name="kode_promosi"
        value="{{ old('kode_promosi', $transaksi->kode_promosi ?? '') }}" readonly>
    </div>
    <div class="col-md-3 mb-3">
      <label for="periode_mulai" class="form-label">Periode Mulai</label>
      <input type="date" class="form-control" id="periode_mulai" name="periode_mulai"
        value="{{ old('periode_mulai', $transaksi->periode_mulai ?? '') }}" readonly>
    </div>
    <div class="col-md-3 mb-3">
      <label for="periode_selesai" class="form-label">Periode Selesai</label>
      <input type="date" class="form-control" id="periode_selesai" name="periode_selesai"
        value="{{ old('periode_selesai', $transaksi->periode_selesai ?? '') }}" readonly>
    </div>
  </div>
  <div class="mb-3">
    <label for="note" class="form-label">Catatan</label>
    <textarea class="form-control" id="note" name="note" rows="2" readonly>{{ old('note', $transaksi->note ?? '') }}</textarea>
  </div>
</div>

<div class="row">
  <div class="col-md-3 mb-3">
    <label for="bandwidth_id" class="form-label">Bandwidth <span class="text-danger">*</span></label>
    <select class="form-select" id="bandwidth_id" name="bandwidth_id" required>
        <option value="">-- Pilih Bandwidth --</option>
        @foreach($bandwidths as $bw)
            <option value="{{ $bw->id }}"
                {{ old('bandwidth_id', $transaksi->bandwidth_id ?? '') == $bw->id ? 'selected' : '' }}>
                {{ $bw->nilai }}
            </option>
        @endforeach
        <option value="Lainnya" {{ old('bandwidth_id', $transaksi->bandwidth_id ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
    </select>
    <input type="text" class="form-control mt-2 @error('nilai') is-invalid @enderror" id="nilai" name="nilai"
        placeholder="Isi bandwidth manual"
        value="{{ old('nilai', '') }}"
        style="{{ old('bandwidth_id') == 'Lainnya' ? '' : 'display:none;' }}"
        {{ old('bandwidth_id') == 'Lainnya' ? '' : 'disabled' }}>
    @error('nilai')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


  <div class="col-md-3 mb-3">
    <label for="metode_billing" class="form-label">Metode Billing <span class="text-danger">*</span></label>
    <select class="form-select" id="metode_billing" name="metode_billing">
      <option value="">-- Pilih --</option>
      <option value="Cetak" {{ old('metode_billing', $transaksi->metode_billing ?? '') == 'Cetak' ? 'selected' : '' }}>Cetak</option>
      <option value="E-Billing" {{ old('metode_billing', $transaksi->metode_billing ?? '') == 'E-Billing' ? 'selected' : '' }}>E-Billing</option>
    </select>
  </div>

  <div class="col-md-3 mb-3">
    <label for="alamat_penagihan" class="form-label">Alamat Penagihan <span class="text-danger">*</span></label>
    <textarea class="form-control" id="alamat_penagihan" name="alamat_penagihan" rows="2">{{ old('alamat_penagihan', $transaksi->alamat_penagihan ?? '') }}</textarea>
  </div>

  <div class="col-md-3 mb-3">
    <label for="email_penagihan" class="form-label">Email Penagihan <span class="text-danger">*</span></label>
    <input type="email" class="form-control" id="email_penagihan" name="email_penagihan"
      value="{{ old('email_penagihan', $transaksi->email_penagihan ?? '') }}">
  </div>
</div>
