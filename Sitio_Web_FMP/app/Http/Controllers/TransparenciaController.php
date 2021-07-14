<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Transparencia;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TransparenciaController extends Controller
{
    public $categorias = array(
        'Marco Normativo' => 'marco-normativo',
        'Marco de Gestion' => 'marco-gestion',
        'Marco Presupuestario' => 'marco-presupuestario',
        'Estadisticas' => 'estadisticas',
        'Documentos de Junta Directiva' => 'documentos-JD'
    );

    public $subcategorias = ['acuerdos', 'agendas', 'actas'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $categoria){
        $titulo = array_search($categoria, $this->categorias, true);

        if ($request->ajax()) {
            $data = Transparencia::select('*')
                                ->where('estado','activo')
                                ->where('categoria', $categoria)
                                ->orderByRaw('created_at ASC')
                                ->get();
            return DataTables::of($data)
                ->addColumn('descripcion', 'Transparencia.dataTable.descripcion')
                ->addColumn('publicar', 'Transparencia.dataTable.publicar')
                ->addColumn('action', 'Transparencia.dataTable.actions')
                ->rawColumns(['action', 'publicar', 'descripcion'])
                ->make(true);
        }
        return view('Transparencia.index', compact(['categoria', 'titulo']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($categoria){
        $titulo = array_search($categoria, $this->categorias, true);
        $subcategorias = $this->subcategorias;

        return view('Transparencia.create', compact('categoria', 'titulo', 'subcategorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $campos = [
            'titulo' => 'required',
            "documento" => "required|mimes:pdf",
        ];
        $this->validate($request, $campos);

        $requestData = $request->all();
        if ($request->hasFile('documento')) {
            $requestData['documento'] = $request->file('documento')
                ->store('uploads/transparencia', 'public');
        }

        $doc = Transparencia::create($requestData);

        // $categoria = $doc->categoria;
        // $titulo = array_search($categoria, $this->categorias, true);

        return redirect('admin/transparencia/' . $request->categoria)->with('flash_message', 'Documento almacenado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id){
    //     $transparencia = Transparencia::findOrFail($id);
    //     return view('Transparencia.show', compact('transparencia'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($categoria, $id){
        $transparencia = Transparencia::findOrFail($id);
        $titulo = array_search($categoria, $this->categorias, true);
        // $categoria = $transparencia->categoria;
        return view('Transparencia.edit', compact(['transparencia', 'categoria','titulo']));
    }

    public function publicar($id, Request $request){
        $transparencia = Transparencia::findOrFail($id);

        // dd($request);
        $publicar = (isset($request->publicar)) ? 'publicado' : 'sin publicar';

        $transparencia->update([
            'publicar' => $publicar
        ]);

        $categoria = $transparencia->categoria;
        // $categoria = $transparencia->categoria;
        return redirect('admin/transparencia/' . $categoria)->with('flash_message', 'Documento modificado con exito!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transparencia = Transparencia::findOrFail($id);
        $campos = [
            'titulo' => 'required',
            "documento" => "required|mimes:pdf",
        ];

        $this->validate($request, $campos);

        $requestData = $request->all();
        if ($request->hasFile('documento')) {
            $requestData['documento'] = $request->file('documento')
            ->store('uploads/transparencia', 'public');
        }

        $transparencia->update($requestData);
        return redirect('admin/transparencia/' . $request->categoria)->with('flash_message', 'Documento modificado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
