<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Licencias\Empleado;
class EmpleadoController extends Controller
{
    function index(){
        
        $empleadoJefe = Empleado::where('jefe',null)->get();

        return view('Admin.empleados.empleado',compact('empleadoJefe'));
    }
}
