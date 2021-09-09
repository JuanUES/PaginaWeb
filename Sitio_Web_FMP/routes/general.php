<?php

use App\Http\Controllers\General\EmpleadoController;
use Illuminate\Support\Facades\Route;

/**Metodos Get */
Route::get('admin/Empleado',[EmpleadoController::class, 'index'])
->name('empleado')->middleware(['auth']);

Route::get('admin/Empleado/Categoria',[EmpleadoController::class, 'categoriaGet'])
->name('empleadoCat')->middleware(['auth']);

/**Metodos Post */
Route::post('admin/Empleado/empleado', [EmpleadoController::class, 'store'])
->name('Empleado.empleado')->middleware(['auth']);

Route::post('admin/Empleado/Categoria/Registrar',[EmpleadoController::class, 'categoriaStore'])
->name('empleadoCatReg')->middleware(['auth']);

Route::post('admin/Empleado/Categoria/Borrar',[EmpleadoController::class, 'categoriaDestroy'])
->name('empleadoCatDest')->middleware(['auth']);
