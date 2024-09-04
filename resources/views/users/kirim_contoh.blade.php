@extends('layouts.master', ['title' => 'Pengiriman Contoh'])

@section('content')

<div>
    <h4 class="mb-3 mb-md-2">Kirim Contoh</h4>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/pengiriman-contoh/{{$sample->id}}/save" class="mt-3 forms-sample ml-3">
                    @csrf

                    <div class="form-group row">
                        <label for="jenis" class="col-md-4 col-form-label">Jenis Pengujian</label>

                        <div class="col-md-6">
                            <input id="jenis" type="text" class="form-control-plaintext" name="jenis" value="{{ $sample->jenisPengujian->nama_pengujian }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jumlah" class="col-md-4 col-form-label">Jumlah Contoh</label>
                        <div class="col-md-6">
                            <input id="jumlah" type="text" class="form-control-plaintext" name="jumlah" value="{{$sample->jumlah_contoh}}" disabled>
                        </div>
                    </div>
                    <h6><b>Lokasi</b></h6>
                    <div class="form-group row">
                        <label for="kab" class="col-md-4 col-form-label">Kabupaten</label>
                        <div class="col-md-6">
                            <input id="kab" type="text" class="form-control" name="kab" value=" {{ old('kab') }} " required autocomplete="kab">
                            @error('kab')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kec" class="col-md-4 col-form-label">Kecamatan</label>
                        <div class="col-md-6">
                            <input id="kec" type="text" class="form-control" name="kec" value=" {{ old('kec') }} " required autocomplete="kec">
                            @error('kec')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desa" class="col-md-4 col-form-label">Desa</label>
                        <div class="col-md-6">
                            <input id="desa" type="text" class="form-control" name="desa" value=" {{ old('desa') }} " required autocomplete="desa">
                            @error('desa')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_pengiriman" class="col-md-4 col-form-label">Tanggal Pengiriman</label>
                        <div class="col-md-6">
                            <input id="tanggal_pengiriman" type="date" class="form-control" name="tanggal_pengiriman" value=" {{ old('tanggal_pengiriman') }} " required autocomplete="tanggal_pengiriman">
                            @error('tanggal_pengiriman')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <a href="/home" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection