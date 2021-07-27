<?php

use App\Models\Jornada\Jornada;
use Illuminate\Support\Facades\Route;

/** RUTAS DE TRANSPARENCIA **/
Route::get('admin', function () {
    return view('Admin.home');
});

Route::get('admin/jornada/', 'App\Http\Controllers\JornadaController@index')->name('admin.jornada.index');
Route::get('admin/jornada/create', 'App\Http\Controllers\JornadaController@create')->name('admin.jornada.create');
Route::post('admin/jornada/store', 'App\Http\Controllers\JornadaController@store')->name('admin.jornada.store');
