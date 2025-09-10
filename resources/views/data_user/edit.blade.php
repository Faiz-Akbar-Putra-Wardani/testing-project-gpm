<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('data_user.update', ['data_user' => $user->id]) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="editModalLabel{{ $user->id }}">Edit User</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name{{ $user->id }}" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
          </div>
          <div class="mb-3">
            <label for="email{{ $user->id }}" class="form-label">Email</label>
            <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
          </div>
          <div class="mb-3">
            <label for="role{{ $user->id }}" class="form-label">Role</label>
            <select class="form-select" id="role{{ $user->id }}" name="role" required>
              <option value="">-- Pilih Role --</option>
              @foreach ($roles as $role)
                <option value="{{ $role->name }}" {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                  {{ ucfirst($role->name) }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary rounded-pill text-white">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
