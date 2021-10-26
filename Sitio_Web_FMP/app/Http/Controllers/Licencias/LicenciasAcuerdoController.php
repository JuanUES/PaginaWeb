<?php

namespace App\Http\Controllers\Licencias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LicenciasAcuerdoController extends Controller
{
    public function index(){
        return view('Licencias.LicenciaAcuerdo');
    }
}
