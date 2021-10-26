<?php

//use App\Http\Controllers\EmpleadoController;

use App\Http\Controllers\Licencias\LicenciasAcuerdoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Licencias\LicenciasController;
use App\Http\Controllers\Licencias\LicenciasGosesController;
use App\Http\Controllers\Licencias\LicenciasJefeRRHHController;
use App\Models\Licencias\Licencia_con_gose;

Route::group(['middleware' => ['auth']], function () {

    /*METODOS GET**/
    Route::get('admin/mislicencias', [LicenciasController::class,'indexMisLicencias'])->name('indexLic');
    Route::get('admin/LicenciasAcuerdo', [LicenciasAcuerdoController::class,'index'])->name('AcuerdoLic');
    Route::get('admin/mislicencias/horas/{fecha}', [LicenciasController::class,'horas_disponibles']);
    Route::get('admin/mislicencias/horas-anuales/{fecha}', [LicenciasController::class,'horas_anuales']);
    Route::get('admin/mislicencias/permiso/{permiso}',[LicenciasController::class,'permiso']);
    Route::get('admin/mislicencias/procesos/{permiso}',[LicenciasController::class,'procesos']);

    Route::get('admin/licencias/jefatura',[LicenciasJefeRRHHController::class,'indexJefe'])->name('indexJefatura');
    Route::get('admin/licencias/RRHH',[LicenciasJefeRRHHController::class,'indexRRHH'])->name('indexRRHH');
    
    Route::get('admin/licenciaGS', [LicenciasGosesController::class,'index'])->name('indexLicGS');

    //get para cargar los datos en el modal GS
    Route::get('/admin/GS/{id}',[LicenciasGosesController::class,'GsModal']);
    /*END GET**/
    
    /*METODOS POST**/
    //para registrar las horas GS depende de las jornadas
    Route::post('GS/create',[LicenciasGosesController::class,'create'])->name('gs/create');
    Route::post('admin/licencia/create', [LicenciasAcuerdoController::class,'store'])->name('licAcuerdo/create');

    Route::post('admin/licencia/create', [LicenciasController::class,'store'])->name('lic/create');
    Route::post('admin/licencia/cancel', [LicenciasController::class,'cancelar'])->name('lic/cancelar');
    Route::post('admin/licencia/enviar', [LicenciasController::class,'enviar'])->name('lic/enviar');
    /*END POST**/

});