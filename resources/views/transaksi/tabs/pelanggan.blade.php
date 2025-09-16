<h6 class="mb-3">Data Pelanggan</h6>
<div class="row">
  <div class="col-md-3 mb-3">
    <label for="no_ktp" class="form-label">No. KTP <span class="text-danger">*</span></label>
    <input type="text"
           class="form-control @error('no_ktp') is-invalid @enderror"
           id="no_ktp" name="no_ktp"
           value="{{ old('no_ktp', $transaksi->pelanggan->no_ktp ?? '') }}">
    @error('no_ktp')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
    <input type="text"
           class="form-control @error('nama_lengkap') is-invalid @enderror"
           id="nama_lengkap" name="nama_lengkap"
           value="{{ old('nama_lengkap', $transaksi->pelanggan->nama_lengkap ?? '') }}">
    @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
    <input type="text"
           class="form-control @error('tempat_lahir') is-invalid @enderror"
           id="tempat_lahir" name="tempat_lahir"
           value="{{ old('tempat_lahir', $transaksi->pelanggan->tempat_lahir ?? '') }}">
    @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
    <input type="date"
           class="form-control @error('tanggal_lahir') is-invalid @enderror"
           id="tanggal_lahir" name="tanggal_lahir"
           value="{{ old('tanggal_lahir', $transaksi->pelanggan->tanggal_lahir ?? '') }}">
    @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>

