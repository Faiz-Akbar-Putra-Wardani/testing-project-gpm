@extends('layout')

@section('content')
<div class="pc-container">
  <div class="pc-content">
    <div class="row">
      <div class="col-sm-12">
        <div class="card shadow-sm rounded-4 border-0 overflow-hidden">
          <div class="card-header d-flex justify-content-between align-items-center"
               style="background: linear-gradient(135deg, #7F00FF 0%, #00CFFF 100%); color: #fff;">
            <h5 class="mb-0 fw-bold text-white">Data User</h5>
            <button type="button" class="btn text-white fw-bold rounded-pill px-4 d-flex align-items-center shadow-sm hover-scale"
                    data-bs-toggle="modal" data-bs-target="#createModal"
                    style="background: linear-gradient(135deg, #FF6EC7 0%, #7F00FF 100%);">
              <i class="bi bi-plus-lg me-2"></i> Add New
            </button>
          </div>

          <div class="card-body table-responsive p-3">
            <table class="table table-hover table-bordered text-center align-middle">
              <thead class="table-light">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($users as $index => $user)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $user->name ?? '-' }}</td>
                  <td>{{ $user->email ?? '-' }}</td>
                  <td>
                    @if($user->roles->isNotEmpty())
                      @foreach($user->roles as $role)
                        <span class="badge rounded-pill text-white"
                              style="background: linear-gradient(45deg, #FF6EC7, #7F00FF);">
                          {{ ucfirst($role->name) }}
                        </span>
                      @endforeach
                    @else
                      <span class="badge rounded-pill bg-secondary">No Role</span>
                    @endif
                  </td>
                  <td>
                    <div class="d-flex justify-content-center gap-2">
                      <!-- Tombol Edit diubah menjadi button untuk trigger modal -->
                      <button type="button"
                              class="btn btn-sm btn-warning rounded-pill d-flex align-items-center hover-scale"
                              data-bs-toggle="modal"
                              data-bs-target="#editModal{{ $user->id }}"
                              title="Edit">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                      </button>

                      <form action="{{ route('data_user.destroy', $user->id) }}" method="POST"
                            class="d-inline delete-user-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-sm btn-danger rounded-pill d-flex align-items-center hover-scale"
                                title="Delete">
                          <i class="bi bi-trash me-1"></i> Delete
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center text-muted">Belum ada user</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('data_user.create')
@foreach($users as $user)
  @include('data_user.edit', ['user' => $user, 'roles' => $roles])
@endforeach

<style>
  .hover-scale {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .hover-scale:hover {
    transform: scale(1.05);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.2);
  }
</style>
@endsection
