@extends('layouts.master', ['title' => 'Ubah Password'])

@section('content')
<div>
    <h4 class="mb-3 mb-md-2">Ubah Password </h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/profile')}}">Profil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-8 mx-auto grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/profile/ubah-password/update" class="mt-3 forms-sample ml-3">
                    @csrf
                    <div class="form-group">
                        <label for="old_password">Password Lama</label>

                        <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" placeholder="old_Password">

                        @error('old_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password Baru</label>

                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password" placeholder="Password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Password Konfirmasi</label>
                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation" autocomplete="new-password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                    <a href="/profile" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection