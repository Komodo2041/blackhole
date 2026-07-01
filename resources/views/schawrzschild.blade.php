@extends('template')
@section('content')

<a href="/" class=" btn btn-primary"> Strona główna</button></a>
<h3>Promień Swartchilda</h3>

@if (isset($errorforms) && $errorforms != "")
<div class="alert alert-danger" role="alert">
    {{$errorforms}}
</div>
@endif

<div class="container">
    <form action="" method="Post">
        @csrf

        <div class="form-group">
            <label>Promień (m)</label>
            <input type="text" name="length" class="form-control" placeholder="Długość ramienia" value="{{$length}}">
        </div>
        <div class="form-group">
            <input type="hidden" value="1" name="save" />

            <input type="submit" class="btn btn-info" value="Oblicz" />
        </div>
    </form>

    @if ($calco)
    <h4>Obliczenia</h4>
    Masa : {{$calco['m']}} kg<br />
    Gęstość : {{$calco['density']}} kg / m3 <br />
    @endif
</div>

@endsection('content')