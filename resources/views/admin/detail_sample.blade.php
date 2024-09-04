@extends('layouts.master')
@section('title', 'Detail Pengajuan')
@section('content')

<div>
    <h4 class="mb-3 mb-md-2">Detail Pengajuan Nomor {{$sample->id}} </h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Pengajuan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Pengajuan</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless">
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
                    </table>
                </div>

                <!-- Bagian Penerimaan -->
                @if(isset($sample->tanggal_pengiriman) || $sample->status_contoh == 'datang')
                @if(!isset($sample->penerimaan))
                <div class="card border-danger mt-5">
                    <div class="card-body text-md-center">
                        Silakan isi form penerimaan contoh
                        <a href="/penerimaan-contoh/{{$sample->id}}">disini</a>
                    </div>
                </div>
                @elseif(isset($sample->penerimaan->tanggal_terima))
                <table class="table table-borderless">
                    <tr>
                        <td style="width:400px;">Tanggal Terima Contoh</td>
                        <td> {{ date('l, d-m-Y', strtotime($sample->penerimaan->tanggal_terima)) }} </td>
                    </tr>
                    @if(isset($sample->lokasi))
                    <tr>
                        <td>Lokasi </td>
                        <td>
                            <?php
                            $lokasi = explode('|', $sample->lokasi)
                            ?>
                            Desa {{$lokasi[0]}}, Kecamatan {{$lokasi[1]}}, {{$lokasi[2]}}
                        </td>
                    </tr>
                    @endif
                </table>
                @endif
                @endif


                <!-- Bagian Tahapan -->
                <div class="card border-success mt-5">
                    <div class="card-body">
                        <b>Tahap : <b class="text-success">{{ $tahap }} </b></b>
                        @if($tahap == 'Persetujuan')
                        <form method="POST" action="/persetujuan/insert">
                            @csrf
                            <input id="sample_id" type="hidden" name="sample_id" value=" {{ $sample->id }}">

                            <div class="form-group row">
                                <label for="persetujuan" class="col-md-4 col-form-label text-md-right">Status Persetujuan</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('persetujuan') is-invalid @enderror" name="persetujuan" id="persetujuan" required>
                                        <option selected disabled>Pilih salah satu</option>
                                        <option value="diterima">Terima Pengajuan</option>
                                        <option value="ditolak">Tolak Pengajuan</option>
                                    </select>
                                    @error('persetujuan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="biaya" style="display: none;">
                                <label for="biaya" class="col-md-4 col-form-label text-md-right">Biaya</label>
                                <div class="col-md-6">
                                    <input id="biaya" type="number" class="form-control" name="biaya" value=" {{ old('biaya') }}" autocomplete="biaya">
                                </div>

                            </div>
                            <div class="form-group row" id="keterangan" style="display: none;">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-right">Keterangan</label>
                                <div class="col-md-6">
                                    <input id="keterangan" type="text" class="form-control" name="keterangan" value=" {{ old('keterangan') }}" autocomplete="keterangan">
                                </div>

                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type=" submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>

                        </form>
                        @elseif($tahap == 'Pembayaran')
                        <br>
                        <b>Biaya Analisa : Rp.{{ $sample->biaya->biaya }}. </b>
                        <div class="text-md-center">
                            @if($sample->biaya->bukti == NULL )
                            Pelanggan belum melakukan pembayaran.
                            @else
                            <div class="row justify-content-center">
                                <img style="max-height:300px" src="{{ asset('storage/' . $sample->biaya->bukti) }}" class="img-thumbnail mt-2 mb-2">
                            </div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#konfirmasiPembayaran">
                                Konfirmasi Pembayaran
                            </button>
                            @endif
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="konfirmasiPembayaran" tabindex="-1" role="dialog" aria-labelledby="konfirmasiPembayaranLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="konfirmasiPembayaranLabel">Konfirmasi Pembayaran</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="/pembayaran/update">
                                        <div class="modal-body">

                                            @csrf
                                            <input type="hidden" name="id" value="{{ $sample->biaya->id }}">
                                            <input type="hidden" name="status" value="dibayar">

                                            <b>Konfirmasi </b>pembayaran pengajuan analisa dengan nomor {{ $sample->id }} <br> sebesar Rp. {{ $sample->biaya->biaya }}.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @elseif($tahap == 'Pengujian')
                        @if(isset($sample->penerimaan))
                        <form method="POST" action="/hasil/insert" enctype="multipart/form-data">
                            @csrf
                            <input id="sample_id" type="hidden" name="sample_id" value=" {{ $sample->id }}">

                            <div class="form-group row">
                                <label for="hasil" class="col-md-4 col-form-label text-md-right">Status Analisa</label>
                                <div class="col-md-6">
                                    @error('tgl_kirim_laporan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <select class="form-control @error('hasil') is-invalid @enderror" name="hasil" id="hasil" required>
                                        <option selected disabled>Contoh masih dalam proses analisa</option>
                                        <option value="selesai">Analisa contoh selesai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="laporan" style="display: none;">
                                <label for="laporan" class="col-md-4 col-form-label text-md-right">Status Contoh</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('laporan') is-invalid @enderror" name="laporan" id="laporan" required>
                                        <option selected disabled>Pilih salah satu</option>
                                        <option value="belum">Laporan dakam proses pembuatan</option>
                                        <option value="dikirim">Kirim Laporan</option>
                                    </select>
                                    @error('laporan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group row" id="file_laporan" style="display: none;">
                                <label for="file_laporan" class="col-md-4 col-form-label text-md-right">Pengiriman Laporan</label>
                                <div class="col-md-6">
                                    <input id="file_laporan" type="file" name="file_laporan">
                                    <br>
                                    <span class="text-secondary">
                                        File berupa pdf.
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type=" submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </form>
                        @else
                        <div class="text-md-center">
                            Contoh belum diterima
                        </div>
                        @endif

                        @elseif($tahap == 'Pembuatan Laporan')
                        @if(isset($sample->penerimaan))
                        <form method="POST" action="/hasil/update" enctype="multipart/form-data">
                            @csrf
                            <input id="id" type="hidden" name="id" value=" {{ $sample->id }}">
                            <div class="form-group row" id="file_laporan">
                                <label for="file_laporan" class="col-md-4 col-form-label text-md-right">Pengiriman Laporan</label>
                                <div class="col-md-6">
                                    <input id="file_laporan" type="file" name="file_laporan">
                                    <br>
                                    @error('file_laporan')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <span class="text-secondary">
                                        File berupa pdf.
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type=" submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </form>
                        @else
                        <div class="text-md-center">
                            Contoh belum diterima
                        </div>
                        @endif
                        @elseif($tahap == 'Selesai')
                        <div class="text-md-center">
                            <p>Analisa pada pengajuan nomor <b> {{ $sample->id }} </b> telah <b> selesai </b></p>
                            <p>Laporan hasil analisa telah dikirim</p>
                            <a href="{{asset('storage/' . $sample->hasil->laporan)}}" class="text-link" target="_blank">Download laporan</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="mt-5 mb-3">
                    <a href="{{ url('/admin/semua') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    $('select[name=persetujuan]').on('change', function() {
        if (this.value == 'diterima') {
            $("#biaya").show();
            $("#keterangan").hide();
            $("input[name=biaya]").attr('required', true);
            $("input[name=keterangan]").attr('required', false);
        } else if (this.value == 'ditolak') {
            $("#keterangan").show();
            $("#biaya").hide();
            $('input[name=biaya]').attr('required', false);
            $('input[name=keterangan]').attr('required', true);
        } else {
            $("#biaya").hide();
            $("#keterangan").hide();
        }
    });
    $('select[name=laporan]').on('change', function() {
        if (this.value == 'dikirim') {
            $("#file_laporan").show();
            $('input[name=file_laporan]').attr('required', true);
        } else {
            $("#file_laporan").hide();
            $('input[name=file_laporan]').attr('required', false);
        }
    });
    $('select[name=hasil]').on('change', function() {
        if (this.value == 'selesai') {
            $("#laporan").show();
        } else {
            $("#laporan").hide();
        }
    });
</script>
@endsection