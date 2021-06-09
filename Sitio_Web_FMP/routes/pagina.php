<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pagina\ImagenesCarruselController;
use App\Http\Controllers\Pagina\NoticiaController;
use App\Http\Controllers\Pagina\PDFController;
use App\Http\Controllers\Pagina\EstructuraOrganizativaController;
use App\Http\Controllers\Pagina\JuntaJefaturaController;
use App\Http\Controllers\Pagina\DirectorioController;


/**Index ----------------------------------------------------------------*/

Route::post('/upload', [ImagenesCarruselController::class, 'store'])
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

Route::post('/nosotros/organigrama/image/{localizacion}', [PDFController::class, 'store1'])
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

/**Administrativo */
Route::get('/AdministracionFinanciera', function () {
    return view('Administrativo.administracionFinanciera');
})->name('administracionFinanciera');

Route::get('/UnidadDeTegnologiaDeLaInformacion', function () {
    return view('Administrativo.unidadTegnologiaInformacion');
})->name('uti');
