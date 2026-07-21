@extends('template')
@section('content')

<a href="/" class=" btn btn-primary"> Strona główna</button></a>
<h3>Rotacje</h3>

@if (isset($errorforms) && $errorforms != "")
<div class="alert alert-danger" role="alert">
    {{$errorforms}}
</div>
@endif

<div class="container">
    <form action="" method="Post">
        @csrf
        <div class="form-group">
            <label>Kąt </label>
            <input type="text" name="angle" class="form-control" placeholder="Kąt" value="{{$angle}}">
        </div>
        <div class="form-group">
            <label>Długość ramienia (cm) </label>
            <input type="text" name="length" class="form-control" placeholder="Długość ramienia" value="{{$length}}">
        </div>
        <div class="form-group">
            <input type="hidden" value="1" name="save" />

            <input type="submit" class="btn btn-info" value="Oblicz" />
        </div>
    </form>

    @if ($calco)
    <h4>Obliczenia</h4>
    Wysokość : {{$calco['h']}} cm<br />

    @endif
</div>

@endsection('content')