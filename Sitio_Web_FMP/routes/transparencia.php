<?php

use App\Models\Transparencia;
use Illuminate\Support\Facades\Route;

/** RUTAS DE TRANSPARENCIA **/





Route::group(['middleware' => ['role:Transparencia']], function () {
    //rutas accesibles solo para el encargado de transparencia
    //RUTAS PARA EL CRUD TRANSPARENCIA
    Route::get('admin/transparencia/{categoria}', 'App\Http\Controllers\TransparenciaController@index')->name('admin.transparencia.index');
    Route::get('admin/transparencia/{categoria}/create', 'App\Http\Controllers\TransparenciaController@create')->name('admin.transparencia.create');
    Route::post('admin/transparencia/store', 'App\Http\Controllers\TransparenciaController@store')->name('admin.transparencia.store');
    Route::get('admin/transparencia/{categoria}/edit/{id}', 'App\Http\Controllers\TransparenciaController@edit')->name('admin.transparencia.edit');
    Route::patch('admin/transparencia/{id}', 'App\Http\Controllers\TransparenciaController@update')->name('admin.transparencia.update');
    Route::post('admin/transparencia-publicar/{id}', 'App\Http\Controllers\TransparenciaController@publicar')->name('admin.transparencia.publicar');
    Route::get('admin/transparencia-file/{id}', 'App\Http\Controllers\TransparenciaController@file')->name('admin.transparencia.file');

});
//RUTAS PARA LA ADMINISTRACION DE LA PAGINA DE TRANSPARENCIA
// Route::get('admin/marco-normativo', 'App\Http\Controllers\TransparenciaController@index')->name('marco-normativo');
// Route::get('admin/marco-gestion', 'App\Http\Controllers\TransparenciaController@index')->name('marco-gestion');
// Route::get('admin/marco-presupuestario', 'App\Http\Controllers\TransparenciaController@index')->name('marco-presupuestario');
// Route::get('admin/estadisticas', 'App\Http\Controllers\TransparenciaController@index')->name('estadisticas');
// Route::get('admin/documentos-JD', 'App\Http\Controllers\TransparenciaController@index')->name('documentos-JD');



Route::get( 'transparencia', 'App\Http\Controllers\TransparenciaWebController@index');
Route::get('transparencia/{categoria}', 'App\Http\Controllers\TransparenciaWebController@web')->name('transparencia');
Route::get('transparencia/{categoria}/{id}', 'App\Http\Controllers\TransparenciaWebController@documento');
Route::get('transparencia-busqueda', 'App\Http\Controllers\TransparenciaWebController@busqueda')->name( 'transparencia.busqueda');
Route::get('transparencia-datatable/{categoria}', 'App\Http\Controllers\TransparenciaWebController@datatable')->name('transparencia.datatable');
//RUTAS DESCARGA ARCHIVOS
Route::get('/transparencia-download/{id}', 'App\Http\Controllers\TransparenciaWebController@download')->name('transparencia.download');
