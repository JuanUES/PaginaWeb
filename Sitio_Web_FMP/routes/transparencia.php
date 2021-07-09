<?php

use App\Models\Transparencia;
use Illuminate\Support\Facades\Route;

/** RUTAS DE TRANSPARENCIA **/

Route::get('transparencia', function () {
    return view('index-transparencia');
});

Route::get('admin', function () {
    return view('Admin.home');
});

//RUTAS PARA LA ADMINISTRACION DE LA PAGINA DE TRANSPARENCIA
// Route::get('admin/marco-normativo', 'App\Http\Controllers\TransparenciaController@index')->name('marco-normativo');
// Route::get('admin/marco-gestion', 'App\Http\Controllers\TransparenciaController@index')->name('marco-gestion');
// Route::get('admin/marco-presupuestario', 'App\Http\Controllers\TransparenciaController@index')->name('marco-presupuestario');
// Route::get('admin/estadisticas', 'App\Http\Controllers\TransparenciaController@index')->name('estadisticas');
// Route::get('admin/documentos-JD', 'App\Http\Controllers\TransparenciaController@index')->name('documentos-JD');

//RUTAS PARA EL CRUD TRANSPARENCIA
// Route::resource('admin/transparencia', 'App\Http\Controllers\TransparenciaController')->names('admin.transparencia');
Route::get('/admin/transparencia/{categoria}', 'App\Http\Controllers\TransparenciaController@index')->name('admin.transparencia.index');
// Route::get('/admin/create/{categoria}', 'App\Http\Controllers\TransparenciaController@create');
// Route::post('/admin/transparencia/store', 'App\Http\Controllers\TransparenciaController@store');
// Route::get('/admin/transparencia/edit/{id}', 'App\Http\Controllers\TransparenciaController@edit');
// Route::patch('/admin/transparencia/{id}', 'App\Http\Controllers\TransparenciaController@update');

//RUTAS WEB
Route::get('/transparencia/{categoria}', 'App\Http\Controllers\TransparenciaWebController@web');
Route::get('/transparencia/{categoria}/{id}', 'App\Http\Controllers\TransparenciaWebController@documento');
Route::get('/transparencia/resultado/a/b', 'App\Http\Controllers\TransparenciaWebController@busqueda');

//RUTAS DESCARGA ARCHIVOS
Route::get('/transparencia/download/a/b/{id}', 'App\Http\Controllers\TransparenciaWebController@dowload_Storage')->name('downloadFile');
