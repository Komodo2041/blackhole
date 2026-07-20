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
        <h4>Pierwszy walec</h4>
        <div class="form-group">
            <label>Promień (mm)</label>
            <input type="text" name="radius1" class="form-control" placeholder="Promień" value="{{$radius1}}">
        </div>
        <div class="form-group">
            <label>Wyskość (mm)</label>
            <input type="text" name="height1" class="form-control" placeholder="Wysokość" value="{{$height1}}">
        </div>
        <h4>Drugi walec</h4>
        <div class="form-group">
            <label>Promień (mm)</label>
            <input type="text" name="radius2" class="form-control" placeholder="Promień" value="{{$radius2}}">
        </div>
        <div class="form-group">
            <label>Wyskość (mm)</label>
            <input type="text" name="height2" class="form-control" placeholder="Wysokość" value="{{$height2}}">
        </div>

        <div class="form-group">
            <input type="hidden" value="1" name="save" />

            <input type="submit" class="btn btn-info" value="Oblicz" />
        </div>
    </form>

    @if ($calco)
    <h4>Obliczenia</h4>
    1 walec : {{$calco['v1']}} Litr<br />
    2 walec : {{$calco['v2']}} Litr<br />
    @endif
</div>

@endsection('content')