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

/**PDF ------------------------------------------------------------------*/

Route::post('PDF/{localizacion}',[PDFImageController::class,'storeAll'])->middleware(['auth'])->name('subirPdf');

/**Index ----------------------------------------------------------------*/

Route::post('/subirCarruselInicio/{tipo}', [ImagenesCarruselController::class, 'store'])
->middleware(['auth'])->name('ImagenFacultad.subir');

Route::post('/borrar/{id}/{imagen}', [ImagenesCarruselController::class, 'destroy'])
->middleware(['auth'])->name('ImagenFacultad.borrar');

Route::post('/noticias/nueva', [NoticiaController::class, 'store'])
->middleware(['auth'])->name('NoticiaFacultad.nueva');

Route::post('/noticias/nuevaurl', [NoticiaController::class, 'storeurl'])
->middleware(['auth'])->name('NoticiaFacultad.nuevaurl');

Route::post('/noticias/{id}', [NoticiaController::class, 'destroy'])
->middleware(['auth'])->name('NoticiaFacultad.borrar');

Route::get('/noticias/{titulo}/{id}',[NoticiaController::class, 'index'])
->name('NoticiaFacultad.ver');

/**Nosotros----------------------------------------------------------------------*/

Route::post('/nosotros/organigrama/image/{localizacion}', [PDFImageController::class, 'store1'])
->middleware(['auth'])->name('Nosotros.organigrama');

Route::get('EstructuraOrganizativa', [EstructuraOrganizativaController::class, 'index']);

Route::post('EstructuraOrganizativa/Junta', [JuntaJefaturaController::class, 'store1'])
->middleware(['auth'])->name('EstructuraOrganizativa.Junta');

Route::post('EstructuraOrganizativa/Jefatura', [JuntaJefaturaController::class, 'store2'])
->middleware(['auth'])->name('EstructuraOrganizativa.Jefatura');

Route::post('/EstructuraOrganizativa/JefaturaJunta/{id}/{tipo}', [JuntaJefaturaController::class, 'destroy'])
->middleware(['auth'])->name('EstructuraOrganizativa.Jefatura.Borrar');

Route::post('/Directorio/Nuevo', [DirectorioController::class, 'store'])
->middleware(['auth'])->name('Nosotros.directorio');

Route::post('/Directorio/borrar/{id}', [DirectorioController::class, 'destroy'])
->middleware(['auth'])->name('Nosotros.directorio.borrar');

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
Route::get('Informatica', function () {
    return view('Academicos.Departamentos.informatica');
});

Route::get('CienciasAgronomicas', function () {
    return view('Academicos.Departamentos.CienciasAgronomicas');
});

Route::get('CienciasEconomicas', function () {
    return view('Academicos.Departamentos.CienciasEconomicas');
});

Route::get('CienciasEducacion', function () {
    return view('Academicos.Departamentos.CienciasEducacion');
});

Route::get('Investigacion', function () {
    return view('Academicos.investigacion');
})->name('investigacion');

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
