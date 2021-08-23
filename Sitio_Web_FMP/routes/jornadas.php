<?php

use App\Models\Jornada\Jornada;
use Illuminate\Support\Facades\Route;

//RUTAS JORNADA
Route::resource('admin/jornada', 'App\Http\Controllers\JornadaController')->names('admin.jornada');
// Route::get('admin/jornada/', 'App\Http\Controllers\JornadaController@index')->name('admin.jornada.index');
// Route::get('admin/jornada/{id}', 'App\Http\Controllers\JornadaController@update')->name('admin.jornada.update');
// Route::get('admin/jornada/create', 'App\Http\Controllers\JornadaController@create')->name('admin.jornada.create');
// Route::post('admin/jornada/store', 'App\Http\Controllers\JornadaController@store')->name('admin.jornada.store');
// Route::get('admin/jornada/edit/{id}', 'App\Http\Controllers\JornadaController@edit')->name('admin.jornada.edit');
//modal
Route::get("admin/jornada/detalle/{id}", "App\Http\Controllers\JornadaController@getDetalle");
//obtener departamentos
Route::post('admin/jornada/select{id}", "App\Http\Controllers\JornadaController@getDepto')->name('admin.jornada.select');


//RUTAS PERIODO
Route::get('admin/periodo/', 'App\Http\Controllers\PeriodoController@index')->name('admin.periodo.index');
Route::get('admin/periodo/create', 'App\Http\Controllers\PeriodoController@create')->name('admin.periodo.create');
Route::post('admin/periodo/store', 'App\Http\Controllers\PeriodoController@store')->name('Admin.Periodo.store');
