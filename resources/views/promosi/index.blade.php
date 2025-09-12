@extends('layout')

@section('content')
<div class="pc-container">
  <div class="pc-content">
    <div class="row">
      <div class="col-sm-12">
        <div class="card shadow-sm rounded-4 border-0 overflow-hidden">
          <div class="card-header d-flex justify-content-between align-items-center"
               style="background: linear-gradient(135deg, #7F00FF 0%, #00CFFF 100%); color: #fff;">
            <h5 class="mb-0 fw-bold text-white">Daftar Promosi</h5>
            <button type="button"
                    class="btn text-white fw-bold rounded-pill px-4 d-flex align-items-center shadow-sm hover-scale"
                    data-bs-toggle="modal" data-bs-target="#createPromosiModal"
                    style="background: linear-gradient(135deg, #FF6EC7 0%, #7F00FF 100%);">
              <i class="bi bi-plus-lg me-2"></i> Tambah Promosi
            </button>
          </div>

          <div class="card-body table-responsive p-3">
            <table class="table table-hover table-bordered text-center align-middle">
              <thead class="table-light">
                <tr>
                  <th>No</th>
                  <th>Kode</th>
                  <th>Nama Program</th>
                  <th>Periode</th>
                  <th>Note</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($promosis as $index => $promosi)
                <tr>
                  <td>{{ $promosis->firstItem() + $index }}</td>
                  <td>{{ $promosi->kode_promosi ?? '-' }}</td>
                  <td>{{ $promosi->nama_program_promosi ?? '-' }}</td>
                  <td>
                    {{ $promosi->periode_mulai ? \Carbon\Carbon::parse($promosi->periode_mulai)->format('d M Y') : '-' }}
                    s/d
                    {{ $promosi->periode_selesai ? \Carbon\Carbon::parse($promosi->periode_selesai)->format('d M Y') : '-' }}
                  </td>
                  <td>{{ $promosi->note ?? '-' }}</td>
                  <td>
                    <div class="d-flex justify-content-center gap-2">
                      <a href="#" class="btn btn-sm btn-warning rounded-pill d-flex align-items-center hover-scale"
                         data-bs-toggle="modal" data-bs-target="#editPromosiModal{{ $promosi->id }}" title="Edit">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                      </a>
                      <form action="{{ route('promosi.destroy', $promosi->id) }}" method="POST"
                            class="d-inline delete-promosi-form">
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
                  <td colspan="6" class="text-center text-muted">Belum ada data promosi</td>
                </tr>
                @endforelse
              </tbody>
            </table>

            <div class="d-flex justify-content-end">
              {{ $promosis->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- modal create --}}
@include('promosi.create')

{{-- modal edit --}}
@foreach($promosis as $promosi)
  @include('promosi.edit', ['promosi' => $promosi])
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
