<?php

//use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Licencias\LicenciasController;
use App\Http\Controllers\Licencias\LicenciasGosesController;

Route::group(['middleware' => ['auth']], function () {

    /*METODOS GET**/
    Route::get('Admin/LicenciaGS', [LicenciasGosesController::class,'index'])->name('indexLicGS');
    Route::get('Admin/MisLicencias', [LicenciasController::class,'indexMisLicencias'])->name('indexLic');
    /*END GET**/


    /*METODOS POST**/
    Route::post('GS/create',[LicenciasGosesController::class,'create'])->name('gs/create');
    
    /*END POST**/

});