<?php

namespace App\Http\Controllers\Horarios;

use App\Http\Controllers\Controller;
use App\Models\Horarios\CargaAdmin;
use Illuminate\Http\Request;

class AsignacionCargaController extends Controller
{
    //
    public function index(){
        return view('Admin.horarios.asignarCarga');
    }

    public function cargaCombobox($c){         
        return CargaAdmin::where('categoria',$c)
        ->select('*')
        ->get()
        ->toJson();
    }
}
