<?php

namespace App\Http\Controllers\Horarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CargaController extends Controller
{
    public function index(){
        return view('Admin.horarios.carga');
    }
}
