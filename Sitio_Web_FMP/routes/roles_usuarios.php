<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesUsuarios\RolesUsuariosController;
use App\Http\Controllers\RolesUsuarios\UsuariosController;

/**Rutas get */
Route::get('admin/Usuarios',[RolesUsuariosController::class,'index'])->name('rolusu');

/**Rutas Post */
Route::post('admin/Usuarios', [UsuariosController::class,'store'])->middleware('auth');