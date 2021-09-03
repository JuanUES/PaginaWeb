<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesUsuarios\RolesUsuariosController;
use App\Http\Controllers\RolesUsuarios\UsuariosController;

/**Rutas get */
Route::get('admin/Usuarios',[UsuariosController::class,'index'])->name('usuarios');
Route::get('admin/Usuarios/Usuario/{usuario}',[UsuariosController::class,'usuario']);

/**Rutas Post */
Route::post('admin/Usuarios/Guardar', [UsuariosController::class,'store'])
->middleware('auth')->name('guardarUser');