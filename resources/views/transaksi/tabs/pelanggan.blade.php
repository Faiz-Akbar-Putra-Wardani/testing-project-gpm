<h6 class="mb-3">Data Pelanggan</h6>
<div class="row">
  <div class="col-md-3 mb-3">
    <label for="no_ktp" class="form-label">No. KTP <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="no_ktp" name="no_ktp"
      value="{{ old('no_ktp', $transaksi->pelanggan->no_ktp ?? '') }}">
  </div>
  <div class="col-md-3 mb-3">
    <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
      value="{{ old('nama_lengkap', $transaksi->pelanggan->nama_lengkap ?? '') }}">
  </div>
  <div class="col-md-3 mb-3">
    <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
      value="{{ old('tempat_lahir', $transaksi->pelanggan->tempat_lahir ?? '') }}">
  </div>
  <div class="col-md-3 mb-3">
    <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
      value="{{ old('tanggal_lahir', $transaksi->pelanggan->tanggal_lahir ?? '') }}">
  </div>
</div>

<div class="row">
  <div class="col-md-3 mb-3">
    <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
      <option value="">-- Pilih --</option>
      <option value="L" {{ old('jenis_kelamin', $transaksi->pelanggan->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
      <option value="P" {{ old('jenis_kelamin', $transaksi->pelanggan->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>
  </div>
  <div class="col-md-3 mb-3">
    <label for="status_pernikahan" class="form-label">Status Pernikahan <span class="text-danger">*</span></label>
    <select class="form-select" id="status_pernikahan" name="status_pernikahan">
      <option value="">-- Pilih --</option>
      <option value="Belum Menikah" {{ old('status_pernikahan', $transaksi->pelanggan->status_pernikahan ?? '') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
      <option value="Menikah" {{ old('status_pernikahan', $transaksi->pelanggan->status_pernikahan ?? '') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
    </select>
  </div>
  <div class="col-md-3 mb-3">
    <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
    <select class="form-select" id="pekerjaan" name="pekerjaan">
      <option value="">-- Pilih --</option>
      @foreach ($pekerjaanOptions as $pekerjaan)
        <option value="{{ $pekerjaan }}"
          {{ old('pekerjaan', $transaksi->pelanggan->pekerjaan ?? '') == $pekerjaan ? 'selected' : '' }}>
          {{ $pekerjaan }}
        </option>
      @endforeach
    </select>
    <input type="text" class="form-control mt-2" id="pekerjaan_lainnya" name="pekerjaan_lainnya"
      placeholder="Isi jika Lainnya"
      value="{{ old('pekerjaan_lainnya', $transaksi->pelanggan->pekerjaan_lainnya ?? '') }}">
  </div>
  <div class="col-md-3 mb-3">
    <label for="jenis_tempat_tinggal" class="form-label">Jenis Tempat Tinggal <span class="text-danger">*</span></label>
    <select class="form-select" id="jenis_tempat_tinggal" name="jenis_tempat_tinggal">
      <option value="">-- Pilih --</option>
      @foreach ($tempatTinggalOptions as $tempatTinggal)
        <option value="{{ $tempatTinggal }}"
          {{ old('jenis_tempat_tinggal', $transaksi->pelanggan->jenis_tempat_tinggal ?? '') == $tempatTinggal ? 'selected' : '' }}>
          {{ $tempatTinggal }}
        </option>
      @endforeach
    </select>
    <input type="text" class="form-control mt-2" id="jenis_tempat_tinggal_lainnya" name="jenis_tempat_tinggal_lainnya"
      placeholder="Isi jika Lainnya"
      value="{{ old('jenis_tempat_tinggal_lainnya', $transaksi->pelanggan->jenis_tempat_tinggal_lainnya ?? '') }}">
  </div>
</div>

<h6 class="mb-3">Alamat KTP</h6>
<div class="row">
  <div class="col-md-3 mb-3">
    <label for="provinsi_ktp_id" class="form-label">Provinsi <span class="text-danger">*</span></label>
    <select class="form-select select2" id="provinsi_ktp_id" name="provinsi_ktp_id">
      <option value="">-- Pilih Provinsi --</option>
      @foreach($provinsi as $p)
        <option value="{{ $p->id }}"
          {{ old('provinsi_ktp_id', $transaksi->pelanggan->provinsi_ktp_id ?? '') == $p->id ? 'selected' : '' }}>
          {{ $p->name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3 mb-3">
        <label for="kabupaten_ktp_id" class="form-label">Kabupaten <span class="text-danger">*</span></label>
        <select class="form-select select2" id="kabupaten_ktp_id" name="kabupaten_ktp_id"></select>
    </div>
    <div class="col-md-3 mb-3">
        <label for="kecamatan_ktp_id" class="form-label">Kecamatan <span class="text-danger">*</span></label>
        <select class="form-select select2" id="kecamatan_ktp_id" name="kecamatan_ktp_id"></select>
    </div>
    <div class="col-md-3 mb-3">
        <label for="kelurahan_ktp_id" class="form-label">Kelurahan <span class="text-danger">*</span></label>
        <select class="form-select select2" id="kelurahan_ktp_id" name="kelurahan_ktp_id"></select>
    </div>
    <div class="col-md-3 mb-3">
        <label for="kodepos_ktp" class="form-label">kode pos ktp</label>
        <input type="text" class="form-control" id="nkodepos_ktp" name="kodepos_ktp"
        value="{{ old('kodepos_ktp', $transaksi->pelanggan->kodepos_ktp ?? '') }}">
   </div>
    </div>

<div class="mb-3">
  <label for="alamat_ktp" class="form-label">Detail Alamat KTP <span class="text-danger">*</span></label>
  <textarea class="form-control" id="alamat_ktp" name="alamat_ktp" rows="2">{{ old('alamat_ktp', $transaksi->pelanggan->alamat_ktp ?? '') }}</textarea>
</div>

<h6 class="mb-3">Alamat Instalasi</h6>
<div class="row">
<div class="mb-3">
    <button type="button" id="copy_ktp" class="btn btn-primary btn-sm d-flex align-items-center justify-content-center w-100 w-md-auto">
        <i class="ti ti-copy me-2"></i>
        <span class="d-none d-md-inline">Sama seperti KTP</span>
        <span class="d-inline d-md-none">Salin KTP</span>
    </button>
    <small class="text-muted d-block mt-1">Klik jika alamat KTP dan alamat instalasi sama</small>
</div>
  <div class="col-md-3 mb-3">
    <label for="provinsi_instalasi_id" class="form-label">Provinsi <span class="text-danger">*</span></label>
    <select class="form-select select2" id="provinsi_instalasi_id" name="provinsi_instalasi_id">
      <option value="">-- Pilih Provinsi --</option>
      @foreach($provinsi as $p)
        <option value="{{ $p->id }}"
          {{ old('provinsi_instalasi_id', $transaksi->pelanggan->provinsi_instalasi_id ?? '') == $p->id ? 'selected' : '' }}>
          {{ $p->name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3 mb-3">
    <label for="kabupaten_instalasi_id" class="form-label">Kabupaten <span class="text-danger">*</span></label>
    <select class="form-select select2" id="kabupaten_instalasi_id" name="kabupaten_instalasi_id"></select>
  </div>
  <div class="col-md-3 mb-3">
    <label for="kecamatan_instalasi_id" class="form-label">Kecamatan <span class="text-danger">*</span></label>
    <select class="form-select select2" id="kecamatan_instalasi_id" name="kecamatan_instalasi_id"></select>
  </div>
  <div class="col-md-3 mb-3">
    <label for="kelurahan_instalasi_id" class="form-label">Kelurahan <span class="text-danger">*</span></label>
    <select class="form-select select2" id="kelurahan_instalasi_id" name="kelurahan_instalasi_id"></select>
  </div>

<div class="mb-3">
  <label for="alamat_instalasi" class="form-label">Detail Alamat Instalasi <span class="text-danger">*</span></label>
  <textarea class="form-control" id="alamat_instalasi" name="alamat_instalasi" rows="2">{{ old('alamat_instalasi', $transaksi->pelanggan->alamat_instalasi ?? '') }}</textarea>
</div>

<div class="row">
  <div class="col-md-3 mb-3">
    <label for="nomor_ponsel" class="form-label">No Ponsel <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="nomor_ponsel" name="nomor_ponsel"
      value="{{ old('nomor_ponsel', $transaksi->pelanggan->nomor_ponsel ?? '') }}">
  </div>

  <div class="col-md-3 mb-3">
    <label for="nomor_telepon" class="form-label">No Telepon </label>
    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
      value="{{ old('nomor_telepon', $transaksi->pelanggan->nomor_telepon ?? '') }}">
  </div>

  <div class="col-md-3 mb-3">
    <label for="no_fax" class="form-label">No Fax</label>
    <input type="text" class="form-control" id="no_fax" name="no_fax"
      value="{{ old('no_fax', $transaksi->pelanggan->no_fax ?? '') }}">
  </div>
    <div class="col-md-3 mb-3">
        <label for="kodepos_instalasi" class="form-label">kode pos instalasi</label>
        <input type="text" class="form-control" id="nkodepos_instalasi" name="kodepos_instalasi"
        value="{{ old('kodepos_instalasi', $transaksi->pelanggan->kodepos_instalasi ?? '') }}">
   </div>
</div>
</div>

<script>
    window.oldKabKtp   = @json(old('kabupaten_ktp_id', $transaksi->pelanggan->kabupaten_ktp_id ?? null));
    window.oldKecKtp   = @json(old('kecamatan_ktp_id', $transaksi->pelanggan->kecamatan_ktp_id ?? null));
    window.oldKelKtp   = @json(old('kelurahan_ktp_id', $transaksi->pelanggan->kelurahan_ktp_id ?? null));

    window.oldKabInst  = @json(old('kabupaten_instalasi_id', $transaksi->pelanggan->kabupaten_instalasi_id ?? null));
    window.oldKecInst  = @json(old('kecamatan_instalasi_id', $transaksi->pelanggan->kecamatan_instalasi_id ?? null));
    window.oldKelInst  = @json(old('kelurahan_instalasi_id', $transaksi->pelanggan->kelurahan_instalasi_id ?? null));
</script>
