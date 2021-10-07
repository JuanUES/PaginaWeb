<?php

//use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Licencias\LicenciasController;

Route::group(['middleware' => ['auth']], function () {

    /*METODOS GET**/
    Route::get('Admin/LicenciaGS', [LicenciasController::class,'indexLicenciaGS'])->name('indexLicGS');
    Route::get('Admin/MisLicencias', [LicenciasController::class,'indexMisLicencias'])->name('indexLic');
    /*END GET**/


    /*METODOS POST**/
    
    /*END POST**/

});