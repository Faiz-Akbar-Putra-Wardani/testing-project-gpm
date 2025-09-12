@extends('layout')

@section('content')
<div class="pc-container">
  <div class="pc-content">
    <div class="row">
      <div class="col-sm-12">
        <div class="card shadow-sm rounded-4 border-0 overflow-hidden">
          <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #7F00FF 0%, #00CFFF 100%); color: #fff;">
            <h5 class="mb-0 fw-bold text-white">Bandwidth</h5>
            <button type="button" class="btn text-white fw-bold rounded-pill px-4 d-flex align-items-center shadow-sm hover-scale"
                    data-bs-toggle="modal" data-bs-target="#createBandwidthModal"
                    style="background: linear-gradient(135deg, #FF6EC7 0%, #7F00FF 100%);">
              <i class="bi bi-plus-lg me-2"></i> Add New
            </button>
          </div>

          <div class="card-body table-responsive p-3">
            <table class="table table-hover table-bordered text-center align-middle">
              <thead class="table-light">
                <tr>
                  <th>No</th>
                  <th>Nilai Bandwidth</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($bandwidths as $index => $bandwidth)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $bandwidth->nilai }}</td>
                  <td>
                    <div class="d-flex justify-content-center gap-2">
                      <button type="button" class="btn btn-sm btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#editBandwidthModal{{ $bandwidth->id }}">
                        Edit
                      </button>
                      <form action="{{ route('bandwidth.destroy', $bandwidth->id) }}" method="POST" class="d-inline delete-bandwidth-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger rounded-pill">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="3" class="text-center text-muted">Belum ada data bandwidth</td>
                </tr>
                @endforelse
              </tbody>
            </table>

            <div class="d-flex justify-content-end">
              {{ $bandwidths->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('bandwidth.create')
@foreach($bandwidths as $bandwidth)
  @include('bandwidth.edit', ['bandwidth' => $bandwidth])
@endforeach

<style>
.hover-scale { transition: transform 0.2s ease, box-shadow 0.2s ease; }
.hover-scale:hover { transform: scale(1.05); box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.2); }
</style>
@endsection
