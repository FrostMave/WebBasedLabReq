@extends('layouts.master', ['title' => 'Umpan Balik'])
@section('content')
<div>
    <h4 class="mb-3 mb-md-2">Umpan Balik </h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Umpan Balik</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            Total Feedback
            {{ $total }}
                <br>
                <table class="table table-borderless">
                    
                @foreach($tanya as $t)
                <tr>
                        <td colspan="3" scope="row"><h5 class="mt-2"><b>
                            {{$t->pertanyaan}}
                        </b></h5>
                        </td>
                </tr>
                <tr>
                            <td> 
                                Baik {{ countFeedback($t->id)->baik }}
                            </td>
                            <td>
                                Sedang {{ countFeedback($t->id)->sedang }}
                            </td>
                            <td>
                                Kurang {{ countFeedback($t->id)->kurang }}
                            </td>
                            <td style="width:50px">
                                <a href="/admin/umpan-balik/{{$t->id}}" class="text-link">Lihat Keterangan</a>
                            </td>
                        
                </tr>
                    
                  
                @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection