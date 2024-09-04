@extends('layouts.master', ['title' => 'Pengujian Pengajuan Analisa'])

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div>
  <h4 class="mb-3 mb-md-2">Pengujian Pengajuan Analisa</h4>
</div>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Pengajuan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pengujian</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Persetujuan Pengajuan Analisa</h6>
        <div class="table-responsive">
          @if(count($samples) >= 1)
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th scope="col">Nomor Pengajuan</th>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Status Penerimaan Contoh</th>
                <th scope="col">Tanggal Pengajuan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($samples as $sample)
              <tr>
                <th scope="row"> {{ $sample->id }} </th>
                <td> {{ $sample->user->name }} </td>
                <td>
                  @if(isset($sample->penerimaan))
                  Contoh diterima
                  @else
                  Contoh belum diterima
                  @endif
                </td>
                <td> {{ $sample->created_at->format('d-m-Y') }} </td>
                <td>
                  <a href="/pengajuan/{{ $sample->id }}" class="text-primary">detail</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="d-flex justify-content-center mt-5 ">
          Tidak ada pengajuan analisa contoh.
        </div>
        @endif
      </div>
    </div>
  </div>
</div>



@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush