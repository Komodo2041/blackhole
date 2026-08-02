@extends('template')
@section('content')

<a href="/" class=" btn btn-primary"> Strona główna</button></a>
<h3>Zderzenie cząstek - liczenie strat energi</h3>

@if (isset($errorforms) && $errorforms != "")
<div class="alert alert-danger" role="alert">
    {{$errorforms}}
</div>
@endif

<div class="container">
    <form action="" method="Post">
        @csrf
        <div class="form-group">
            <label>Masa pierwszej cząstki (unit)</label>
            <input type="text" name="m1" class="form-control" placeholder="masa" value="{{$m1}}">
        </div>

        <div class="form-group">
            <input type="hidden" value="1" name="save" />

            <input type="submit" class="btn btn-info" value="Oblicz" />
        </div>
    </form>

    @if ($calco)
    <h4>Obliczenia Tlen</h4>
    Strata : {{$calco['res']}}<br />
    Procent : {{$calco['proc']}} %<br />
    10 zderzeń : {{$calco['c10']}}
    <h4>Obliczenia Azot</h4>
    Strata : {{$calco2['res']}}<br />
    Procent : {{$calco2['proc']}} %<br />
    10 zderzeń : {{$calco2['c10']}}
    @endif
</div>

@endsection('content')