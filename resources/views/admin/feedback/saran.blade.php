@extends('layouts.master', ['title' => 'Saran'])

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div>
  <h4 class="mb-3 mb-md-2">Saran</h4>
</div>


<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Saran</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Saran - saran pengguna</h6>
        <div class="table-responsive">
          @if(count($saran) >= 1)
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Saran</th>
              </tr>
            </thead>
            <tbody>
              @foreach($saran as $s)
                <tr>
                  <th scope="row"> {{ $s->id }} </th>
                  <td> {{ $s->sample->user->name }} </td>

                  <td style="word-wrap: break-word;max-width: 400px; white-space: normal !important;word-wrap: break-word;"> {{ $s->saran }} </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="d-flex justify-content-center mt-5 ">
          Belum ada saran dari pengguna.
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