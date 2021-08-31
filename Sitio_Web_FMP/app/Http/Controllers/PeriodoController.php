<?php

namespace App\Http\Controllers;

use App\Models\_UTILS\Utilidades;
use App\Models\Jornada\Periodo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeriodoController extends Controller{
    public $modulo = 'Transparencia Directorios';

    public $rules = [
        'titulo' => 'required|string',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date',
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
    public function index(Request $request){
        $periodo = Periodo::orderBy('created_at','ASC')->get();
        return view('Periodo.index', compact('periodo'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        /**Guardo en base de datos */
        try {
            $validator = Validator::make($request->all(), $this->rules);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }
            $requestData = $request->except(['_id']);
            if( strcmp($request->_id, '')==0){
                $msg = 'Registro exitoso.';
                $periodo = Periodo::create($requestData);
                Utilidades::fnSaveBitacora('Nuevo Periodo #: ' . $periodo->id.' Título: '.$periodo->titulo, 'Registro', $this->modulo);
            }else{
                $msg = 'Modificación exitoso.';
                $periodo = Periodo::findOrFail($request->_id);
                $periodo->update($requestData);
                Utilidades::fnSaveBitacora('Periodo #: ' . $periodo->id.' Título: '.$periodo->titulo, 'Modificación', $this->modulo);
            }
            return response()->json(['mensaje' => $msg]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        return Periodo::findOrFail($id);
    }
}
