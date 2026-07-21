@extends('template')
@section('content')

<h3>Porgram BHA</h3>

<div class="container">
   <a href="/rotation"><button type="button" class="btn btn-primary">Rotacje</button></a>
   <a href="/falling"><button type="button" class="btn btn-primary">Obliczanie spadku swobodnego</button></a>
   <a href="/schwarschild"><button type="button" class="btn btn-primary">Promień Schwarzschilda</button></a>
   <a href="/magnus"><button type="button" class="btn btn-primary">Siła magnusa</button></a>
   <a href="/donkey"><button type="button" class="btn btn-primary">Karawana osłów</button></a>
   <a href="/walecone"><button type="button" class="btn btn-primary">1 Walec pojemność</button></a>
   <a href="/walectwo"><button type="button" class="btn btn-primary">2 Walce pojemność</button></a>
   <a href="/stozekcone"><button type="button" class="btn btn-primary">1 Stożek pojemność</button></a>
   <a href="/stozektwo"><button type="button" class="btn btn-primary">2 Stożki pojemność (Ścięty stożek)</button></a>
   <a href="/sinus"><button type="button" class="btn btn-primary">Tanges</button></a>
</div>


<div>
   <br />
   Hipoteza SLABs (Ogromniaste Czarne Dziury) [Nikodem Popławski]?
</div>

@endsection('content')