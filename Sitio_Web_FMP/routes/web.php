<?php
/**Importaciones por default */
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\indexController;

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

/** RUTAS DE TRANSPARENCIA **/

Route::get('transparencia', function () {
    return view('index-transparencia');
});

Route::get('admin', function () {
    return view('Admin.home');
});

require __DIR__.'/auth.php';
require __DIR__.'/pagina.php';
