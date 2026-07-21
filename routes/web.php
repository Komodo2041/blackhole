<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "App\Http\Controllers\MainController@list");

Route::match(["get", "post"], '/rotation', "App\Http\Controllers\RotationController@list");

Route::match(["get", "post"], '/falling', "App\Http\Controllers\FallingController@list");

Route::match(["get", "post"], '/schwarschild', "App\Http\Controllers\SchwarschildController@list");

Route::match(["get", "post"], '/magnus', "App\Http\Controllers\MagnusController@list");

Route::match(["get", "post"], '/donkey', "App\Http\Controllers\DonkeyController@list");

Route::match(["get", "post"], '/walecone', "App\Http\Controllers\LiterController@walecOne");
Route::match(["get", "post"], '/walectwo', "App\Http\Controllers\LiterController@walecTwo");
Route::match(["get", "post"], '/stozekcone', "App\Http\Controllers\LiterController@stozekcOne");
Route::match(["get", "post"], '/stozektwo', "App\Http\Controllers\LiterController@stozekTwo");

Route::match(["get", "post"], '/sinus', "App\Http\Controllers\SinusController@list");
