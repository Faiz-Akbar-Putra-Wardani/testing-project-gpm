@extends('layout')

@section('content')
<div class="pc-container">
  <div class="pc-content">

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
         <div class="card-header bg-primary d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-white">Tambah Transaksi</h5>
            <a href="{{ route('transaksi.index') }}" class="btn btn-light btn-sm border rounded-circle d-flex align-items-center justify-content-center" style="width:32px; height:32px;" title="Kembali">
                <i class="bi bi-arrow-left"></i>
            </a>
         </div>

          <div class="card-body">
            <form id="transaksiForm" action="{{ route('transaksi.store') }}" method="POST">
              @csrf

              <!-- Nav Tabs -->
              <ul class="nav nav-tabs mb-3" id="transaksiTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pelanggan-tab" data-bs-toggle="tab" data-bs-target="#pelanggan" type="button" role="tab">Data Pelanggan</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="transaksi-tab" data-bs-toggle="tab" data-bs-target="#transaksi" type="button" role="tab">Data Transaksi</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pembayaran-tab" data-bs-toggle="tab" data-bs-target="#pembayaran" type="button" role="tab">Metode Pembayaran</button>
                </li>
              </ul>

              <div class="tab-content" id="transaksiTabContent">

                <div class="tab-pane fade show active" id="pelanggan" role="tabpanel">
                  @include('transaksi.tabs.pelanggan')
                </div>

                <div class="tab-pane fade" id="transaksi" role="tabpanel">
                  @include('transaksi.tabs.transaksi')
                </div>

                <div class="tab-pane fade" id="pembayaran" role="tabpanel">
                  @include('transaksi.tabs.pembayaran')
                </div>
              </div> <!-- end .tab-content -->

              <div class="mt-3 text-end" id="formActions" style="display: none;">
                <button type="reset" class="btn btn-secondary rounded-pill">Reset</button>
                <button type="submit" class="btn btn-primary rounded-pill" id="btnSubmit">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


{{-- @push('scripts')
<script src="{{ asset('assets/js/transaksi.js') }}"></script>
@endpush --}}
@endsection
