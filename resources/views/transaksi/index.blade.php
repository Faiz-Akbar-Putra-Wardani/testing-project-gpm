@extends('layout')

@section('content')
<div class="pc-container">
  <div class="pc-content">
    <div class="row">
      <div class="col-sm-12">
        <div class="card shadow-sm rounded-4 border-0 overflow-hidden">
          <div class="card-header d-flex justify-content-between align-items-center"
               style="background: linear-gradient(135deg, #7F00FF 0%, #00CFFF 100%); color: #fff;">
            <h5 class="mb-0 fw-bold text-white">Daftar Transaksi</h5>

            <a href="{{ route('transaksi.create') }}"
               class="btn text-white fw-bold rounded-pill px-4 d-flex align-items-center shadow-sm hover-scale"
               style="background: linear-gradient(135deg, #FF6EC7 0%, #7F00FF 100%);">
              <i class="bi bi-plus-lg me-2"></i> Tambah 
            </a>
          </div>

                <div class="card-body p-3">
             <div class="table-responsive">
                <table id="transaksi-table"
                    class="table table-hover table-bordered text-center align-middle nowrap w-100"
                    data-url="{{ route('transaksi.getData') }}">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">No KTP</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Alamat Instalasi</th>
                            <th class="text-center">Paket Internet</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                      <tbody>
                     </tbody>
                </table>
            </div>
        </div>


      </div>
    </div>
  </div>
</div>

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

