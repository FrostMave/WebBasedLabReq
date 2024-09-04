@extends('layouts.master', ['title' => 'Status Pengajuan'])
@section('content')
<div>
    <h4 class="mb-3 mb-md-2">Status Pengajuan Analisa </h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/status">Pengajuan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Status Pengajuan</li>
    </ol>
</nav>

<div class="row justify-content-center">
    <div class="card col-md-11 stretch-card">
        <div class="card-body">

            <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="semua-line-tab" data-toggle="tab" href="#semua" role="tab" aria-controls="semua" aria-selected="true">Semua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="persetujuan-line-tab" data-toggle="tab" href="#persetujuan" role="tab" aria-controls="persetujuan" aria-selected="false">Persetujuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pembayaran-line-tab" data-toggle="tab" href="#pembayaran" role="tab" aria-controls="pembayaran" aria-selected="false">Pembayaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pengujian-line-tab" data-toggle="tab" href="#pengujian" role="tab" aria-controls="pengujian" aria-selected="false">Pengujian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="hasil-line-tab" data-toggle="tab" href="#hasil" role="tab" aria-controls="hasil" aria-selected="false">Selesai</a>
                </li>
            </ul>
            <div class="col-md-11">
                <div class="tab-content mt-3" id="lineTabContent">
                    <!-- Tab Semua -->
                    <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="semua-line-tab">

                        <?php
                        $persetujuan = 0;
                        $biaya = 0;
                        $uji = 0;
                        $hasil = 0
                        ?>
                        <table class="table table-borderless">
                            @foreach($samples as $sample)
                            <tr>
                                <td scope="row"> Pengajuan Nomor
                                    {{ $sample->id }}</td>
                                <td>
                                    Status :
                                    <b class="text-success">
                                        <b class="@if($sample->stat == 'ditolak') text-danger @else text-success @endif">
                                            {{ $sample->stat }}
                                        </b>
                                    </b>
                                </td>

                                <td>
                                    <div class="text-secondary">
                                        Tanggal Pengajuan
                                        {{ $sample->created_at->format('d-m-Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-md-left my-2">
                                        <a href="sample/{{ $sample->id }}">Detail</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        @if(!isset($sample))
                        <div class="col-md-12 mt-3 text-md-center">
                            <div class="card-body">
                                Belum ada pengajuan pengujian
                            </div>
                        </div>
                        @endif


                    </div>
                    <!-- Tab Persetujuan -->
                    <div class="tab-pane fade" id="persetujuan" role="tabpanel" aria-labelledby="persetujuan-line-tab">

                        <table class="table table-borderless">
                            @foreach($samples as $sample)
                            @if($sample->stat == 'Persetujuan')
                            <tr>
                                <td scope="row"> Pengajuan Nomor
                                    {{ $sample->id }}</td>
                                <td>
                                    Status :
                                    <b class="text-warning">
                                        Menunggu konfirmasi
                                    </b>
                                </td>

                                <td>
                                    <div class="text-secondary">
                                        Tanggal Pengajuan
                                        {{ $sample->created_at->format('d-m-Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-md-left my-2">
                                        <a href="sample/{{ $sample->id }}">Detail</a>
                                    </div>
                                </td>
                            </tr>
                            <?php $persetujuan = $persetujuan + 1 ?>
                            @endif
                            @endforeach
                        </table>


                        @if($persetujuan == 0)
                        <div class="col-md-12 mt-3 text-md-center">
                            <div class="card-body">
                                Belum ada pengajuan pengujian
                            </div>
                        </div>
                        @endif



                    </div>
                    <!-- Tab Pembayaran -->
                    <div class="tab-pane fade" id="pembayaran" role="tabpanel" aria-labelledby="pembayaran-line-tab">
                        <table class="table table-borderless">
                            @foreach($samples as $sample)
                            @if($sample->stat == 'Pembayaran')
                            <tr>
                                <td scope="row"> Pengajuan Nomor
                                    {{ $sample->id }}</td>
                                <td>
                                    Biaya analisa : <b> Rp.{{ $sample->biaya->biaya }}. </b><br>
                                </td>
                                <td>
                                    <div class="text-secondary">
                                        Tanggal Pengajuan
                                        {{ $sample->created_at->format('d-m-Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-md-left my-2">
                                        <a href="sample/{{ $sample->id }}">Detail</a>
                                    </div>
                                </td>
                            </tr>
                            <?php $biaya = $biaya + 1 ?>
                            @endif
                            @endforeach
                        </table>

                        @if($biaya == 0)
                        <div class="col-md-12 mt-3 text-md-center">
                            <div class="card-body">
                                Belum ada pengajuan pengujian
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- Tab Pengujian -->
                    <div class="tab-pane fade" id="pengujian" role="tabpanel" aria-labelledby="pengujian-line-tab">
                        <table class="table table-borderless">
                            @foreach($samples as $sample)
                            @if($sample->stat == 'Pengujian')
                            <tr>
                                <td scope="row"> Pengajuan Nomor
                                    {{ $sample->id }}</td>
                                <td>
                                    <div class="text-secondary">
                                        @if($sample->status_contoh == 'dikirim' && !isset($sample->tanggal_pengiriman))
                                        Status Contoh :
                                        <b class="text-danger">
                                            Belum dikirim
                                        </b>
                                        @elseif(isset($sample->penerimaan->tanggal_terima))
                                        Status Contoh :
                                        <div class="text-success">
                                            Telah diterima pada {{ date('d-m-Y', strtotime($sample->penerimaan->tanggal_terima)) }}
                                        </div>
                                        @else
                                        Status Contoh : Belum diterima
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="text-secondary">
                                        Tanggal Pengajuan
                                        {{ $sample->created_at->format('d-m-Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-md-left my-2">
                                        <a href="sample/{{ $sample->id }}">Detail</a>
                                    </div>
                                </td>
                            </tr>
                            <?php $uji = $uji + 1 ?>
                            @endif
                            @endforeach
                        </table>



                        @if($uji == 0)
                        <div class="col-md-12 mt-3 text-md-center">
                            <div class="card-body">
                                Belum ada pengajuan pengujian
                            </div>
                        </div>
                        @endif

                    </div>
                    <!-- Tab Hasil -->
                    <div class="tab-pane fade" id="hasil" role="tabpanel" aria-labelledby="hasil-line-tab">
                        <table class="table table-borderless">
                            @foreach($samples as $sample)
                            @if($sample->stat == 'Pembuatan Laporan' || $sample->stat == 'Selesai')
                            <tr>
                                <td scope="row"> Pengajuan Nomor
                                    {{ $sample->id }}</td>
                                <td>
                                    Status Laporan :
                                    @if($sample->stat == 'Pembuatan Laporan')
                                    <b class="text-secondary">
                                        Masih dalam proses pembuatan
                                    </b>
                                    @elseif($sample->stat == 'Selesai')
                                    <b class="text-success">
                                        Laporan telah dikirim <br>
                                        <a href="{{asset('storage/' . $sample->hasil->laporan)}}" class="text-link" target="_blank">Download laporan</a>
                                    </b>
                                    @endif
                                </td>
                                <td>
                                    @if($sample->stat == 'Selesai')
                                    @if(isset($sample->feedback->first()->sample_id))
                                    <small class="text-success">
                                        Umpan balik <br> sudah dikirim.
                                    </small>
                                    @else
                                    <a class="btn btn-info btn-sm" href="/umpan-balik/{{$sample->id}}">Umpan Balik</a>
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    <div class="text-md-left my-2">
                                        <a href="sample/{{ $sample->id }}">Detail</a>
                                    </div>
                                </td>

                            </tr>
                            <?php $hasil = $hasil + 1 ?>
                            @endif
                            @endforeach
                        </table>

                        @if($hasil == 0)
                        <div class="col-md-12 mt-3 text-md-center">
                            <div class="card-body">
                                Belum ada pengajuan pengujian
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection