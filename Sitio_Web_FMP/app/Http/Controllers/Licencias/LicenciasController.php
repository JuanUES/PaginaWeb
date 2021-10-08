<?php

namespace App\Http\Controllers\Licencias;
use App\Models\General\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class LicenciasController extends Controller
{

    public function indexMisLicencias(){
        if(is_null(auth()->user()->empleado))
        {
            return view('Licencias.LicenciaEmpleado',compact('empleado'));
        }
        else
        {
            $empleado = Empleado::findOrFail(auth()->user()->empleado);       
            return view('Licencias.LicenciaEmpleado',compact('empleado'));
        }
    }
}