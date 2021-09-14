<?php

use App\Models\Jornada\Jornada;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth','role:super-admin|Docente|Jefe-Departamento|Jefe-Academico']], function () {
    //RUTAS JORNADA
    Route::resource('admin/jornada', 'App\Http\Controllers\JornadaController')->names('admin.jornada');
    Route::post('admin/jornada-export', 'App\Http\Controllers\JornadaController@export')->name('admin.jornada.export');

    //modal
    Route::get("admin/jornada/detalle/{id}", "App\Http\Controllers\JornadaController@getDetalle");
    Route::get('admin/jornada/jornadaEmpleado/{id}', 'App\Http\Controllers\JornadaController@getEmpleadoJornada')->name('admin.jornada.empleado');
    Route::get('admin/jornada/periodoEmpleados/{id}', 'App\Http\Controllers\JornadaController@getEmpleadoPeriodo')->name('admin.jornada.periodo.empleados');

    Route::post("admin/jornada-procedimiento", "App\Http\Controllers\JornadaController@procedimiento")->name('admin.jornada.procedimiento');
    Route::post("admin/jornada-check-dia", "App\Http\Controllers\JornadaController@checkDia")->name('admin.jornada.check-dia');

    //obtener departamentos
    Route::post('admin/jornada/select{id}', 'App\Http\Controllers\JornadaController@getDepto')->name('admin.jornada.select');


    //RUTAS PERIODO
    Route::resource('admin/periodo', 'App\Http\Controllers\PeriodoController')->only(['index', 'store', 'show', 'destroy'])->names('admin.periodo');
    Route::get('admin/periodo/finalizar/{id}', 'App\Http\Controllers\PeriodoController@finalizar')->name('admin.periodo.finalizar');


});
