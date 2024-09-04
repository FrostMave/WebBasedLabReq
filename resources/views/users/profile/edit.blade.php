@extends('layouts.master', ['title' => 'Edit Profile'])

@section('content')
<div>
    <h4 class="mb-3 mb-md-2">Edit Profile </h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/profile')}}">Profil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/profile/save" class="mt-3 forms-sample ml-3" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label text-md-right">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label text-md-right">Nama</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label text-md-right">Alamat</label>

                        <div class="col-md-6">
                            <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="@if(isset($user->pelanggan)){{ $user->pelanggan->alamat }}@endif" required>

                            @error('alamat')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telepon" class="col-sm-3 col-form-label text-md-right">Telepon / Fax</label>

                        <div class="col-md-6">
                            <input id="telepon" type="number" class="form-control @error('telepon') is-invalid @enderror" name="telepon" value="@if(isset($user->pelanggan)){{ $user->pelanggan->telepon }}@endif" required>
                            @error('telepon')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profile" class="col-sm-3 col-form-label text-md-right">Foto Profile</label>

                        <div class="col-md-6">
                            <img style="max-height:300px" src="{{ asset('storage/' . $user->profile) }}" class="img-thumbnail">
                            <input type="file" name="profile" id="profile"><br>
                            @error('profile')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                    <a href="/profile" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection