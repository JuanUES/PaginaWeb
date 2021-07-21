<?php

namespace App\Http\Controllers\Pagina;

use App\Http\Controllers\Controller;
use App\Models\Pagina\ImagenesCarrusel;
use Illuminate\Http\Request;
use File;

class ImagenesCarruselController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$tipo)
    {
        /**Guardo en la carpeta del servidor */
        $file = $request->file('file'); 
        $path = public_path() . '/images/carrusel';
        //$fileName = uniqid() . $file->getClientOriginalName(); -> Por si deseo hacer un cambio
        $fileName = uniqid();
        $file->move($path, $fileName);
        
        /** Guardo en la base de datos */
        $imagenesCarrusel = new ImagenesCarrusel;
        $imagenesCarrusel -> imagen = $fileName;
        $imagenesCarrusel -> tipo = $tipo;
        $imagenesCarrusel -> user   =  auth()->id();
        $imagenesCarrusel -> save();

        return redirect();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pagina\ImagenesCarrusel  $imagenesCarrusel
     * @return \Illuminate\Http\Response
     */
    public function show(ImagenesCarrusel $imagenesCarrusel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pagina\ImagenesCarrusel  $imagenesCarrusel
     * @return \Illuminate\Http\Response
     */
    public function edit(ImagenesCarrusel $imagenesCarrusel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pagina\ImagenesCarrusel  $imagenesCarrusel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImagenesCarrusel $imagenesCarrusel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagina\ImagenesCarrusel  $imagenesCarrusel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImagenesCarrusel $imagenesCarrusel, $id, $imagen)
    {   echo dd($id);
        /**Elimino de la base de datos */
        $imgCa = ImagenesCarrusel::find($id);        
        $imgCa -> delete();

        /**Elimino de la carpeta del servidor */
        File::delete(public_path() . '/images/carrusel/'.$imagen); 
        
        return redirect('/');
    }
}
