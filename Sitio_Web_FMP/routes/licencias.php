<?php

use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;

Route::get('Empleado',[EmpleadoController::class, 'index'])->name('indexEmpleado');