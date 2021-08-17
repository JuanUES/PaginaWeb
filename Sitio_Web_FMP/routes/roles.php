<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesUsuarios\RolesUsuariosController;

Route::get('admin/RolesUsuarios',[RolesUsuariosController::class,'index'])->name('rolusu');
