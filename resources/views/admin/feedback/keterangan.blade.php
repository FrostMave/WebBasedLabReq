@extends('layouts.master', ['title' => 'Keterangan Umpan Balik'])

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div>
  <h4 class="mb-3 mb-md-2">Keterangan Umpan Balik</h4>
</div>


<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/admin/umpan-balik">Umpan Balik</a></li>
    <li class="breadcrumb-item active" aria-current="page">Keterangan</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Q. {{ $tanya->pertanyaan }}</h6>
        <div class="row text-secondary mb-3">
          <span class="col-md-2">Baik : {{ countFeedback($tanya->id)->baik }}</span>
          <span class="col-md-2">Sedang : {{ countFeedback($tanya->id)->sedang }}</span>
          <span class="col-md-2">Kurang : {{ countFeedback($tanya->id)->kurang }}</span>
        </div>
        <div class="table-responsive">
          @if(count($feedback) >= 1)
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Keterangan</th>
              </tr>
            </thead>
            <tbody>
            @php
            $count = 1;
            @endphp
              @foreach($feedback as $fb)
                @if($fb->keterangan != NULL)
                  <tr>
                    <th scope="row"> {{ $count }} </th>
                    <td> {{ $fb->keterangan }} </td>
                  </tr>
                  @php
                  $count++;
                  @endphp
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="d-flex justify-content-center mt-5 ">
          Belum ada umpan balik dari pengguna.
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