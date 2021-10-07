<?php

namespace App\Http\Controllers\Licencias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LicenciasGosesController extends Controller
{
    public function index(){
        $tipo_jornada = DB::table('tipo_jornada')->get();
        return view('Licencias.LicenciasGS',compact('tipo_jornada'));
    }
}
