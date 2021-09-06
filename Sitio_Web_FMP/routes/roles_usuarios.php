<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesUsuarios\UsuariosController;

//Route::group(['middleware' => ['role:super-admin']], function () {
    
    /**Rutas get */
    Route::get('admin/Usuarios',[UsuariosController::class,'index'])->name('usuarios')->middleware(['auth']);
    Route::get('admin/Usuarios/Usuario/{usuario}',[UsuariosController::class,'usuario'])->middleware(['auth']);
    Route::get('admin/Usuarios/UsuarioRol/{usuario}',[UsuariosController::class,'usuarioRol'])->middleware(['auth']);

    /**Rutas Post */
    Route::post('admin/usuarios/guardar', [UsuariosController::class,'store'])
        ->middleware('auth')->name('guardarUser');
    Route::post('admin/usuarios/estado', [UsuariosController::class,'estado'])
        ->middleware('auth')->name('usuarioEstado');
//});