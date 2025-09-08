<div class="modal fade" id="createBandwidthModal" tabindex="-1" aria-labelledby="createBandwidthModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg ">
    <form action="{{ route('bandwidth.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="createBandwidthModalLabel">Tambah Bandwidth</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nilai" class="form-label">Nilai Bandwidth</label>
            <select class="form-select" id="nilai" name="nilai" required>
              <option value="">-- Pilih Bandwidth --</option>
              @foreach ($bandwidth_options as $option)
                  <option value="{{ $option }}">{{ $option }}</option>
              @endforeach
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
