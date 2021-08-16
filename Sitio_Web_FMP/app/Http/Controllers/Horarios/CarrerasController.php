<?php

namespace App\Http\Controllers\Horarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarrerasController extends Controller
{
    public function index(){
        $deptosC = DB::table('departamentos')->get();

        

        return view('Admin.horarios.carreras',compact('deptosC'));
    }
}
