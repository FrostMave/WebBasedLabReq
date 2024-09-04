@extends('layouts.master', ['title' => 'Detail Pengajuan'])
@section('title', 'Detail Sample')
@section('content')

<div>
    <h4 class="mb-3 mb-md-2">Detail Pengajuan Nomor {{$sample->id}} </h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/status')}}">Status</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Pengajuan</li>
    </ol>
</nav>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12 bg-white mt-3 border">
            <!-- Tabel Informasi Sample -->
            <table class="table table-borderless">
                <tr>
                    <td style="width:400px;">Nomor Pengajuan</td>
                    <td> {{ $sample->id }} </td>
                </tr>
                <tr>
                    <td>Nama Pelanggan</td>
                    <td> {{ $sample->user->name }} </td>
                </tr>
                <tr>
                    <td>Nomor Telepon/Fax</td>
                    <td> {{ $sample->user->pelanggan->telepon }} </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td> {{ $sample->user->email }} </td>
                </tr>
                <tr>
                    <td>Jenis Pengujian</td>
                    <td> {{ $sample->jenisPengujian->nama_pengujian }} </td>
                </tr>
                <tr>
                    <td>Jumlah Contoh</td>
                    <td> {{ $sample->jumlah_contoh }} </td>
                </tr>
                <tr>
                    <td>Status Contoh</td>
                    <td> @if($sample->status_contoh == 'dikirim') {{ $sample->status_contoh }} @else Datang ke Laboratorium @endif </td>
                </tr>
                @if($sample->status_contoh == 'dikirim')
                <tr>
                    <td>Tanggal Pengiriman Contoh</td>

                    @if(isset($sample->tanggal_pengiriman))
                    <td> {{ $sample->tanggal_pengiriman }} </td>
                    @else
                    <td> Contoh belum dikirim </td>
                    @endif
                </tr>
                @endif
                <tr>
                    <td>Status Penerimaan Contoh</td>
                    @if(!isset($sample->penerimaan->tanggal_terima))
                    <td> Contoh belum diterima </td>
                    @elseif(isset($sample->penerimaan->tanggal_terima))
                    <td>Contoh diterima pada {{ date('l, d-m-Y', strtotime($sample->penerimaan->tanggal_terima)) }} </td>
                    @endif
                </tr>

            </table>

            @if($sample->stat == 'Pengujian' && $sample->status_contoh == 'dikirim' && !isset($sample->tanggal_pengiriman))
            <div class="card border-danger mt-5">
                <div class="card-body text-md-center">
                    Silakan isi form pengiriman contoh <br>
                    <a href="/pengiriman-contoh/{{$sample->id}}" class="btn btn-primary">Form Pengiriman Contoh</a>
                </div>
            </div>
            @endif


            <!-- Bagian Tahapan -->
            <div class="card border-success mt-5">
                <div class="card-body">
                    <b>Tahap : <b class="text-success">{{ $sample->stat }} </b></b>
                    <div class="text-md-center">
                        @if($sample->stat == 'Persetujuan')
                        <p> Pengajuan masih dalam proses persetujuan.</p>
                        <div class="text-md-right">
                            <a href="/pengajuan/{{$sample->id}}/edit" class="btn btn-link btn-sm text-success">Edit</a>
                            <button type="button" class="btn btn-link text-danger btn-sm" data-toggle="modal" data-target="#Batalkan">
                                Batalkan
                            </button>
                        </div>
                        @elseif($sample->stat == 'Pembayaran')
                        @if($sample->biaya->bukti == NULL)
                        <p> Biaya analisa contoh adalah sebesar <b> Rp. {{ $sample->biaya->biaya }} </b></p>
                        <p>Silahkan melakukan pembayaran.</p>


                        <form method="POST" action="/sample/{{$sample->id}}/upload-bukti" class="mt-3 forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="bukti" class="col-sm-4 col-form-label text-md-right"><b>Upload bukti pembayaran</b> </label>

                                <div class="col-md-5 text-md-center">
                                    <input type="file" name="bukti" id="bukti"><br>
                                    @error('bukti')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        </form>
                        @else
                        <p>Menunggu Konfirmasi Pembayaran.</p>
                        <div class="row justify-content-center">
                            <img style="max-height:300px" src="{{ asset('storage/' . $sample->biaya->bukti) }}" class="img-thumbnail">
                        </div>
                        @endif

                        @elseif($sample->stat == 'Pengujian')
                        <p>Contoh masih dalam proses pengujian.</p>

                        @elseif($sample->stat == 'Pembuatan Laporan')
                        <p>Proses pengujian telah selesai. Laporan hasil masih dalam proses pembuatan</p>

                        @elseif($sample->stat == 'Selesai')

                        <p> Proses pengujian telah selesai. </p>
                        <p>Laporan dikirim pada <b class="text-success"> {{ date('l, d-m-Y', strtotime($sample->hasil->updated_at)) }}. </b></p>
                        <div class="mt-3">
                            <a href="{{asset('storage/' . $sample->hasil->laporan)}}" class="btn btn-primary" target="_blank">Download laporan</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-5 mb-3">
                <a href="{{url('/status')}}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Batalkan" tabindex="-1" role="dialog" aria-labelledby="BatalkanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="BatalkanLabel">Konfirmasi Pembatalan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/sample/{{$sample->id}}/delete">
                <div class="modal-body">

                    @csrf
                    @method('delete')
                    <p>Batalkan pengajuan analisa nomor {{ $sample->id }}</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection