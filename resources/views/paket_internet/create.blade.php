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
          {{-- Paket Internet --}}
          <div class="mb-3">
            <label for="paket_internet" class="form-label">Paket Internet</label>
            <select class="form-select @error('paket_internet') is-invalid @enderror"
                    id="paket_internet"
                    name="paket_internet">
                <option value="">-- Pilih Paket (opsional) --</option>
                @foreach ($paket_options as $paket)
                    <option value="{{ $paket }}" {{ old('paket_internet') == $paket ? 'selected' : '' }}>
                        {{ $paket }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Jika pilih "Lainnya", isi di Nama Paket</small>
            @error('paket_internet')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Nama Paket Custom --}}
          <div class="mb-3 d-none" id="namaPaketWrapper">
            <label for="nama_paket" class="form-label">Nama Paket (Custom)</label>
            <input type="text"
                   class="form-control @error('nama_paket') is-invalid @enderror"
                   id="nama_paket"
                   name="nama_paket"
                   value="{{ old('nama_paket') }}"
                   placeholder="Masukkan nama paket custom">
            @error('nama_paket')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Harga Bulanan --}}
          <div class="mb-3">
            <label for="harga_bulanan" class="form-label">Harga Bulanan</label>
            <input type="number"
                   class="form-control @error('harga_bulanan') is-invalid @enderror"
                   id="harga_bulanan"
                   name="harga_bulanan"
                   value="{{ old('harga_bulanan') }}">
            @error('harga_bulanan')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Status --}}
          <div class="mb-3">
            <label for="is_active" class="form-label">Status</label>
            <select class="form-select @error('is_active') is-invalid @enderror"
                    id="is_active"
                    name="is_active"
                    required>
              <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
              <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('is_active')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const paketSelect = document.getElementById("paket_internet");
    const namaPaketWrapper = document.getElementById("namaPaketWrapper");
    const namaPaketInput = document.getElementById("nama_paket");

    function toggleNamaPaket() {
      if (paketSelect.value === "Lainnya") {
        namaPaketWrapper.classList.remove("d-none");
      } else {
        namaPaketWrapper.classList.add("d-none");
        namaPaketInput.value = "";
      }
    }

    paketSelect.addEventListener("change", toggleNamaPaket);

    toggleNamaPaket();
  });
</script>
