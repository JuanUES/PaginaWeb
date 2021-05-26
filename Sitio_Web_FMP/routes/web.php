<?php
/**Importaciones por default */
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\indexController;

/**Importaciones para que funcione Index */
use App\Http\Controllers\Pagina\ImagenesCarruselController;
use App\Http\Controllers\Pagina\NoticiaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [indexController::class, 'index']);

/**Index ----------------------------------------------------------------*/

Route::post('/upload', [ImagenesCarruselController::class, 'store'])
->middleware(['auth'])->name('ImagenFacultad.subir');

Route::post('/borrar/{id}/{imagen}', [ImagenesCarruselController::class, 'destroy'])
->middleware(['auth'])->name('ImagenFacultad.borrar');

Route::post('/noticias', [NoticiaController::class, 'store'])
->middleware(['auth'])->name('NoticiaFacultad.nueva');

Route::get('/noticia/{id}',[NoticiaController::class, 'noticia'])
->middleware(['auth'])->name('NoticiaFacultad.ver');

/**----------------------------------------------------------------------- */

/**Debo eliminar esta ruta y sus archivos relacionados */
Route::get('InicioSesion', function () {
    return view('Sesion.inicioSesion');
});

/**------------------------------------ */

Route::get('MisionVision', function () {
    return view('Nosotros.misionVision');
});

Route::get('Directorio', function () {
    return view('Nosotros.directorio');
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

Route::get('EstructuraOrganizativa', function () {
    return view('Nosotros.estructuraOrganizativa');
});

require __DIR__.'/auth.php';
