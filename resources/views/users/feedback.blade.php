@extends('layouts.master', ['title' => 'Umpan Balik'])

@section('content')

<div>
    <h4 class="mb-3 mb-md-2">Umpan Balik</h4>
</div>
<div class="container">
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <form method="POST" action="/umpan-balik/{{$sample->id}}/save" class="mt-3 forms-sample ml-3">
                    @csrf

                    @foreach($pertanyaan as $tanya)
                    <div class="col-md-10">
                        <b> {{$tanya->id . " . " . $tanya->pertanyaan}} </b><br>
                        @foreach($jawaban as $jawab)
                        <div class="form-check-inline mt-2">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="jawab{{$tanya->id}}" value="{{$jawab->id}}"> {{$jawab->jawaban}}
                            </label>
                        </div>
                        @endforeach
                        @error('jawab' . $tanya->id)
                        <br>
                        <span class="text-danger text-sm" role="alert">
                            <strong> This field is required. </strong>
                        </span>
                        @enderror
                        <input type="text" class="form-control form-control mb-5 mt-2" name="keterangan{{$tanya->id}}" placeholder="Keterangan...">
                    </div>
                    @endforeach
                    <div class="form-group">
                        <label for="saran">Saran - saran</label>
                        <textarea class="form-control" id="saran" name="saran" rows="3"></textarea>
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
</div>
@endsection