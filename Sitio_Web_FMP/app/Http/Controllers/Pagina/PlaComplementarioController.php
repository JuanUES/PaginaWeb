<?php

namespace App\Http\Controllers\Pagina;

use App\Http\Controllers\Controller;
use App\Models\Pagina\ContenidoHtml;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlaComplementarioController extends Controller
{
    //

    public function index(){

        $complementario = (Auth::guest()) ? 
        DB::table('complementarios')
        ->select('complementarios.*','p_d_f_s.file')
        ->leftJoin('p_d_f_s', 'complementarios.pdf', '=', 'p_d_f_s.id')
        ->where('estado',true)
        ->get(): 
        DB::table('complementarios')
        ->select('complementarios.*','p_d_f_s.file')
        ->leftJoin('p_d_f_s', 'complementarios.pdf', '=', 'p_d_f_s.id')
        ->get();

        $contenido = ContenidoHtml::where('localizacion','complementarioIndex')->first();
        return view('Academicos.PlanComplementario',compact('complementario','contenido'));
    }
}
