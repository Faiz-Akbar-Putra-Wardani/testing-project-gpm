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

          <!-- Paket Internet Select -->
          <div class="mb-3">
            <label for="paket_internet" class="form-label">Paket Internet<span class="text-danger">*</span></label>
            <select class="form-select" id="paket_internet" name="paket_internet">
                <option value="">-- Pilih Paket (opsional) --</option>
                @foreach ($paket_options as $paket)
                    <option value="{{ $paket }}">{{ $paket }}</option>
                @endforeach
                <option value="custom">Lainnya</option>
            </select>
            <small class="text-muted">Jika ingin menambahkan paket custom, pilih "Lainnya" dan isi Nama Paket</small>
          </div>

          <!-- Nama Paket (hanya muncul saat custom) -->
          <div class="mb-3" id="namaPaketWrapper" style="display: none;">
            <label for="nama_paket" class="form-label">Nama Paket<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_paket" name="nama_paket">
          </div>

          <!-- Harga Bulanan -->
          <div class="mb-3">
            <label for="harga_bulanan" class="form-label">Harga Bulanan<span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="harga_bulanan" name="harga_bulanan" required>
          </div>

          <!-- Status -->
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

<!-- JS untuk toggle input custom -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const paketSelect = document.getElementById('paket_internet');
    const namaPaketWrapper = document.getElementById('namaPaketWrapper');

    paketSelect.addEventListener('change', function () {
        if (this.value === 'custom') {
            namaPaketWrapper.style.display = 'block';
            document.getElementById('nama_paket').required = true;
        } else {
            namaPaketWrapper.style.display = 'none';
            document.getElementById('nama_paket').required = false;
        }
    });
});
</script>
