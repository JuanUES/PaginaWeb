<?php

namespace App\Http\Controllers\Pagina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pagina\PDF;

class EstructuraOrganizativaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $organigrama = PDF::where('localizacion','organigrama')->get();
        return view('Nosotros.estructuraOrganizativa', compact('organigrama'));     
    }
}
