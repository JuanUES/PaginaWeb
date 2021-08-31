<?php

use App\Models\Tipo_Contrato;
use App\Models\Tipo_Jornada;
use Illuminate\Support\Facades\Route;

//RUTAS TIPO CONTRATO
Route::resource('admin/tcontrato', 'App\Http\Controllers\Tipo_ContratoController')->only(['index', 'store','show'])->names('admin.tcontrato');

//Route::get('admin/tcontrato/', 'App\Http\Controllers\Tipo_ContratoController@index')->name('admin.tcontrato.index');
//Route::get('admin/tcontrato/create', 'App\Http\Controllers\Tipo_ContratoController@create')->name('admin.tcontrato.create');
//Route::post('admin/tcontrato/store', 'App\Http\Controllers\Tipo_ContratoController@store')->name('admin.tcontrato.store');

//RUTAS TIPO JORNADA
Route::resource('admin/tjornada', 'App\Http\Controllers\Tipo_JornadaController')->only(['index', 'store','show'])->names('admin.tjornada');

//Route::get('admin/tjornada/', 'App\Http\Controllers\Tipo_JornadaController@index')->name('admin.tjornada.index');
//Route::get('admin/tjornada/create', 'App\Http\Controllers\Tipo_JornadaController@create')->name('admin.tjornada.create');
//Route::post('admin/tjornada/store', 'App\Http\Controllers\Tipo_JornadaController@store')->name('admin.tjornada.store');
