<?php

use App\Http\Controllers\General\EmpleadoController;
use Illuminate\Support\Facades\Route;

/**Metodos Get */
Route::get('Empleado',[EmpleadoController::class, 'index'])
->name('empleado')->middleware(['auth']);

Route::get('Empleado/Categoria',[EmpleadoController::class, 'cagetoriaGet'])
->name('empleadoCat')->middleware(['auth']);

/**Metodos Post */
Route::post('Empleado/empleado', [EmpleadoController::class, 'store'])
->name('Empleado.empleado')->middleware(['auth']);

Route::post('Empleado/Categoria/Registrar',[EmpleadoController::class, 'categoriaStore'])
->name('empleadoCatReg')->middleware(['auth']);
