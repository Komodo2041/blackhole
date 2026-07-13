@extends('template')
@section('content')

<a href="/" class=" btn btn-primary"> Strona główna</button></a>
<h3>Kalkulator osłów</h3>

@if (isset($errorforms) && $errorforms != "")
<div class="alert alert-danger" role="alert">
    {{$errorforms}}
</div>
@endif

<div class="container">
    <form action="" method="Post">
        @csrf
        <div class="form-group">
            <label>Trasa (km)</label>
            <input type="text" name="length" class="form-control" placeholder="Trasa" value="{{$length}}">
        </div>
        <div class="form-group">
            <label>Waga (kg)</label>
            <input type="text" name="waga" class="form-control" placeholder="Długość ramienia" value="{{$waga}}">
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="zao" value="1" @if ($zao) checked @endif>
                Zaopatrzenie w drodze
            </label>

        </div>
        <div class="form-group">
            <input type="hidden" value="1" name="save" />

            <input type="submit" class="btn btn-info" value="Oblicz" />
        </div>

    </form>

    @if ($calco)
    <h4>Obliczenia</h4>
    @if ($calco['p'])

    Dni : {{$calco['d']}} <br />
    Osły : {{$calco['o']}}
    @else
    <p>Za długa trasa bez prowiantu</p>
    @endif
    @endif
</div>

@endsection('content')