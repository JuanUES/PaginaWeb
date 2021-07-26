<?php

use App\Http\Controllers\Horarios\AulaController;
use Illuminate\Support\Facades\Route;

Route::get('Aulas',[AulaController::class,'index'])->name('aulas');