<?php
use Illuminate\Support\Facades\Route;

/**Administrativo */
Route::get('/Licencias', function () {
    return view('indexLicencias');
})->name('indexPermisos');