@extends('layouts.master', ['title' => 'Penerimaan Contoh'])
@section('content')
<div>
    <h4 class="mb-3 mb-md-2">Penerimaan Contoh Pengajuan Nomor {{$sample->id}} </h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Penerimaan Contoh</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/penerimaan-contoh/insert" class="mt-3 forms-sample ml-3">
                    @csrf
                    <div class="form-group row" id="nomor">
                        <label for="nomor" class="col-sm-3 col-form-label">Nomor Pengujian</label>
                        <div class="col-md-6">
                            <input id="nomor" type="text" class="form-control-plaintext" readonly name="nomor" value="{{$sample->id}}" autocomplete="nomor">
                        </div>
                    </div>
                    <div class="form-group row" id="jumlah">
                        <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-md-6">
                            <input id="jumlah" type="text" class="form-control-plaintext" readonly name="jumlah" value="{{ $sample->jumlah_contoh }}" autocomplete="jumlah">
                        </div>
                    </div>
                    <div class="form-group row" id="jenis">
                        <label for="jenis" class="col-sm-3 col-form-label">Jenis Pengujian</label>
                        <div class="col-md-6">
                            <input id="jenis" type="text" class="form-control-plaintext" readonly name="jenis" value="{{ $sample->jenisPengujian->nama_pengujian }}" autocomplete="jenis">
                        </div>
                    </div>
                    <h6><b>Lokasi</b></h6>
                    @if(isset($sample->lokasi))
                    @php
                    $lokasi = explode('|', $sample->lokasi);
                    @endphp
                    @endif
                    <div class="form-group row" id="kab">
                        <label for="kab" class="col-sm-3 col-form-label">Kabupaten</label>
                        <div class="col-md-6">
                            <input id="kab" type="text" class="form-control" name="kab" @if(isset($lokasi)) readonly @endif value="@if(isset($lokasi)){{  $lokasi[2] }} @else {{ old('kab') }} @endif " autocomplete="kab">
                            @error('kab')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row" id="kec">
                        <label for="kec" class="col-sm-3 col-form-label">Kecamatan</label>
                        <div class="col-md-6">
                            <input id="kec" type="text" class="form-control" name="kec" @if(isset($lokasi)) readonly @endif value="@if(isset($lokasi)){{  $lokasi[1] }} @else {{ old('kec') }} @endif " autocomplete="kec">
                            @error('kec')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row" id="desa">
                        <label for="desa" class="col-sm-3 col-form-label">Desa</label>
                        <div class="col-md-6">
                            <input id="desa" type="text" class="form-control" name="desa" @if(isset($lokasi)) readonly @endif value="@if(isset($lokasi)){{  $lokasi[0] }} @else {{ old('desa') }} @endif " autocomplete="desa">
                            @error('desa')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row" id="tgl_terima">
                        <label for="tgl_terima" class="col-sm-3 col-form-label">Tanggal Penerimaan Contoh</label>
                        <div class="col-md-6">
                            <input id="tgl_terima" type="date" class="form-control" name="tgl_terima" value="{{ old('tgl_terima') }}" autocomplete="tgl_terima" required>
                            @error('tgl_terima')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="/pengajuan/{{$sample->id}}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection