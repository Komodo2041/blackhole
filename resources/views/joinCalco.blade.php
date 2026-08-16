@extends('template')
@section('content')

<a href="/" class=" btn btn-primary"> Strona główna</button></a>
<h3>Unit - Łączenie wiele obliczeń</h3>

@if (isset($errorforms) && $errorforms != "")
<div class="alert alert-danger" role="alert">
    {{$errorforms}}
</div>
@endif

<div class="container">
    <form action="" method="Post">
        @csrf
        <div class="form-group">
            <label>Liczba unitów 1 (u)</label>
            <input type="text" name="unit1" class="form-control" placeholder="Unit 1" value="{{$unit1}}">
        </div>
        <div class="form-group">
            <label>Liczba unitów 2 (u)</label>
            <input type="text" name="unit2" class="form-control" placeholder="Unit 2" value="{{$unit2}}">
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
    Energia 1 - eV : {{$calco['en1']}} eV<br />
    Energia 2 - eV : {{$calco['en2']}} eV<br /><br />

    ZW1 Strata O2 : {{$calco['proc1_o']}} %<br />
    ZW1 Strata N2 : {{$calco['proc1_n']}} %<br />
    ZW1 Strata He : {{$calco['proc1_h']}} %<br />
    ZW1 Strata Wodór : {{$calco['proc1_w']}} %<br />

    ZW2 Strata O2 : {{$calco['proc2_o']}} %<br />
    ZW2 Strata N2 : {{$calco['proc2_n']}} %<br />
    ZW2 Strata He : {{$calco['proc2_h']}} %<br />
    ZW2 Strata Wodór : {{$calco['proc2_w']}} %<br />
    <br />

    <table class="table">
        <tr>
            <th></th>
            <th>Związek 1</th>
            <th>Związek 2</th>
            <th>Diff</th>
        </tr>
        <tr>
            <td>O2</td>
            <td>{{$calco['z1_o']}}</td>
            <td>{{$calco['z2_o']}}</td>
            <td> @if ($calco['z2_o'] != "NONE" && $calco['z1_o'] != "NONE") {{$calco['z2_o'] / $calco['z1_o']  }} @endif</td>
        </tr>
        <tr>
            <td>N2</td>
            <td>{{$calco['z1_n']}}</td>
            <td>{{$calco['z2_n']}}</td>
            <td>@if ($calco['z2_n'] != "NONE" && $calco['z1_n'] != "NONE") {{$calco['z2_n'] / $calco['z1_n']  }} @endif</td>
        </tr>
        <tr>
            <td>He</td>
            <td>{{$calco['z1_h']}}</td>
            <td>{{$calco['z2_h']}}</td>
            <td>@if ($calco['z2_h'] != "NONE" && $calco['z1_h'] != "NONE") {{$calco['z2_h'] / $calco['z1_h']  }} @endif</td>
        </tr>
        <tr>
            <td>Wodór</td>
            <td>{{$calco['z1_w']}}</td>
            <td>{{$calco['z2_w']}}</td>
            <td>@if ($calco['z2_w'] != "NONE" && $calco['z1_w'] != "NONE") {{$calco['z2_w'] / $calco['z1_w']  }} @endif</td>
        </tr>

    </table>
    @endif
</div>

@endsection('content')