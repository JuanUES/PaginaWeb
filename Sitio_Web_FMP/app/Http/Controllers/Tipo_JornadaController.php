<?php

namespace App\Http\Controllers;

use App\Models\Tipo_Jornada;
use Illuminate\Http\Request;

class Tipo_JornadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $tjornada = Tipo_Jornada::where('tipo', 'LIKE', "%$keyword%")
            ->orWhere('horas_semanales', 'LIKE', "%$keyword%")
            ->orWhere('estado', 'LIKE', "%$keyword%")
            ->latest()->paginate($perPage);
        } else {
            $tjornada = Tipo_Jornada::latest()->paginate($perPage);
        }

        return view('Tipo_Jornada.index', compact('tjornada'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Tipo_Jornada.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**Guardo en base de datos */
        $tjornada = new Tipo_Jornada;
        $tjornada -> tipo         =  $request->tipo;
        $tjornada -> horas_semanales    =  $request->horas_semanales;        
        $exito = $tjornada -> save();
        if(!$exito){
            return abort(404);
        }else{
            return redirect()->route('admin.tjornada.index')
            ->with('titulo','Exito')
            ->with('El se guardo el registro en la base de datos.')
            ->with('success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipo_Jornada  $tipo_Jornada
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo_Jornada $tipo_Jornada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipo_Jornada  $tipo_Jornada
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo_Jornada $tipo_Jornada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipo_Jornada  $tipo_Jornada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipo_Jornada $tipo_Jornada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipo_Jornada  $tipo_Jornada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo_Jornada $tipo_Jornada)
    {
        //
    }
}