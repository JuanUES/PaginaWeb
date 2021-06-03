<?php

namespace App\Http\Controllers\Pagina;

use App\Http\Controllers\Controller;
use App\Models\Pagina\JuntaJefatura;
use Illuminate\Http\Request;

class JuntaJefaturaController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store1(Request $request)
    {
        /**Guardo en base de datos */
        $juntaJefatura = new JuntaJefatura;
        $juntaJefatura -> nombre          =  $request->nombre;        
        $juntaJefatura -> sector_dep_unid =  $request->sector; 
        $juntaJefatura -> tipo            =  0; 
        $juntaJefatura -> user            =  auth()->id();
        $juntaJefatura -> save();

        return redirect('/EstructuraOrganizativa#junta');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store2(Request $request)
    {
        /**Guardo en base de datos */
        $juntaJefatura = new JuntaJefatura;
        $juntaJefatura -> nombre          =  $request->nombre;        
        $juntaJefatura -> sector_dep_unid =  nl2br($request->jefatura); 
        $juntaJefatura -> tipo            =  1; 
        $juntaJefatura -> user            =  auth()->id();
        $juntaJefatura -> save();

        return redirect('/EstructuraOrganizativa#jefatura');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagina\JuntaJefatura  $juntaJefatura
     * @return \Illuminate\Http\Response
     */
    public function destroy(JuntaJefatura $juntaJefatura, $id, $tipo)
    {
        /**Elimino de la base de datos */
        $id            =  base64_decode($id);
        $tipo          =  base64_decode($tipo);
        $juntaJefatura =  JuntaJefatura::find($id);        
        $juntaJefatura -> delete();
        if(!$tipo){
            return redirect('/EstructuraOrganizativa#junta');
        }
        else{
            return redirect('/EstructuraOrganizativa#jefatura');
        } 
    }
    
}
