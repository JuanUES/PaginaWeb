<?php

//use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Licencias\LicenciasController;

Route::group(['middleware' => ['role:super-admin','auth']], function () {
    Route::get('Admin/LicenciaGS', [LicenciasController::class,'indexLicenciaGS'])->name('indexLicGS');
});