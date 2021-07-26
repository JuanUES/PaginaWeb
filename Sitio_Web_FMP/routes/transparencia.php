<?php

use App\Models\Transparencia;
use Illuminate\Support\Facades\Route;

/** RUTAS DE TRANSPARENCIA **/





// Route::group(['middleware' => ['role:super-admin', 'role:Transparencia-Presupuestario', 'role:Transparencia-Decano', 'role:Transparencia-Secretario']], function () {
    //rutas accesibles solo para el encargado de transparencia
    Route::get('admin/transparencia/{categoria}', 'App\Http\Controllers\TransparenciaController@index')->name('admin.transparencia.index');
    Route::get('admin/transparencia/{categoria}/create', 'App\Http\Controllers\TransparenciaController@create')->name('admin.transparencia.create');
    Route::get('admin/transparencia/{categoria}/edit/{id}', 'App\Http\Controllers\TransparenciaController@edit')->name('admin.transparencia.edit');
    
    Route::post('admin/transparencia/{categoria}/store', 'App\Http\Controllers\TransparenciaController@store')->name('admin.transparencia.store');
    Route::patch('admin/transparencia/{categoria}/{id}', 'App\Http\Controllers\TransparenciaController@update')->name('admin.transparencia.update');
    Route::post('admin/transparencia/{categoria}/publicar/{id}', 'App\Http\Controllers\TransparenciaController@publicar')->name('admin.transparencia.publicar');
    Route::get('admin/transparencia/{categoria}/file/{id}', 'App\Http\Controllers\TransparenciaController@file')->name('admin.transparencia.file');
// });

Route::get( 'transparencia', 'App\Http\Controllers\TransparenciaWebController@index');
Route::get('transparencia/{categoria}', 'App\Http\Controllers\TransparenciaWebController@categoria')->name('transparencia.categoria');
Route::get('transparencia/{categoria}/{subcategoria}', 'App\Http\Controllers\TransparenciaWebController@subcategoria')->name('transparencia.subcategoria');
Route::get('transparencia/{categoria}/{id}', 'App\Http\Controllers\TransparenciaWebController@documento');
Route::get('transparencia-busqueda', 'App\Http\Controllers\TransparenciaWebController@busqueda')->name( 'transparencia.busqueda');
Route::get('transparencia-datatable/{categoria}', 'App\Http\Controllers\TransparenciaWebController@datatable')->name('transparencia.datatable');
//RUTAS DESCARGA ARCHIVOS
Route::get('/transparencia-download/{id}', 'App\Http\Controllers\TransparenciaWebController@download')->name('transparencia.download');
