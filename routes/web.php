<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "App\Http\Controllers\MainController@list");

Route::match(["get", "post"], '/rotation', "App\Http\Controllers\RotationController@list");

Route::match(["get", "post"], '/falling', "App\Http\Controllers\FallingController@list");
