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
Route::post('Carreras/create',[CarrerasController::class,'create'])->name('carreras.create');
Route::post('Carreras/estado', [CarrerasController::class,'estado'])->name('estadoCarrera');
Route::post('Carreras/estadoActivar', [CarrerasController::class,'activarCarrera'])->name('estadoACarre');
//fin de para carreras
//para materias
Route::get('Materias',[MateriaController::class,'index'])->name('materias');
Route::post('Materias/create',[MateriaController::class,'administrar'])->name('materias/create');
Route::post('Materia/estado', [MateriaController::class,'estado'])->name('estadoMateria');
Route::post('Materia/estadoActivar', [MateriaController::class,'activarMateria'])->name('estadoActi');
//fin de para materia
Route::get('Horarios',[HorarioController::class,'index'])->name('horarios');
Route::get('Create/Carga',[CargaController::class,'index'])->name('crear-carga');
Route::get('Asigar/Carga',[AsignacionCargaController::class,'index'])->name('asignar-carga');
Route::get('Horas',[HoraController::class,'index'])->name('horas');