<?php

//use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Licencias\LicenciaController;

Route::group(['middleware' => ['role:super-admin','auth']], function () {
    Route::get('Admin/LicenciaGS', [LicenciaController::class,'indexLicenciaGS'])->name('indexLicGS');
});