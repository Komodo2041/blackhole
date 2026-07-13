@extends('template')
@section('content')

<h3>Porgram BHA</h3>

<div class="container">
   <a href="/rotation"><button type="button" class="btn btn-primary">Rotacje</button></a>
   <a href="/falling"><button type="button" class="btn btn-primary">Obliczanie spadku swobodnego</button></a>
   <a href="/schwarschild"><button type="button" class="btn btn-primary">Promień Schwarzschilda</button></a>
   <a href="/magnus"><button type="button" class="btn btn-primary">Siła magnusa</button></a>
   <a href="/donkey"><button type="button" class="btn btn-primary">Karawana osłów</button></a>
</div>


<div>
   <br />
   Hipoteza SLABs (Ogromniaste Czarne Dziury) [Nikodem Popławski]?
</div>

@endsection('content')