<?php
use Illuminate\Support\Facades\Route;

/** RUTAS DE TRANSPARENCIA **/

Route::get('transparencia', function () {
    return view('index-transparencia');
});

Route::get('admin', function () {
    return view('Admin.home');
});