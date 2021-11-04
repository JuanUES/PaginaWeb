<?php

namespace App\Http\Controllers\Licencias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConstanciaOlvidoController extends Controller
{
    public function index(){
        return view('Licencias.ConstanciaOlvido');
    }
}
