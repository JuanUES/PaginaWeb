<?php

use App\Models\Jornada\Jornada;
use Illuminate\Support\Facades\Route;

//RUTAS JORNADA
Route::get('admin/jornada/', 'App\Http\Controllers\JornadaController@index')->name('admin.jornada.index');
Route::get('admin/jornada/create', 'App\Http\Controllers\JornadaController@create')->name('admin.jornada.create');
Route::post('admin/jornada/store', 'App\Http\Controllers\JornadaController@store')->name('admin.jornada.store');

//RUTAS PERIODO
Route::get('admin/periodo/', 'App\Http\Controllers\PeriodoController@index')->name('admin.periodo.index');
Route::get('admin/periodo/create', 'App\Http\Controllers\PeriodoController@create')->name('admin.periodo.create');
Route::post('admin/periodo/store', 'App\Http\Controllers\PeriodoController@store')->name('admin.periodo.store');
