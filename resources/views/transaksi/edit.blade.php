@extends('layout')

@section('content')
<div class="pc-container">
  <div class="pc-content">

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
         <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">Update Transaksi</h5>
            <a href="{{ route('transaksi.index') }}"
               class="btn btn-light btn-sm border rounded-circle d-flex align-items-center justify-content-center"
               style="width:32px; height:32px;" title="Kembali">
                <i class="bi bi-arrow-left"></i>
            </a>
          </div>

          <div class="card-body">
            <form id="transaksiForm" action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
              @csrf
              @method('PUT')

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
                  @include('transaksi.tabs.pelanggan', ['transaksi' => $transaksi])
                  <div class="text-end mt-3">
                    <button type="button" class="btn btn-primary rounded-pill nextBtn" data-next="#transaksi">Next</button>
                  </div>
                </div>

                <div class="tab-pane fade" id="transaksi" role="tabpanel">
                  @include('transaksi.tabs.transaksi', ['transaksi' => $transaksi])
                 <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-secondary rounded-pill prevBtn" data-prev="#pelanggan">Back</button>
                    <button type="button" class="btn btn-primary rounded-pill nextBtn" data-next="#pembayaran">Next</button>
                  </div>
                </div>

                <div class="tab-pane fade" id="pembayaran" role="tabpanel">
                  @include('transaksi.tabs.pembayaran', ['transaksi' => $transaksi])
                   <div class="d-flex justify-content-between mt-3">
                  </div>
                </div>
              </div> <!-- end .tab-content -->

              <div class="mt-3 text-end" id="formActions" style="display: none;">
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary rounded-pill">Batal</a>
                <button type="submit" class="btn btn-primary rounded-pill" id="btnSubmit">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
