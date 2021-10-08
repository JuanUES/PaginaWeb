<?php

//use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Licencias\LicenciasController;
use App\Http\Controllers\Licencias\LicenciasGosesController;
use App\Models\Licencias\Licencia_con_gose;

Route::group(['middleware' => ['auth']], function () {

    /*METODOS GET**/
    Route::get('admin/licenciaGS', [LicenciasGosesController::class,'index'])->name('indexLicGS');
    Route::get('admin/misLicencias', [LicenciasController::class,'indexMisLicencias'])->name('indexLic');

    //get para cargar los datos en el modal GS
    Route::get('/admin/GS/{id}',[LicenciasGosesController::class,'GsModal']);
    /*END GET**/


    /*METODOS POST**/
    //para registrar las horas GS depende de las jornadas
    Route::post('GS/create',[LicenciasGosesController::class,'create'])->name('gs/create');
    
    /*END POST**/

});