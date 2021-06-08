<?php

namespace App\Http\Controllers\Pagina;

use App\Http\Controllers\Controller;
use App\Models\Pagina\Noticia;
use Illuminate\Http\Request;
use File;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $titulo)
    { 
        $idNoticia = base64_decode($id);
        $noticias  = Noticia::all();
        $noticia   = $noticias -> find($idNoticia);
        if($noticia != null and $noticia -> tipo){   
            return view('Inicio.Noticia', compact('noticia'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function noticia()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**Guardo en carpeta Noticia */
        $file = $request->file('img'); 
        $path = public_path() . '\images\noticias';
        $fileName = uniqid();
        $file->move($path, $fileName);
        
        /**Guardo en base de datos */
        $noticia = new Noticia;
        $noticia -> titulo    =  $request->titulo;        
        $noticia -> subtitulo =  $request->subtitulo;        
        $noticia -> imagen    =  $fileName;
        $noticia -> tipo      =  'true'; 
        $noticia -> contenido =  str_replace(array("\r\n", "\n\r", "\r", "\n"), "<br/>", $request->contenido);
        $noticia -> fuente    =  $request->fuente;        
        $noticia -> urlfuente =  $request->urlfuente;
        $noticia -> user      =  auth()->id();
        $exito = $noticia -> save();
        if(!$exito){
            return redirect()->route('index')
            ->with('titulo','Error')
            ->with('No se guardo el registro en la base de datos.')
            ->with('error');

        }else{
            return redirect()->route('index')
            ->with('titulo','Exito')
            ->with('El se guardo el registro en la base de datos.')
            ->with('success');
        }
    }

    public function storeurl(Requtiest $request)
    {
        /**Guardo en carpeta Noticia */
        $file = $request->file('img'); 
        $path = public_path() . '\images\noticias';
        $fileName = uniqid();
        $file->move($path, $fileName);
        
        /**Guardo en base de datos */
        $noticia = new Noticia;
        $noticia -> titulo    =  $request->titulo;        
        $noticia -> subtitulo =  $request->subtitulo;        
        $noticia -> imagen    =  $fileName;
        $noticia -> tipo      =  'false';  
        $noticia -> urlfuente =  $request->urlfuente;
        $noticia -> user      =  auth()->id();
        $noticia -> save();

        if(!$exito){
            return redirect()->route('index')
            ->with('titulo','Error')
            ->with('No se guardo el registro en la base de datos.')
            ->with('error');

        }else{
            return redirect()->route('index')
            ->with('titulo','Exito')
            ->with('El se guardo el registro en la base de datos.')
            ->with('success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticia::find(base64_decode($id));
        $exito = $noticia -> delete();
        if($exito){
            return redirect('/#noticias')
            ->with('titulo','Exito')
            ->with('mensaje','Se elimino el registro de la base de datos.')
            ->with('tipo','info');
        }else{
            return redirect('/#noticias')
            ->with('titulo','Exito')
            ->with('mensaje','El se guardo el registro en la base de datos.')
            ->with('tipo','success');
        }        
    }
}
