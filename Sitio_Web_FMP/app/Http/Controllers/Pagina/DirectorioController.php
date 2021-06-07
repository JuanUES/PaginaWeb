<?php

namespace App\Http\Controllers\Pagina;

use App\Http\Controllers\Controller;
use App\Models\Pagina\Directorio;
use Illuminate\Http\Request;

class DirectorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        //
=======
        $directorio = Directorio::all();
        return view('Nosotros.directorio',compact('directorio'));
>>>>>>> 6c4f23b9003421029db58138d4fffd05149db3aa
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $directorio = new Directorio();
        $directorio->nombre = $request->nombre;
        $directorio->contacto = nl2br($request->contacto);
        $directorio->user =  auth()->id();

        $exito = $directorio->save();

        if(!$exito){
            return redirect('/Directorio')
            ->with('titulo','Error')
            ->with('mensaje','No se realizo el registro en directorio.')
            ->with('tipo','error');
        }

        return redirect('/Directorio')
        ->with('titulo','Exito')
        ->with('mensaje','Registro realizado')
        ->with('tipo','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pagina\Directorio  $directorio
     * @return \Illuminate\Http\Response
     */
    public function show(Directorio $directorio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pagina\Directorio  $directorio
     * @return \Illuminate\Http\Response
     */
    public function edit(Directorio $directorio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pagina\Directorio  $directorio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Directorio $directorio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagina\Directorio  $directorio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Directorio $directorio, $id)
    {
        $contacto = Directorio::find($id);
        $contacto = delete();
        return view('Nosotros.directorio');
    }
}
