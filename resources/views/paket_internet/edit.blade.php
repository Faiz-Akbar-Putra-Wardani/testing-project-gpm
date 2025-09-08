
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
          <div class="mb-3">
            <label for="nama_paket{{ $paketInternet->id }}" class="form-label">Nama Paket</label>
            <input type="text" class="form-control" id="nama_paket{{ $paketInternet->id }}" name="nama_paket" value="{{ old('nama_paket', $paketInternet->nama_paket) }}">
          </div>
          <div class="mb-3">
            <label for="paket_internet{{ $paketInternet->id }}" class="form-label">Paket Internet</label>
            <select class="form-select" id="paket_internet{{ $paketInternet->id }}" name="paket_internet">
                <option value="">-- Pilih Paket (opsional) --</option>
                @foreach ($paket_options as $paket)
                  <option value="{{ $paket }}" {{ $paketInternet->paket_internet === $paket ? 'selected' : '' }}>
                    {{ $paket }}
                  </option>
                @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="harga_bulanan{{ $paketInternet->id }}" class="form-label">Harga Bulanan</label>
            <input type="number" class="form-control" id="harga_bulanan{{ $paketInternet->id }}" name="harga_bulanan" value="{{ old('harga_bulanan', $paketInternet->harga_bulanan) }}">
          </div>
          <div class="mb-3">
            <label for="is_active{{ $paketInternet->id }}" class="form-label">Status</label>
            <select class="form-select" id="is_active{{ $paketInternet->id }}" name="is_active" required>
              <option value="1" {{ $paketInternet->is_active ? 'selected' : '' }}>Active</option>
              <option value="0" {{ !$paketInternet->is_active ? 'selected' : '' }}>Inactive</option>
            </select>
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

