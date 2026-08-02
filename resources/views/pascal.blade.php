@extends('template')
@section('content')

<a href="/" class=" btn btn-primary"> Strona główna</button></a>
<h3>Droga swobodna</h3>

<p>
    (1 atm): Wynosi dokładnie 101 325 Pa
</p>

@if (isset($errorforms) && $errorforms != "")
<div class="alert alert-danger" role="alert">
    {{$errorforms}}
</div>
@endif

<div class="container">
    <form action="" method="Post">
        @csrf
        <div class="form-group">
            <label>Ciśnienie (Pa)</label>
            <input type="text" name="pa" class="form-control" placeholder="Ciśnienie" value="{{$pa}}">
        </div>

        <div class="form-group">
            <input type="hidden" value="1" name="save" />

            <input type="submit" class="btn btn-info" value="Oblicz" />
        </div>
    </form>

    @if ($calco)
    <h4>Obliczenia</h4>
    Długość (Metry): {{$calco['dist']}} m<br />
    Długość (Milimetry): {{$calco['dist2']}} (mm)<br />
    @endif
</div>

@endsection('content')