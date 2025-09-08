<div class="modal fade" id="editBandwidthModal{{ $bandwidth->id }}" tabindex="-1" aria-labelledby="editBandwidthModalLabel{{ $bandwidth->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('bandwidth.update', $bandwidth->id) }}" method="POST">
      @csrf
      @method('PATCH')
      <div class="modal-content">
        <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="editBandwidthModalLabel{{ $bandwidth->id }}">Edit Bandwidth</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nilai_edit" class="form-label">Nilai Bandwidth</label>
            <select class="form-select" id="nilai_edit" name="nilai" required>
              <option value="">-- Pilih Bandwidth --</option>
              @foreach ($bandwidth_options as $option)
                <option value="{{ $option }}" @if($bandwidth->nilai == $option) selected @endif>{{ $option }}</option>
              @endforeach
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
