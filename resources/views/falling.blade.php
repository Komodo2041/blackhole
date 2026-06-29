@extends('template')
@section('content')

<a href="/" class=" btn btn-primary"> Strona główna</button></a>
<h3>Spadek swobodny</h3>

@if (isset($errorforms) && $errorforms != "")
<div class="alert alert-danger" role="alert">
    {{$errorforms}}
</div>
@endif

<div class="container">
    <form action="" method="Post">
        @csrf
        <div class="form-group">
            <label>Wysokość w metrach</label>
            <input type="text" name="h_m" class="form-control" placeholder="Metry" value="{{$h_m}}">
        </div>
        <div class="form-group">
            <label>Wysokość w kilometrach</label>
            <input type="text" name="h_km" class="form-control" placeholder="Kilometry" value="{{$h_km}}">
        </div>
        <div class="form-group">
            <input type="hidden" value="1" name="save" />

            <input type="submit" class="btn btn-info" value="Oblicz" />
        </div>
    </form>

    @if ($calco)
    <h4>Obliczenia</h4>
    Wysokość : {{$calco['h']}} m<br />
    Prędkość : {{$calco['v']}} m/s<br />
    Czas : <b>{{$calco['t']}} (s)</b>
    @endif
</div>

@endsection('content')