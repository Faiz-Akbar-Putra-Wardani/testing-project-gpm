<div class="modal fade" id="editPromosiModal{{ $promosi->id }}" tabindex="-1" aria-labelledby="editPromosiModalLabel{{ $promosi->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('promosi.update', $promosi->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="editPromosiModalLabel{{ $promosi->id }}">Edit Promosi</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="kode_promosi" class="form-label">Kode Promosi</label>
            <input type="text" class="form-control" id="kode_promosi" name="kode_promosi" value="{{ old('kode_promosi', $promosi->kode_promosi) }}">
            @error('kode_promosi')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="mb-3">
            <label for="nama_program_promosi" class="form-label">Nama Program</label>
            <input type="text" class="form-control" id="nama_program_promosi" name="nama_program_promosi" value="{{ old('nama_program_promosi', $promosi->nama_program_promosi) }}">
            @error('nama_program_promosi')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="periode_mulai" class="form-label">Periode Mulai</label>
              <input type="date" class="form-control" id="periode_mulai" name="periode_mulai" value="{{ old('periode_mulai', $promosi->periode_mulai) }}">
              @error('periode_mulai')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="periode_selesai" class="form-label">Periode Selesai</label>
              <input type="date" class="form-control" id="periode_selesai" name="periode_selesai" value="{{ old('periode_selesai', $promosi->periode_selesai) }}">
              @error('periode_selesai')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>

          <div class="mb-3">
            <label for="note" class="form-label">Catatan</label>
            <textarea class="form-control" id="note" name="note" rows="3">{{ old('note', $promosi->note) }}</textarea>
            @error('note')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary text-white rounded-pill">Perbarui</button>
        </div>
      </div>
    </form>
  </div>
</div>
