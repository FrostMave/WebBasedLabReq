@extends('layouts.master', ['title' => 'Profile'])

@section('content')
@push('plugin-styles')
<!-- <link href="{{ asset('css/style.css') }}" rel="stylesheet" /> -->
@endpush

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>
</nav>

@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif


<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card ">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-2">
                        <img src="{{asset('/storage/' . $user->profile )}}" class="img-lg rounded-circle" id="profile">
                    </div>
                    <div class="col-md-8">
                        <h4>
                            {{$user->name}}
                        </h4>
                        <span class="text-secondary">{{$user->email}} </span>
                    </div>
                    <div class="col-md-2 text-md-center">
                        @role('user')
                        <div>
                            <h1 class="display-2"> {{ $total }} </h1>
                            <p>Pengajuan Analisa</p>
                        </div>
                        @endrole
                    </div>
                </div>
                <hr>
                <h5 class="text-md-center ">Profile</h5>
                <hr>
                <div class="table-responsive col-md-8 mx-auto">
                    <table class="table table-hover table-borderless">
                        <tr>
                            <td>Nama</td>
                            <td> {{$user->name}} </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td> {{$user->email}} </td>
                        </tr>
                        <tr>
                            <td>Nomor Telepon/Fax</td>
                            @if(isset($user->pelanggan))
                            <td> {{$user->pelanggan->telepon}} </td>
                            @endif
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            @if(isset($user->pelanggan))
                            <td> {{$user->pelanggan->alamat}} </td>
                            @endif
                        </tr>
                    </table>
                </div>
                <div class="text-md-right mt-5">
                    <a href="/profile/edit" class="btn btn-link">Edit Profile</a>
                    <a href="/profile/ubah-password" class="btn btn-link">Ganti Password</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection