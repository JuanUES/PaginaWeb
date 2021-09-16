<?php

namespace App\Http\Controllers\Horarios;

use App\Http\Controllers\Controller;
use App\Models\Horarios\CargaAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignacionCargaController extends Controller
{
    //
    public function index(){
        $empleados= DB::table('empleado')->get();
        return view('Admin.horarios.asignarCarga',compact('empleados'));
    }

    public function cargaCombobox($c){         
        return CargaAdmin::where('categoria',$c)
        ->select('*')
        ->get()
        ->toJson();
    }
}
