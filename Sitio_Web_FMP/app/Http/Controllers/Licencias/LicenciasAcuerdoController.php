<?php

namespace App\Http\Controllers\Licencias;

use App\Http\Controllers\Controller;
use App\Models\General\Empleado;
use Illuminate\Http\Request;

class LicenciasAcuerdoController extends Controller
{
    public function index(){
        $empleados = Empleado::all();
        $empleado = Empleado::findOrFail(auth()->user()->empleado);  
        return view('Licencias.LicenciaAcuerdo',compact('empleados'));
    }
}
