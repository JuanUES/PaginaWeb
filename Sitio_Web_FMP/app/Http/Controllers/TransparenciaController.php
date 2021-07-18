<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Transparencia;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class TransparenciaController extends Controller
{
    public $categorias = array(
        'Marco Normativo' => 'marco-normativo',
        'Marco de Gestión' => 'marco-gestion',
        'Marco Presupuestario' => 'marco-presupuestario',
        'Estadísticas' => 'estadisticas',
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

        //para validar que existe la categoria en el listado y no genere error
        if($titulo!=false){
            if ($request->ajax()) {
                $data = Transparencia::where('estado','activo')
                                    ->where('categoria', $categoria)
                                    ->latest('created_at')
                                    ->get();

                return DataTables::of($data)
                    ->addColumn('descripcion', 'Transparencia.dataTable.descripcion')
                    ->addColumn('publicar', 'Transparencia.dataTable.publicar')
                    ->addColumn('action', 'Transparencia.dataTable.actions')
                    ->editColumn('created_at', function ($data_rem) {
                        return date('d/m/Y h:i:s a', strtotime($data_rem->created_at));
                    })
                    ->rawColumns(['action', 'publicar', 'descripcion'])
                    ->make(true);
            }
            return view('Transparencia.index', compact(['categoria', 'titulo']));
        }else{
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($categoria){
        $titulo = array_search($categoria, $this->categorias, true);

        if($titulo!=false){
            $subcategorias = $this->subcategorias;
            return view('Transparencia.create', compact('categoria', 'titulo', 'subcategorias'));
        }else{
            return abort(404);
        }
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
        if ($request->hasFile('documento'))
            $requestData['documento'] = $request->file('documento')->store('uploads/transparencia', 'public');

        $doc = Transparencia::create($requestData);
        return redirect('admin/transparencia/' . $request->categoria)->with('flash_message', 'Documento almacenado con éxito!');
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

        return $titulo!=false
                ? view('Transparencia.edit', compact(['transparencia', 'categoria','titulo']))
                : abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $transparencia = Transparencia::findOrFail($id);

        $campos = [
            'titulo' => 'required',
        ];
        //Comprobar si el usuario desea modificar el documento
        if (isset($request->modificar_doc) && $request->modificar_doc==true)
            $campos['documento'] = "required|mimes:pdf";

        // validar los campos
        $this->validate($request, $campos);
        $requestData = $request->all();
        if ($request->hasFile('documento')) {
            //Verificar si tiene un documento para eliminarlo
            $doc = $transparencia->documento;
            $path = public_path('storage').'/'.$doc;
            if(!is_null($doc) && !empty($doc)){
                if(File::exists($path)){
                    File::delete($path);
                }
            }
            $requestData['documento'] = $request->file('documento')->store('uploads/transparencia', 'public');
        }

        $transparencia->update($requestData);
        return redirect('admin/transparencia/' . $request->categoria)->with('flash_message', 'Documento modificado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }

    public function publicar($id, Request $request){
        $transparencia = Transparencia::findOrFail($id);
        $publicar = (isset($request->publicar)) ? 'publicado' : 'sin publicar';
        $transparencia->update([
            'publicar' => $publicar
        ]);
        $categoria = $transparencia->categoria;
        return redirect('admin/transparencia/' . $categoria)->with('flash_message', 'Documento modificado con éxito!');
    }


    public function file($id){
        $transparencia = Transparencia::findOrFail($id);
        $exist = false;
        $doc = $transparencia->documento;
        $path = public_path('storage') . '/' . $doc;
        if (!is_null($doc) && !empty($doc)) {
            if (File::exists($path)) {
                $exist = true;
                $path = asset('storage').'/'.$doc;
            }else{
                $path = false;
            }
        }

        return response()->json([
            'existe' => $exist,
            'path' => $path
        ]);

    }


}
