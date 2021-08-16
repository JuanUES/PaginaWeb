<?php

namespace App\Http\Controllers\Transparencia;

use App\Http\Controllers\Controller;
use App\Models\Transparencia\Directorio;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DirectoriosController extends Controller{


    public function __construct(){
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Transparencia-Decano']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Directorio::where('estado', 'activo')
                ->latest('created_at')
                ->get();

            return DataTables::of($data)
                ->addColumn('contacto', 'Transparencia.Directorios.dataTable.contacto')
                ->addColumn('action', 'Transparencia.Directorios.dataTable.actions')
                ->editColumn('created_at', function ($item) {
                    return date('d/m/Y h:i:s a', strtotime($item->created_at));
                })
                ->rawColumns(['action', 'contacto'])
                ->make(true);
        }
        return view('Transparencia.Directorios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('Transparencia.Directorios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $campos = [
            'nombre' => 'required|string',
            "contacto" => "required|string",
        ];
        $this->validate($request, $campos);
        $requestData = $request->all();

        $directorio = Directorio::create($requestData);
        return redirect()->route('admin.transparencia.directorios.index')->with('flash_message', 'Directorio almacenado con éxito!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $directorio = Directorio::findOrFail($id);
        return view('Transparencia.Directorios.edit', compact(['directorio']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $directorio = Directorio::findOrFail($id);
        $campos = [
            'nombre' => 'required|string',
            "contacto" => "required|string",
        ];
        $this->validate($request, $campos);
        $requestData = $request->all();

        $directorio->update($requestData);
        return redirect()->route('admin.transparencia.directorios.index')->with('flash_message', 'Directorio modificado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $directorio = Directorio::findOrFail($id);
        $directorio->update([
            'estado' => 'inactivo'
        ]);
        return redirect()->route('admin.transparencia.directorios.index')->with('flash_message', 'Directorio eliminado con éxito!');

    }
}