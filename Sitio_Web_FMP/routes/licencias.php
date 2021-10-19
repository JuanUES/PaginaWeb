<?php

//use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Licencias\LicenciasController;
use App\Http\Controllers\Licencias\LicenciasGosesController;
use App\Models\Licencias\Licencia_con_gose;

Route::group(['middleware' => ['auth']], function () {

    /*METODOS GET**/
    Route::get('admin/mislicencias', [LicenciasController::class,'indexMisLicencias'])->name('indexLic');
    Route::get('admin/mislicencias/horas/{fecha}', [LicenciasController::class,'horas_disponibles']);

    Route::get('admin/licenciaGS', [LicenciasGosesController::class,'index'])->name('indexLicGS');

    //get para cargar los datos en el modal GS
    Route::get('/admin/GS/{id}',[LicenciasGosesController::class,'GsModal']);
    /*END GET**/
    
    /*METODOS POST**/
    //para registrar las horas GS depende de las jornadas
    Route::post('GS/create',[LicenciasGosesController::class,'create'])->name('gs/create');
    Route::post('admin/licencia/create', [LicenciasController::class,'store'])->name('lic/create');
    /*END POST**/

});