@extends('template')
@section('content')

<a href="/" class=" btn btn-primary"> Strona główna</button></a>
<h3>Unit - mol - Energia kinetyczna</h3>

@if (isset($errorforms) && $errorforms != "")
<div class="alert alert-danger" role="alert">
    {{$errorforms}}
</div>
@endif

<div class="container">
    <form action="" method="Post">
        @csrf
        <div class="form-group">
            <label>Liczba unitów (u)</label>
            <input type="text" name="unit" class="form-control" placeholder="Unit" value="{{$unit}}">
        </div>
        <div class="form-group">
            <label>Prędkość (m/s)</label>
            <input type="text" name="speed" class="form-control" placeholder="Prędkość" value="{{$speed}}">
        </div>
        <div class="form-group">
            <input type="hidden" value="1" name="save" />

            <input type="submit" class="btn btn-info" value="Oblicz" />
        </div>
    </form>

    @if ($calco)
    <h4>Obliczenia</h4>
    Energia - eV : {{$calco['res']}} eV<br />
    @if ($calco['p'])
    Przekroczono barierę
    @else
    Brak przekroczenia
    @endif
    <br />
    @if ($calco['p'] == 0)
    Potrzebne unity: {{$calco['needm']}} u<br />
    Potrzebna prędkość: {{$calco['needs']}} m/s <br />
    @endif

    @endif
</div>

@endsection('content')