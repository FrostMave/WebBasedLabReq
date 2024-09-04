@extends('layouts.master', ['title' => 'Tambah Pengajuan'])

@section('content')

<div>
    <h4 class="mb-3 mb-md-2">Tambah Pengajuan Analisa Contoh</h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/status">Pengajuan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Pengajuan</li>
    </ol>
</nav>




<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/pengajuan/save" class="mt-3 forms-sample ml-3">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Nama</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control-plaintext" name="name" value="{{ $user->name }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control-plaintext" name="email" value="{{ $user->email }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telepon" class="col-md-4 col-form-label">Telepon/fax</label>
                        <div class="col-md-6">
                            <input id="telepon" type="text" class="form-control" name="telepon" value="@if(isset($user->pelanggan->telepon)) {{ $user->pelanggan->telepon }} @else {{ old('telepon') }} @endif" required autocomplete="telepon" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telepon" class="col-md-4 col-form-label">Jenis Pengujian</label>
                        <div class="col-md-6">
                            <select class="form-control" name="jenis" id="jenis">
                                @foreach($jenis as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_pengujian }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_contoh" class="col-md-4 col-form-label">Jumlah Contoh</label>
                        <div class="col-md-6">
                            <input id="jumlah_contoh" type="number" class="form-control" name="jumlah_contoh" value=" {{ old('jumlah_contoh') }} " required autocomplete="jumlah_contoh">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_contoh" class="col-md-4 col-form-label">Status Contoh</label>
                        <div class="col-md-6">
                            <select class="form-control @error('status_contoh') is-invalid @enderror" name="status_contoh" id="status_contoh" required>
                                <option selected disabled>Pilih salah satu</option>
                                <option value="dikirim">Dikirim</option>
                                <option value="datang">Datang ke Laboratorim</option>
                            </select>
                            @error('status_contoh')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="/home" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection