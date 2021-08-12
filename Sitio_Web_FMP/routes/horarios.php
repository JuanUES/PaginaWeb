<?php

use App\Http\Controllers\Horarios\AsignacionCargaController;
use App\Http\Controllers\Horarios\AulaController;
use App\Http\Controllers\Horarios\CargaController;
use App\Http\Controllers\Horarios\CarrerasController;
use App\Http\Controllers\Horarios\DepartamentoController;
use App\Http\Controllers\Horarios\HoraController;
use App\Http\Controllers\Horarios\HorarioController;
use App\Http\Controllers\Horarios\MateriaController;
use Illuminate\Support\Facades\Route;

Route::get('Aulas',[AulaController::class,'index'])->name('aulas');
//para departamentos
Route::get('Departamentos',[DepartamentoController::class,'index'])->name('depto');
Route::post('Departamentos/create',[DepartamentoController::class,'store'])->name('depto.store');
Route::post('Departamentos/estado', [DepartamentoController::class,'estado'])->name('estadoDept');
Route::post('Departamentos/estadoActivar', [DepartamentoController::class,'activarDepto'])->name('estadoADept');
//fin de departamentos
//para carreras
Route::get('Carreras',[CarrerasController::class,'index'])->name('carreras');
//fin de para carreras

Route::get('Materias',[MateriaController::class,'index'])->name('materias');
Route::get('Horarios',[HorarioController::class,'index'])->name('horarios');
Route::get('Create/Carga',[CargaController::class,'index'])->name('crear-carga');
Route::get('Asigar/Carga',[AsignacionCargaController::class,'index'])->name('asignar-carga');
Route::get('Horas',[HoraController::class,'index'])->name('horas');