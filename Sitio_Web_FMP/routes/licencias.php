<?php

use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;

Route::get('Empleado',[EmpleadoController::class, 'index'])->name('indexEmpleado');

// ruta para guardar con ajax
Route::post('Empleado/empleado', [EmpleadoController::class, 'store'])
->name('Empleado.empleado');