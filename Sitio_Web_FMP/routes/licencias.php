<?php

//use App\Http\Controllers\EmpleadoController;

use App\Http\Controllers\Licencias\ConstanciaOlvidoController;
use App\Http\Controllers\Licencias\ReporteController;
use App\Http\Controllers\Licencias\LicenciasAcuerdoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Licencias\LicenciasController;
use App\Http\Controllers\Licencias\LicenciasGosesController;
use App\Http\Controllers\Licencias\LicenciasJefeRRHHController;
use App\Models\Licencias\Licencia_con_gose;

Route::group(['middleware' => ['auth']], function () {

    /*METODOS GET**/
    Route::get('admin/LicenciasAcuerdo', [LicenciasAcuerdoController::class,'index'])->name('AcuerdoLic');
    Route::get('admin/LicenciasAcuerdo/tabla', [LicenciasAcuerdoController::class,'Data']);
    Route::get('admin/LicenciasAcuerdo/edit/{id}', [LicenciasAcuerdoController::class,'cargaModal']);

    Route::get('admin/ConstanciaOlvido',[ConstanciaOlvidoController::class,'index'])->name('olvido');
    Route::get('admin/ConstanciaOlvido/table',[ConstanciaOlvidoController::class,'Table']);
    Route::get('admin/ConstanciaOlvido/Modal/{id}',[ConstanciaOlvidoController::class,'Modal']);
    Route::get('admin/ConstanciaOlvido/EntradaSalida/{fecha}',[ConstanciaOlvidoController::class,'SalidaEntrada']);

    Route::get('admin/ConstanciaOlvido/Reporte',[ReporteController::class,'index'])->name('index/reporteConst');
   

    Route::get('admin/ConstanciaOlvido/Report',[ReporteController::class,'downloadPDF'])->name('constR');
    Route::get('admin/Constancia/Reporte',[ReporteController::class,'indexConsResporte'])->name('reporteConst/vista');//para visualizar los datos en el blade
    Route::get('admin/Constancia/Tabla/Reporte/{f1}/{f2}/{d}',[ReporteController::class,'mostrarTablaConst']);//PARA LA TABLA DE LA VISTA
    
    //para visualizar la vista
    Route::get('admin/Licencias/Aceptadas',[ReporteController::class,'indexBladeLicencias'])->name('reportesLicencias/vista');//para visualizar los datos en el blade
    //para mostrar el reporte en la tabla dinamica
    Route::get('admin/Licencias/Reporte/{f1}/{f2}/{d}',[ReporteController::class,'mostrarTablaLicencias']);//PARA LA TABLA DE LA VISTA
    

    Route::get('admin/mislicencias', [LicenciasController::class,'indexMisLicencias'])->name('indexLic');

    Route::get('admin/mislicencias/horas-anual/{fecha}/{permiso}', [LicenciasController::class,'horas_anual']);
    Route::get('admin/mislicencias/horas-mensual/{fecha}/{permiso}', [LicenciasController::class,'horas_mensual']);
    Route::get('admin/mislicencias/permisos', [LicenciasController::class,'getPermisos']);

    Route::get('admin/mislicencias/permiso/{permiso}',[LicenciasController::class,'permiso']);
    Route::get('admin/mislicencias/procesos/{permiso}',[LicenciasController::class,'procesos']);

    Route::get('admin/licencias/jefatura',[LicenciasJefeRRHHController::class,'indexJefe'])->name('indexJefatura');
    Route::get('admin/licencias/RRHH',[LicenciasJefeRRHHController::class,'indexRRHH'])->name('indexRRHH');
    Route::get('admin/licencias/RRHH/datableJson',[LicenciasJefeRRHHController::class,'datableRRHHJson']);

    Route::get('admin/licencias/jefaturaRRHH/{permiso}',[LicenciasJefeRRHHController::class,'permiso']);
    
    Route::get('admin/licenciaGS', [LicenciasGosesController::class,'index'])->name('indexLicGS');

    //get para cargar los datos en el modal GS
    Route::get('/admin/GS/{id}',[LicenciasGosesController::class,'GsModal']);
    /*END GET**/
    
    /*METODOS POST**/
    //para registrar las horas GS depende de las jornadas
    Route::post('GS/create',[LicenciasGosesController::class,'create'])->name('gs/create');
    Route::post('admin/licenciasAcuerdos/create', [LicenciasAcuerdoController::class,'store'])->name('licAcuerdo/create');

    Route::post('admin/ConstanciaOlvido/create', [ConstanciaOlvidoController::class,'store'])->name('olvido/create');
    Route::post('admin/ConstanciaOlvido/cancel', [ConstanciaOlvidoController::class,'cancelar'])->name('olvido/cancel');

    Route::post('admin/licencia/create', [LicenciasController::class,'store'])->name('lic/create');
    Route::post('admin/licencia/cancel', [LicenciasController::class,'cancelar'])->name('lic/cancelar');
    Route::post('admin/licencia/enviar', [LicenciasController::class,'enviar'])->name('lic/enviar');

    Route::post('admin/licencias/jefatura/aceptar',[LicenciasJefeRRHHController::class,'aceptarJefatura'])->name('jf/aceptar');
    Route::post('admin/licencias/jefatura/observacion',[LicenciasJefeRRHHController::class,'observacionJefatura'])->name('jf/observacion');
    Route::post('admin/licencias/jefatura/observacionCosnt',[LicenciasJefeRRHHController::class,'observacionJefaturaConst'])->name('jf/observacionConst');

    Route::post('admin/licencias/rrhh/aceptar',[LicenciasJefeRRHHController::class,'aceptarRRHH'])->name('rrhh/aceptar');
    Route::post('admin/licencias/rrhh/observacion',[LicenciasJefeRRHHController::class,'observacionRRHH'])->name('rrhh/observacion');
    Route::post('admin/licencias/rrhh/observacionConst',[LicenciasJefeRRHHController::class,'observacionRRHHconst'])->name('rrhh/observacionConst');

    //ruta para generar el reporte
    Route::post('admin/Licencias/Reporte/PDF',[ReporteController::class,'licenciasDeptosPDF'])->name('Reporte/licencias');
    Route::post('admin/Constancias/Reporte/PDF',[ReporteController::class,'ConstDeptosPDF'])->name('Reporte/cosntancias');
    /*END POST**/

// Resportes
    Route::get('Reportes/Revision', [ReporteRevisionPermisosMensuales::class,'PDF'])->name('descargarPDF');
});