<?php
/**Importaciones por default */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\indexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

Route::get('/', [indexController::class, 'index'])->name('index');


//Ruta para el admin
Route::get('admin', function () {
    return (!Auth::guest())
            ? view('Admin.home')
            : Redirect::to('/');
});


require __DIR__.'/transparencia.php';
require __DIR__.'/auth.php';
require __DIR__.'/pagina.php';
require __DIR__.'/licencias.php';
require __DIR__.'/horarios.php';
