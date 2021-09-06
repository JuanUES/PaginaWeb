<?php

use App\Http\Controllers\General\EmpleadoController;
use Illuminate\Support\Facades\Route;

/**Metodos Get */
Route::get('Empleado',[EmpleadoController::class, 'index'])
->name('empleado')->middleware(['auth']);

/**Metodos Post */
Route::post('Empleado/empleado', [EmpleadoController::class, 'store'])
->name('Empleado.empleado')->middleware(['auth']);