<div class="row">
  <div class="col-md-3 mb-3">
    <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
    <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
            id="jenis_kelamin" name="jenis_kelamin">
      <option value="">-- Pilih --</option>
      <option value="L" {{ old('jenis_kelamin', $transaksi->pelanggan->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
      <option value="P" {{ old('jenis_kelamin', $transaksi->pelanggan->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>
    @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="status_pernikahan" class="form-label">Status Pernikahan <span class="text-danger">*</span></label>
    <select class="form-select @error('status_pernikahan') is-invalid @enderror"
            id="status_pernikahan" name="status_pernikahan">
      <option value="">-- Pilih --</option>
      <option value="Belum Menikah" {{ old('status_pernikahan', $transaksi->pelanggan->status_pernikahan ?? '') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
      <option value="Menikah" {{ old('status_pernikahan', $transaksi->pelanggan->status_pernikahan ?? '') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
    </select>
    @error('status_pernikahan')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
    <select class="form-select @error('pekerjaan') is-invalid @enderror"
            id="pekerjaan" name="pekerjaan">
      <option value="">-- Pilih --</option>
      @foreach ($pekerjaanOptions as $option)
        <option value="{{ $option }}"
          {{ old('pekerjaan', $transaksi->pelanggan->pekerjaan ?? '') == $option ? 'selected' : '' }}>
          {{ $option }}
        </option>
      @endforeach
      <option value="Lainnya"
        {{ old('pekerjaan',  $transaksi->pelanggan->pekerjaan ?? '') == 'Lainnya'
        || $transaksi?->pelanggan?->pekerjaan_lainnya ? 'selected' : '' }}>
        Lainnya
      </option>
    </select>
  @error('pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror

  <input type="text"
         class="form-control mt-2 @error('pekerjaan_lainnya') is-invalid @enderror"
         id="pekerjaan_lainnya" name="pekerjaan_lainnya"
         placeholder="Isi jika Lainnya"
         value="{{ old('pekerjaan_lainnya', $transaksi?->pelanggan?->pekerjaan_lainnya ?? '') }}"
         style="display: none;">
  @error('pekerjaan_lainnya')<div class="invalid-feedback">{{ $message }}</div>@enderror

  </div>

  <div class="col-md-3 mb-3">
      <label for="jenis_tempat_tinggal" class="form-label">Jenis Tempat Tinggal <span class="text-danger">*</span></label>
          <select class="form-select @error('jenis_tempat_tinggal') is-invalid @enderror"
            id="jenis_tempat_tinggal" name="jenis_tempat_tinggal">
      <option value="">-- Pilih --</option>
      @foreach ($tempatTinggalOptions as $tempatTinggal)
        <option value="{{ $tempatTinggal }}"
          {{ old('jenis_tempat_tinggal', $transaksi->pelanggan->jenis_tempat_tinggal ?? '') == $tempatTinggal ? 'selected' : '' }}>
          {{ $tempatTinggal }}
        </option>
      @endforeach
      <option value="Lainnya"
        {{ old('jenis_tempat_tinggal',  $transaksi->pelanggan->jenis_tempat_tinggal ?? '') == 'Lainnya'
        || $transaksi?->pelanggan?->tempat_tinggal_lainnya ? 'selected' : '' }}>
        Lainnya
      </option>
    </select>
  @error('jenis_tempat_tinggal')<div class="invalid-feedback">{{ $message }}</div>@enderror

  <input type="text"
         class="form-control mt-2 @error('tempat_tinggal_lainnya') is-invalid @enderror"
         id="tempat_tinggal_lainnya" name="tempat_tinggal_lainnya"
         placeholder="Isi jika Lainnya"
         value="{{ old('tempat_tinggal_lainnya', $transaksi?->pelanggan?->tempat_tinggal_lainnya ?? '') }}"
         style="display: none;">
  @error('tempat_tinggal_lainnya')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>

{{-- Alamat KTP --}}
<h6 class="mb-3">Alamat KTP</h6>
<div class="row">
  <div class="col-md-3 mb-3">
    <label for="provinsi_ktp_id" class="form-label">Provinsi <span class="text-danger">*</span></label>
    <select class="form-select select2 @error('provinsi_ktp_id') is-invalid @enderror"
            id="provinsi_ktp_id" name="provinsi_ktp_id">
      <option value="">-- Pilih Provinsi --</option>
      @foreach($provinsi as $p)
        <option value="{{ $p->id }}" {{ old('provinsi_ktp_id', $transaksi->pelanggan->provinsi_ktp_id ?? '') == $p->id ? 'selected' : '' }}>
          {{ $p->name }}
        </option>
      @endforeach
    </select>
    @error('provinsi_ktp_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="kabupaten_ktp_id" class="form-label">Kabupaten <span class="text-danger">*</span></label>
    <select class="form-select select2 @error('kabupaten_ktp_id') is-invalid @enderror"
            id="kabupaten_ktp_id" name="kabupaten_ktp_id"></select>
    @error('kabupaten_ktp_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="kecamatan_ktp_id" class="form-label">Kecamatan <span class="text-danger">*</span></label>
    <select class="form-select select2 @error('kecamatan_ktp_id') is-invalid @enderror"
            id="kecamatan_ktp_id" name="kecamatan_ktp_id"></select>
    @error('kecamatan_ktp_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="kelurahan_ktp_id" class="form-label">Kelurahan <span class="text-danger">*</span></label>
    <select class="form-select select2 @error('kelurahan_ktp_id') is-invalid @enderror"
            id="kelurahan_ktp_id" name="kelurahan_ktp_id"></select>
    @error('kelurahan_ktp_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="kodepos_ktp" class="form-label">Kode Pos KTP <span class="text-danger">*</span></label>
    <input type="text"
           class="form-control @error('kodepos_ktp') is-invalid @enderror"
           id="kodepos_ktp" name="kodepos_ktp"
           value="{{ old('kodepos_ktp', $transaksi->pelanggan->kodepos_ktp ?? '') }}">
    @error('kodepos_ktp')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>

<div class="mb-3">
  <label for="alamat_ktp" class="form-label">Detail Alamat KTP <span class="text-danger">*</span></label>
  <textarea class="form-control @error('alamat_ktp') is-invalid @enderror"
            id="alamat_ktp" name="alamat_ktp" rows="2">{{ old('alamat_ktp', $transaksi->pelanggan->alamat_ktp ?? '') }}</textarea>
  @error('alamat_ktp')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

{{-- Alamat Instalasi --}}
<h6 class="mb-3">Alamat Instalasi</h6>
<div class="row">
  <div class="mb-3">
    <button type="button" id="copy_ktp" class="btn btn-primary btn-sm d-flex align-items-center justify-content-center w-10 w-md-auto">
      <i class="ti ti-copy me-2"></i>
      <span class="d-none d-md-inline">Salin KTP</span>
      <span class="d-inline d-md-none">Salin KTP</span>
    </button>
    <small class="text-muted d-block mt-1">Klik jika alamat KTP dan alamat instalasi sama</small>
  </div>

  <div class="col-md-3 mb-3">
    <label for="provinsi_instalasi_id" class="form-label">Provinsi <span class="text-danger">*</span></label>
    <select class="form-select select2 @error('provinsi_instalasi_id') is-invalid @enderror"
            id="provinsi_instalasi_id" name="provinsi_instalasi_id">
      <option value="">-- Pilih Provinsi --</option>
      @foreach($provinsi as $p)
        <option value="{{ $p->id }}" {{ old('provinsi_instalasi_id', $transaksi->pelanggan->provinsi_instalasi_id ?? '') == $p->id ? 'selected' : '' }}>
          {{ $p->name }}
        </option>
      @endforeach
    </select>
    @error('provinsi_instalasi_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="kabupaten_instalasi_id" class="form-label">Kabupaten <span class="text-danger">*</span></label>
    <select class="form-select select2 @error('kabupaten_instalasi_id') is-invalid @enderror"
            id="kabupaten_instalasi_id" name="kabupaten_instalasi_id"></select>
    @error('kabupaten_instalasi_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="kecamatan_instalasi_id" class="form-label">Kecamatan <span class="text-danger">*</span></label>
    <select class="form-select select2 @error('kecamatan_instalasi_id') is-invalid @enderror"
            id="kecamatan_instalasi_id" name="kecamatan_instalasi_id"></select>
    @error('kecamatan_instalasi_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="kelurahan_instalasi_id" class="form-label">Kelurahan <span class="text-danger">*</span></label>
    <select class="form-select select2 @error('kelurahan_instalasi_id') is-invalid @enderror"
            id="kelurahan_instalasi_id" name="kelurahan_instalasi_id"></select>
    @error('kelurahan_instalasi_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>

<div class="mb-3">
  <label for="alamat_instalasi" class="form-label">Detail Alamat Instalasi <span class="text-danger">*</span></label>
  <textarea class="form-control @error('alamat_instalasi') is-invalid @enderror"
            id="alamat_instalasi" name="alamat_instalasi" rows="2">{{ old('alamat_instalasi', $transaksi->pelanggan->alamat_instalasi ?? '') }}</textarea>
  @error('alamat_instalasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
  <div class="col-md-3 mb-3">
    <label for="nomor_ponsel" class="form-label">No Ponsel <span class="text-danger">*</span></label>
    <input type="text"
           class="form-control @error('nomor_ponsel') is-invalid @enderror"
           id="nomor_ponsel" name="nomor_ponsel"
           value="{{ old('nomor_ponsel', $transaksi->pelanggan->nomor_ponsel ?? '') }}">
    @error('nomor_ponsel')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="nomor_telepon" class="form-label">No Telepon</label>
    <input type="text"
           class="form-control @error('nomor_telepon') is-invalid @enderror"
           id="nomor_telepon" name="nomor_telepon"
           value="{{ old('nomor_telepon', $transaksi->pelanggan->nomor_telepon ?? '') }}">
    @error('nomor_telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="no_fax" class="form-label">No Fax</label>
    <input type="text"
           class="form-control @error('no_fax') is-invalid @enderror"
           id="no_fax" name="no_fax"
           value="{{ old('no_fax', $transaksi->pelanggan->no_fax ?? '') }}">
    @error('no_fax')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="kodepos_instalasi" class="form-label">Kode Pos Instalasi <span class="text-danger">*</span></label>
    <input type="text"
           class="form-control @error('kodepos_instalasi') is-invalid @enderror"
           id="kodepos_instalasi" name="kodepos_instalasi"
           value="{{ old('kodepos_instalasi', $transaksi->pelanggan->kodepos_instalasi ?? '') }}">
    @error('kodepos_instalasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
