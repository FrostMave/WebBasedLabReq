@extends('layouts.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/dragula/dragula.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="row justify-content-around mt-4">
    <div class=" col-md-3">
        <div class="face face1">
            <div class="content">
                <img src="{{asset('/img/card1.png')}}">
                <h5>Pengajuan Form</h5>
            </div>
        </div>
        <div class="face face2">
            <div class="content">
                <p>Anda dapat mengajukan analisa dengan form melalui fitur ini dengan melakukan registrasi dan upload form yang telah anda isi.</p>
                <a class="btn btn-outline-dark" href="{{url('/pengajuan')}}">Ajukan Form</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="face face1">
            <div class="content">
                <img src="/img/card2.png">
                <h5>Status Pengajuan</h5>
            </div>
        </div>
        <div class="face face2">
            <div class="content">
                <p>Anda dapat melihat dan memantau status dari penelitian anda. Dan anda dapat melihat status dari formulir anda juga.</p>
                <a class="btn btn-outline-dark" href="{{url('/status')}}">Lihat Status</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="face face1">
            <div class="content">
                <img src="/img/card3.png">
                <h5>Pusat Informasi</h5>
            </div>
        </div>
        <div class="face face2">
            <div class="content">
                <p><br>Anda dapat mencari informasi tentang penggunaan dan lainnya di sini.</p>
                <a class="btn btn-outline-dark" href="{{url('/info')}}">Kunjungi Pusat Informasi</a>
            </div>
        </div>
    </div>   
</div>


@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/dragula/dragula.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/dragula.js') }}"></script>
@endpush