@extends('layouts.master', ['title' => 'Edit Pengajuan'])


@section('title', 'Edit Pengajuan Analisa')

@section('content')

<div>
    <h4 class="mb-3 mb-md-2">Edit Pengajuan</h4>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <form method="POST" action="/pengajuan/update">
                    @csrf
                    <input type="hidden" name="id" value="{{$sample->id}}">

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label ">Nama</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control-plaintext" name="name" value="{{ Auth::user()->name }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label ">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control-plaintext" name="email" value="{{ Auth::user()->email }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telepon" class="col-md-4 col-form-label ">Telepon/fax</label>
                        <div class="col-md-6">
                            <input id="telepon" type="text" class="form-control" name="telepon" value="@if(isset(Auth::user()->pelanggan->telepon)) {{ Auth::user()->pelanggan->telepon }} @else {{ old('telepon') }} @endif" required autocomplete="telepon" autofocus required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telepon" class="col-md-4 col-form-label ">Jenis Pengujian</label>
                        <div class="col-md-6">
                            <select class="form-control" name="jenis" id="jenis" required>
                                @foreach($jenis as $j)
                                <option value="{{ $j->id }}" @if($j->id == $sample->jenis_pengujian_id) selected @endif>{{ $j->nama_pengujian }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_contoh" class="col-md-4 col-form-label ">Jumlah Contoh</label>
                        <div class="col-md-6">
                            <input id="jumlah_contoh" type="number" class="form-control" name="jumlah_contoh" value="{{$sample->jumlah_contoh}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_contoh" class="col-md-4 col-form-label ">Status Contoh</label>
                        <div class="col-md-6">
                            <select class="form-control @error('status_contoh') is-invalid @enderror" name="status_contoh" id="status_contoh" required>
                                <option selected disabled>Pilih salah satu</option>
                                <option value="dikirim" @if($sample->status_contoh=='dikirim') selected @endif >Dikirim</option>
                                <option value="datang" @if($sample->status_contoh=='datang') selected @endif>Datang ke Laboratorim</option>
                            </select>
                            @error('status_contoh')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type=" submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <a href="/sample/{{$sample->id}}" class="btn btn-light"> Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $('select[name=status_contoh]').on('change', function() {
        if (this.value == 'dikirim') {
            $("#tgl_kirim").show();
        } else {
            $("#tgl_kirim").hide();
        }
    });
</script>
@endsection