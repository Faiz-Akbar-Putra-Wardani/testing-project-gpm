<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('paket_internet.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="createModalLabel">Tambah Paket Internet</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_paket" class="form-label">Nama Paket</span></label>
            <input type="text" class="form-control" id="nama_paket" name="nama_paket" required>
          </div>
          <div class="mb-3">
            <label for="paket_internet" class="form-label">Paket Internet<span class="text-danger">*</span></label>
            <select class="form-select" id="paket_internet" name="paket_internet">
                <option value="">-- Pilih Paket (opsional) --</option>
                @foreach ($paket_options as $paket)
                    <option value="{{ $paket }}">{{ $paket }}</option>
                @endforeach
            </select>
            <small class="text-muted">jika ingin menambahkan custom paket, isi di nama paket</small>
            </div>
          <div class="mb-3">
            <label for="harga_bulanan" class="form-label">Harga Bulanan<span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="harga_bulanan" name="harga_bulanan">
          </div>
          <div class="mb-3">
            <label for="is_active" class="form-label">Status<span class="text-danger">*</span></label>
            <select class="form-select" id="is_active" name="is_active" required>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
