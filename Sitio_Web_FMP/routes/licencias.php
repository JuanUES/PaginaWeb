<?php
use Illuminate\Support\Facades\Route;

Route::get('empleado', function () {
    return view('Admin.empleados.empleado');
});