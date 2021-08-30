<?php

namespace App\Http\Controllers;

use App\Models\Tipo_Contrato;
use Illuminate\Http\Request;

class Tipo_ContratoController extends Controller
{

    public $rules = [
        'tipo' => 'required|string',
    ];

    public function __construct(){
        $this->middleware('auth');
        $this->middleware(['role:super-admin']);
    }
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
            $tcontrato = Tipo_Contrato::where('tipo', 'LIKE', "%$keyword%")
            ->orWhere('estado', 'LIKE', "%$keyword%")
            ->latest()->paginate($perPage);
        } else {
            $tcontrato = Tipo_Contrato::latest()->paginate($perPage);
        }

        return view('Tipo_Contrato.index', compact('tcontrato'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Tipo_Contrato.create');
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
        $tcontrato = new Tipo_Contrato;
        $tcontrato -> tipo  =  $request->tipo;
        $exito = $tcontrato -> save();
        if(!$exito){
            return abort(404);
        }else{
            return redirect()->route('admin.tcontrato.index')
            ->with('titulo','Exito')
            ->with('El se guardo el registro en la base de datos.')
            ->with('success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipo_Contrato  $tipo_Contrato
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo_Contrato $tipo_Contrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipo_Contrato  $tipo_Contrato
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tcontrato = Tipo_Contrato::findOrFail($id);
        return view('Tipo_Contrato.edit', compact(['tcontrato']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipo_Contrato  $tipo_Contrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $tcontrato = Tipo_Contrato::findOrFail($id);
        $this->validate($request, $this->rules);
        $requestData = $request->all();
        $tcontrato->update($requestData);
        return redirect()->route('admin.tcontrato.index')->with('flash_message', 'Tipo Contrato modificado con éxito!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipo_Contrato  $tipo_Contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo_Contrato $tipo_Contrato)
    {
        //
    }
}
