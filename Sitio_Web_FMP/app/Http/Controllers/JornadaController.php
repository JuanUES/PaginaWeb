<?php

namespace App\Http\Controllers;

use App\Models\Jornada\Jornada;
use App\Models\Jornada\JornadaItem;
use Illuminate\Http\Request;

class JornadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $jornada = Jornada::where('id_emp', 'LIKE', "%$keyword%")
            ->orWhere('id_periodo', 'LIKE', "%$keyword%")
            ->latest()->paginate($perPage);
        } else {
            $jornada = Jornada::latest()->paginate($perPage);
        }*/

        return view('Jornada.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Jornada.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->except('items');
        $items = json_decode($request->items);

        // dd($items);

        $jornada = Jornada::create($requestData);
        foreach ($items as $key => $value) { //para guardar los items del jornada
            JornadaItem::create([
                'id_jornada' => $jornada->id,
                'dia' => $value->dia,
                'hora_inicio' => $value->hora_inicio,
                'hora_fin' => $value->hora_fin,
                'estado' => 1
            ]);
        }
        return redirect('Jornada.index')->with('flash_message', 'Agregado');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function show(Jornada $jornada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function edit(Jornada $jornada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jornada $jornada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jornada $jornada)
    {
        //
    }
}
