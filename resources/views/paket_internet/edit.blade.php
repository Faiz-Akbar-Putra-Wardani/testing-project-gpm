{{-- Modal update --}}
<div class="modal fade" id="editModal{{ $paketInternet->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $paketInternet->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('paket_internet.update', $paketInternet->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="editModalLabel{{ $paketInternet->id }}">Edit Paket Internet</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          {{-- Pilihan Paket Internet --}}
    
            <div class="mb-3">
              <label for="paket_internet{{ $paketInternet->id }}" class="form-label">Paket Internet</label>
              <select class="form-select paketSelect @error('paket_internet') is-invalid @enderror" 
                      id="paket_internet{{ $paketInternet->id }}" 
                      name="paket_internet">
                  <option value="">-- Pilih Paket (opsional) --</option>
                  @foreach ($paket_options as $paket)
                    <option value="{{ $paket }}" {{ old('paket_internet', $paketInternet->paket_internet) === $paket ? 'selected' : '' }}>
                      {{ $paket }}
                    </option>
                  @endforeach
              </select>
              @error('paket_internet')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Nama Paket Custom --}}
            <div class="mb-3 {{ old('paket_internet', $paketInternet->paket_internet) === 'Lainnya' ? '' : 'd-none' }} namaPaketWrapper">
              <label for="nama_paket{{ $paketInternet->id }}" class="form-label">Nama Paket (Custom)</label>
              <input type="text" 
                    class="form-control @error('nama_paket') is-invalid @enderror" 
                    id="nama_paket{{ $paketInternet->id }}" 
                    name="nama_paket" 
                    value="{{ old('nama_paket', $paketInternet->nama_paket) }}"
                    placeholder="Masukkan nama paket custom">
              @error('nama_paket')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Harga Bulanan --}}
            <div class="mb-3">
              <label for="harga_bulanan{{ $paketInternet->id }}" class="form-label">Harga Bulanan</label>
              <input type="number" 
                    class="form-control @error('harga_bulanan') is-invalid @enderror" 
                    id="harga_bulanan{{ $paketInternet->id }}" 
                    name="harga_bulanan" 
                    value="{{ old('harga_bulanan', $paketInternet->harga_bulanan) }}">
              @error('harga_bulanan')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Status --}}
            <div class="mb-3">
              <label for="is_active{{ $paketInternet->id }}" class="form-label">Status</label>
              <select class="form-select @error('is_active') is-invalid @enderror" 
                      id="is_active{{ $paketInternet->id }}" 
                      name="is_active" required>
                <option value="1" {{ old('is_active', $paketInternet->is_active) ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active', $paketInternet->is_active) ? '' : 'selected' }}>Inactive</option>
              </select>
              @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary rounded-pill">Perbarui</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- Script untuk toggle input custom --}}
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const paketSelects = document.querySelectorAll(".paketSelect");

    paketSelects.forEach(select => {
      const modal = select.closest(".modal");
      const namaPaketWrapper = modal.querySelector(".namaPaketWrapper");
      const namaPaketInput = modal.querySelector("input[name='nama_paket']");

      // inisialisasi awal (kalau load edit data)
      if (select.value === "Lainnya") {
        namaPaketWrapper.classList.remove("d-none");
        namaPaketInput.disabled = false;
      } else {
        namaPaketWrapper.classList.add("d-none");
        namaPaketInput.disabled = true;
      }

      // saat user ganti pilihan
      select.addEventListener("change", function () {
        if (this.value === "Lainnya") {
          namaPaketWrapper.classList.remove("d-none");
          namaPaketInput.disabled = false;
        } else {
          namaPaketWrapper.classList.add("d-none");
          namaPaketInput.value = "";
          namaPaketInput.disabled = true;
        }
      });
    });
  });
</script>

