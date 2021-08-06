<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pagina\ImagenesCarruselController;
use App\Http\Controllers\Pagina\NoticiaController;
use App\Http\Controllers\Pagina\PDFImageController;
use App\Http\Controllers\Pagina\EstructuraOrganizativaController;
use App\Http\Controllers\Pagina\JuntaJefaturaController;
use App\Http\Controllers\Pagina\DirectorioController;
use App\Http\Controllers\Pagina\ProyeccionSocialController;
use App\Http\Controllers\Pagina\MaestriaController;
use App\Http\Controllers\Pagina\PostgradoController;
use App\Http\Controllers\Pagina\InvestigacionController;
use App\Http\Controllers\Pagina\Academicos;
use App\Http\Controllers\Pagina\ContenidoHtmlController;
use App\Http\Controllers\Pagina\PlaComplementarioController;

/**PDF ------------------------------------------------------------------*/

Route::post('PDFS/{localizacion}',[PDFImageController::class,'storeAll'])->middleware(['auth'])->name('subirPdf');

Route::post('PDF/{localizacion}',[PDFImageController::class,'store'])->middleware(['auth'])->name('PDF');

/**Carrusel */

Route::post('/subirCarrusel/{tipo}', [ImagenesCarruselController::class, 'store'])
->middleware(['auth'])->name('ImagenCarrusel');

/**ContenidoHTML */

Route::post('contenidoHTML/{localizacion}',[ContenidoHtmlController::class,'store'])
->middleware(['auth'])->name('contenido');

/**Index ----------------------------------------------------------------*/

Route::post('/subirCarruselInicio/{tipo}', [ImagenesCarruselController::class, 'store'])
->middleware(['auth'])->name('ImagenFacultad.subir');

Route::post('/borrar/{id}/{imagen}/{url}', [ImagenesCarruselController::class, 'destroy'])
->middleware(['auth'])->name('ImagenFacultad.borrar');

Route::post('/noticias/nueva', [NoticiaController::class, 'store'])
->middleware(['auth'])->name('NoticiaFacultad.nueva');

Route::post('/noticias/nuevaurl', [NoticiaController::class, 'storeurl'])
->middleware(['auth'])->name('NoticiaFacultad.nuevaurl');

Route::post('/noticias/borrar', [NoticiaController::class, 'destroy'])
->middleware(['auth'])->name('NoticiaBorrar');

Route::get('/noticias/{titulo}/{id}',[NoticiaController::class, 'index'])
->name('NoticiaFacultad.ver');

/**Nosotros----------------------------------------------------------------------*/

Route::post('/nosotros/organigrama/image/{localizacion}', [PDFImageController::class, 'store1'])
->middleware(['auth'])->name('Nosotros.organigrama');

Route::get('EstructuraOrganizativa', [EstructuraOrganizativaController::class, 'index'])->name('EstructOrga');

Route::post('EstructuraOrganizativa/Junta', [JuntaJefaturaController::class, 'store1'])
->middleware(['auth'])->name('EstructuraOrganizativa.Junta');

Route::post('EstructuraOrganizativa/Jefatura', [JuntaJefaturaController::class, 'store2'])
->middleware(['auth'])->name('EstructuraOrganizativa.Jefatura');

Route::post('/EstructuraOrganizativa/JefaturaJunta', [JuntaJefaturaController::class, 'destroy'])
->middleware(['auth'])->name('JefaturaJuntaBorrar');

Route::post('/Directorio/Nuevo', [DirectorioController::class, 'store'])
->middleware(['auth'])->name('Nosotros.directorio');

Route::post('/Directorio/borrar', [DirectorioController::class, 'destroy'])
->middleware(['auth'])->name('directorio.borrar');

Route::get('/Directorio', [DirectorioController::class, 'index'])
->name('directorio');

Route::get('MisionVision', function () {
    return view('Nosotros.misionVision');
});

Route::post('/EstructuraOrganizativa/PeriodoJunta',[JuntaJefaturaController::class, 'periodoJunta'])
->middleware(['auth'])->name('Periodo.junta');

Route::post('/EstructuraOrganizativa/PeriodoJefatura',[JuntaJefaturaController::class, 'periodoJefatura'])
->middleware(['auth'])->name('Periodo.jefatura');

/**Academicos-------------------------------------------------------------------------------- */

Route::get('Informatica',[Academicos::class,'indexInfor'])->name('Departamento.Inform');

Route::get('CienciasAgronomicas', [Academicos::class,'indexAgro'])->name('Departamento.CienciasAgr');

Route::get('CienciasEconomicas', [Academicos::class,'indexEcono'])->name('Departamento.CienciasEcon');

Route::get('CienciasEducacion', [Academicos::class,'indexEdu'])->name('Departamento.CienciasEdu');

Route::get('PlanComplementario', [PlaComplementarioController::class,'index'])->name('planComp');

/**---------------------------------------------------------------------------------------- */

Route::get('Investigacion',[InvestigacionController::class, 'index'])->name('investigacion');

Route::get('ProyeccionSocial',[ProyeccionSocialController::class, 'index'])
->name('proyeccionSocial');

Route::post('ProyeccionSocial/Jefe/',[ProyeccionSocialController::class, 'jefaturaProyeccionSocial'])
->name('JefeProyeccionSocial')->middleware(['auth']);

Route::post('ProyeccionSocial/Coordinadores/',[ProyeccionSocialController::class, 'storeProyeccionSocial'])
->name('nuevoCoordinador')->middleware(['auth']);

Route::delete('ProyeccionSocial/EliminarPDF/{id}',[ProyeccionSocialController::class, 'eliminarPDF'])
->middleware(['auth'])->name('EliminarProyeccionPDF');

Route::get('Postgrado',[PostgradoController::class,'index'])->name('postgrado');

Route::post('Postgrado/Maestria/Registro',[MaestriaController::class,'store'])
->middleware(['auth'])
->name('Postgrado.registro');

Route::post('/subirCarruselPostgrado/{tipo}', [ImagenesCarruselController::class, 'store'])
->middleware(['auth'])->name('ConvocatoriaPostgrado');

Route::post('/Postgrado/Maestrias/estado', [MaestriaController::class,'estado'])
->middleware(['auth'])->name('estadoMaestria');

Route::post('/Postgrado/Maestria/Eliminar', [MaestriaController::class,'destroy'])
->middleware(['auth'])->name('EliminarMaestria');

/**Administrativo */
Route::get('/AdministracionFinanciera', function () {
    return view('Administrativo.administracionFinanciera');
})->name('administracionFinanciera');

Route::get('/UnidadDeTegnologiaDeLaInformacion', function () {
    return view('Administrativo.unidadTegnologiaInformacion');
})->name('uti');

Route::get('Academica', function () {
    return view('Academicos.administracionAcademica');
});
