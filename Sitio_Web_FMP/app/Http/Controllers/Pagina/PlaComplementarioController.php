<?php

namespace App\Http\Controllers\Pagina;

use App\Http\Controllers\Controller;
use App\Models\Pagina\ContenidoHtml;
use Illuminate\Http\Request;

class PlaComplementarioController extends Controller
{
    //

    public function index(){

        $contenido = ContenidoHtml::where('localizacion','complementarioIndex')->first();
        return view('Academicos.PlanComplementario',compact('contenido'));
    }
}
