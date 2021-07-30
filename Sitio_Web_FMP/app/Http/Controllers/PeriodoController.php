<?php

namespace App\Http\Controllers;

use App\Models\Jornada\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
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
            $periodo = Periodo::where('fecha_inicio', 'LIKE', "%$keyword%")
            ->orWhere('fecha_fin', 'LIKE', "%$keyword%")
            ->orWhere('tipo', 'LIKE', "%$keyword%")
            ->orWhere('estado', 'LIKE', "%$keyword%")
            ->latest()->paginate($perPage);
        } else {
            $periodo = Periodo::latest()->paginate($perPage);
        }

        return view('Periodo.index', compact('periodo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Periodo.create');
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
        $periodo = new Periodo;
        $periodo -> fecha_inicio =  $request->fecha_inicio;        
        $periodo -> fecha_fin    =  $request->fecha_fin;        
        $periodo -> tipo         =  $request->tipo;
        $exito = $periodo -> save();
        if(!$exito){
            return abort(404);
        }else{
            return redirect()->route('admin.periodo.index')
            ->with('titulo','Exito')
            ->with('El se guardo el registro en la base de datos.')
            ->with('success');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function show(Periodo $periodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function edit(Periodo $periodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periodo $periodo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periodo $periodo)
    {
        //
    }
}
