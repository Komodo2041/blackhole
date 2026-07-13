<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "App\Http\Controllers\MainController@list");

Route::match(["get", "post"], '/rotation', "App\Http\Controllers\RotationController@list");

Route::match(["get", "post"], '/falling', "App\Http\Controllers\FallingController@list");

Route::match(["get", "post"], '/schwarschild', "App\Http\Controllers\SchwarschildController@list");

Route::match(["get", "post"], '/magnus', "App\Http\Controllers\MagnusController@list");

Route::match(["get", "post"], '/donkey', "App\Http\Controllers\DonkeyController@list");
