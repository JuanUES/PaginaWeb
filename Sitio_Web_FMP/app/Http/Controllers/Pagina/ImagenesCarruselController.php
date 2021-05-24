<?php

namespace App\Http\Controllers\Pagina;

use App\Http\Controllers\Controller;
use App\Models\Pagina\ImagenesCarrusel;
use Illuminate\Http\Request;

class ImagenesCarruselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file'); 
        $path = public_path() . '/images/carrusel';
        $fileName = uniqid() . $file->getClientOriginalName();
        $file->move($path, $fileName);
        
        $imagenesCarrusel = new ImagenesCarrusel;
        $imagenesCarrusel -> imagen = $fileName;
        $imagenesCarrusel -> save();
        return redirect('/');
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
    public function destroy(ImagenesCarrusel $imagenesCarrusel)
    {
        File::delete($filename);
    }
}
