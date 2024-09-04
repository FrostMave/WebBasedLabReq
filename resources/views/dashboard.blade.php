@extends('layouts.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
  </div>
  
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
  <div class="row flex-grow justify-content-around">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0"><a href="/admin/semua" class="text-dark">Total Pengajuan</a></h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2 mt-3"> {{ count($samples) }} </h3>
              </div>
              <div class="col-6 col-md-6 col-xl-12 text-right">
                <a href="/admin/semua" class="mb-2 text-primary"> 
                  <span class="link-title">lihat</span>  
                  <i class="link-icon" data-feather="chevrons-right"></i> 
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0"><a href="/admin/semua" class="text-dark">Menunggu Persetujuan</a></h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2 mt-3"> {{ $data['persetujuan'] }} </h3>
              </div>
              <div class="col-6 col-md-6 col-xl-12 text-right">
                <a href="/admin/persetujuan" class="mb-2 text-primary"> 
                  <span class="link-title">lihat</span>  
                  <i class="link-icon" data-feather="chevrons-right"></i> 
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0"><a href="/admin/laporan" class="text-dark">konfirmasi pembayaran</a></h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-6 col-xl-5">
                <h3 class="mb-2 mt-3"> {{ $data['pembayaran'] }} </h3>
              </div>
              <div class="col-6 col-md-6 col-xl-12 text-right">
                <a href="/admin/pembayaran" class="mb-2 text-primary"> 
                  <span class="link-title">lihat</span>  
                  <i class="link-icon" data-feather="chevrons-right"></i> 
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow justify-content-around">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0"><a href="/admin/semua" class="text-dark">Pengajuan dalam pengujian</a></h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2 mt-3"> {{ $data['pengujian'] }} </h3>
              </div>
              <div class="col-6 col-md-6 col-xl-12 text-right">
                <a href="/admin/pengujian" class="mb-2 text-primary"> 
                  <span class="link-title">lihat</span>  
                  <i class="link-icon" data-feather="chevrons-right"></i> 
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0"><a href="/admin/laporan" class="text-dark">Pengajuan Menunggu Laporan</a></h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-6 col-xl-5">
                <h3 class="mb-2 mt-3"> {{ $data['laporan'] }} </h3>
              </div>
              <div class="col-6 col-md-6 col-xl-12 text-right">
                <a href="/admin/laporan" class="mb-2 text-primary"> 
                  <span class="link-title">lihat</span>  
                  <i class="link-icon" data-feather="chevrons-right"></i> 
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0"><a href="/admin/laporan" class="text-dark">Laporan Selesai</a></h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-6 col-xl-5">
                <h3 class="mb-2 mt-3"> {{ $data['selesai'] }} </h3>
              </div>
              <div class="col-6 col-md-6 col-xl-12 text-right">
                <a href="/admin/selesai" class="mb-2 text-primary"> 
                  <span class="link-title">lihat</span>  
                  <i class="link-icon" data-feather="chevrons-right"></i> 
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->

@endsection

