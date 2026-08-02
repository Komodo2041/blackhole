@extends('template')
@section('content')

<a href="/" class=" btn btn-primary"> Strona główna</button></a>
<h3>Liczba Zderzeń - maks</h3>

@if (isset($errorforms) && $errorforms != "")
<div class="alert alert-danger" role="alert">
    {{$errorforms}}
</div>
@endif

<div class="container">
    <form action="" method="Post">
        @csrf
        <div class="form-group">
            <label>Energia (eV)</label>
            <input type="text" name="energia" class="form-control" placeholder="Energia" value="{{$energia}}">
        </div>
        <div class="form-group">
            <label>Procent(%) (Ułamek) [0.92]</label>
            <input type="text" name="procent" class="form-control" placeholder="Procent" value="{{$procent}}">
        </div>
        <div class="form-group">
            <input type="hidden" value="1" name="save" />

            <input type="submit" class="btn btn-info" value="Oblicz" />
        </div>
    </form>

    @if ($calco)
    <h4>Obliczenia</h4>
    Liczba zderzeń : {{$calco['lz']}} <br />

    @endif
</div>

@endsection('content')