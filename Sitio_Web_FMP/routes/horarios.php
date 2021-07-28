<?php

use App\Http\Controllers\Horarios\AulaController;
use App\Http\Controllers\Horarios\DepartamentoController;
use App\Http\Controllers\Horarios\HorarioController;
use App\Http\Controllers\Horarios\MateriaController;
use Illuminate\Support\Facades\Route;

Route::get('Aulas',[AulaController::class,'index'])->name('aulas');
Route::get('Departamentos',[DepartamentoController::class,'index'])->name('depto');
Route::get('Materias',[MateriaController::class,'index'])->name('materias');
Route::get('Horarios',[HorarioController::class,'index'])->name('horarios');