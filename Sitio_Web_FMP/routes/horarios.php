<?php

use App\Http\Controllers\Horarios\AulaController;
use App\Http\Controllers\Horarios\DepartamentoController;
use Illuminate\Support\Facades\Route;

Route::get('Aulas',[AulaController::class,'index'])->name('aulas');
Route::get('Departamentos',[DepartamentoController::class,'index'])->name('depto');