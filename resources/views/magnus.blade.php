@extends('template')
@section('content')

<a href="/" class=" btn btn-primary"> Strona główna</button></a>
<h3>Siła Magnusa</h3>

@if (isset($errorforms) && $errorforms != "")
<div class="alert alert-danger" role="alert">
    {{$errorforms}}
</div>
@endif

<div class="container">
    <form action="" method="Post">
        @csrf
        <div class="form-group">
            <label>Gęstość (kg / m3)</label>
            <input type="text" name="destinity" class="form-control" placeholder="Obroty" value="{{$destinity}}">
        </div>
        <div class="form-group">
            <label>Prędkość płynu (m/s)</label>
            <input type="text" name="v" class="form-control" placeholder="Prędkość płynu" value="{{$v}}">
        </div>
        <div class="form-group">
            <label>Liczba obrotów (min)</label>
            <input type="text" name="rotation" class="form-control" placeholder="Obroty" value="{{$rotation}}">
        </div>
        <div class="form-group">
            <label> Promień (cm)</label>
            <input type="text" name="length" class="form-control" placeholder="Długość ramienia" value="{{$length}}">
        </div>
        <div class="form-group">
            <label> Długość ramienia (cm)</label>
            <input type="text" name="L" class="form-control" placeholder="Długość ramienia" value="{{$L}}">
        </div>
        <div class="form-group">
            <input type="hidden" value="1" name="save" />

            <input type="submit" class="btn btn-info" value="Oblicz" />
        </div>
    </form>

    @if ($calco)
    <h4>Obliczenia</h4>

    Siła Magnusa : {{$calco['m']}} N
    @endif
</div>

@endsection('content')