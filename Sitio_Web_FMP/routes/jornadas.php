<?php

use App\Models\Jornada\Jornada;
use Illuminate\Support\Facades\Route;

//RUTAS JORNADA
Route::resource('admin/jornada', 'App\Http\Controllers\JornadaController')->names('admin.jornada');
Route::get('admin/jornada-export', 'App\Http\Controllers\JornadaController@export')->name('admin.jornada.export');
// Route::get('admin/jornada/', 'App\Http\Controllers\JornadaController@index')->name('admin.jornada.index');
// Route::get('admin/jornada/{id}', 'App\Http\Controllers\JornadaController@update')->name('admin.jornada.update');
// Route::get('admin/jornada/create', 'App\Http\Controllers\JornadaController@create')->name('admin.jornada.create');
// Route::post('admin/jornada/store', 'App\Http\Controllers\JornadaController@store')->name('admin.jornada.store');
// Route::get('admin/jornada/edit/{id}', 'App\Http\Controllers\JornadaController@edit')->name('admin.jornada.edit');
//modal
Route::get("admin/jornada/detalle/{id}", "App\Http\Controllers\JornadaController@getDetalle");
Route::get('admin/jornada/jornadaEmpleado/{id}', 'App\Http\Controllers\JornadaController@getEmpleadoJornada')->name('admin.jornada.empleado');

Route::post("admin/jornada-procedimiento", "App\Http\Controllers\JornadaController@procedimiento")->name('admin.jornada.procedimiento');

//obtener departamentos
Route::post('admin/jornada/select{id}', 'App\Http\Controllers\JornadaController@getDepto')->name('admin.jornada.select');


//RUTAS PERIODO
Route::resource('admin/periodo', 'App\Http\Controllers\PeriodoController')->only(['index','store', 'show', 'destroy'])->names('admin.periodo');
Route::get('admin/periodo/finalizar/{id}', 'App\Http\Controllers\PeriodoController@finalizar')->name('admin.periodo.finalizar');

// Route::get('admin/periodo/', 'App\Http\Controllers\PeriodoController@index')->name('admin.periodo.index');
// Route::get('admin/periodo/create', 'App\Http\Controllers\PeriodoController@create')->name('admin.periodo.create');
// Route::post('admin/periodo/store', 'App\Http\Controllers\PeriodoController@store')->name('Admin.Periodo.store');
