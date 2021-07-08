<?php

namespace App\Http\Controllers\Pagina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pagina\JuntaJefatura;
use App\Models\Pagina\PDF;
use File;

class ProyeccionSocialController extends Controller
{
    public function index()
    { 
        $pdfs = PDF::where('localizacion','ProyeccionSocial')->get();
        $coordinadores = JuntaJefatura::where('tipo',4)->get();
        $jefaturas  = JuntaJefatura::where('nombre','jefatura') -> where('tipo',5) -> get();
        return view('Academicos.proyeccionSocial',compact('coordinadores','pdfs','jefaturas'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProyeccionSocial(Request $request)
    {
        /**Guardo en base de datos */
        $proyeccionSocial = new JuntaJefatura;
        $proyeccionSocial -> nombre          =  $request->coordinador;        
        $proyeccionSocial -> sector_dep_unid =  $request->departamento; 
        $proyeccionSocial -> tipo            =  4; 
        $proyeccionSocial -> user            =  auth()->id();
        $proyeccionSocial -> save();

        return redirect()->route('proyeccionSocial');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jefaturaProyeccionSocial(Request $request){
        $tipojefatura = 5;
        $jefatura  = JuntaJefatura::where('nombre','jefatura') -> where('tipo',$tipojefatura) -> get();
        
        if(count($jefatura) == 0){
            $_jefatura                =  new JuntaJefatura;

        }else{
            $_jefatura               =  $jefatura[0];           
        }
        $_jefatura  -> nombre          =  'jefatura';
        $_jefatura -> sector_dep_unid =  nl2br($request->jefatura); 
        $_jefatura -> tipo            =  $tipojefatura; 
        $_jefatura -> user            =  auth()->id();
        $_jefatura -> save();
        
        return redirect()->route('proyeccionSocial');
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
        
        return redirect()->route('proyeccionSocial');
        
    }

    public function eliminarPDF(PDF $pdf, $id){
        /**busco en la base de datos */
        $_pdf = PDF::find($id);

        if($_pdf != null){

            /**Elimino del servidor el pdf */
            File::delete(public_path() . '/files/pdfs/'.$_pdf->file); 

            /**Elimino de la base de datos */
            $_pdf -> delete();
        }

        /**Redirecciono a la vista de proyeccion */
        return redirect(route('proyeccionSocial').'#listaPDF');
    }
}