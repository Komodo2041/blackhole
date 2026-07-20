@extends('template')
@section('content')

<a href="/" class=" btn btn-primary"> Strona główna</button></a>
<h3>Pojedyńczy walec</h3>

@if (isset($errorforms) && $errorforms != "")
<div class="alert alert-danger" role="alert">
    {{$errorforms}}
</div>
@endif

<div class="container">
    <form action="" method="Post">
        @csrf
        <div class="form-group">
            <label>Promień (mm)</label>
            <input type="text" name="radius" class="form-control" placeholder="Promień" value="{{$radius}}">
        </div>
        <div class="form-group">
            <label>Wyskość (mm)</label>
            <input type="text" name="height" class="form-control" placeholder="Wysokość" value="{{$height}}">
        </div>
        <div class="form-group">
            <input type="hidden" value="1" name="save" />

            <input type="submit" class="btn btn-info" value="Oblicz" />
        </div>
    </form>

    @if ($calco)
    <h4>Obliczenia</h4>
    Objetość : {{$calco['v']}} Liter<br />

    @endif
</div>

@endsection('content')