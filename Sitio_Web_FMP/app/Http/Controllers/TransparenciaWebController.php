<?php

namespace App\Http\Controllers;

use App\Models\Transparencia;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class TransparenciaWebController extends Controller{

    public $categorias = array(
        'Marco Normativo' => 'marco-normativo',
        'Marco de Gestión' => 'marco-gestion',
        'Marco Presupuestario' => 'marco-presupuestario',
        'Repositorios' => 'repositorios',
        'Documentos de Junta Directiva' => 'documentos-JD'
    );

    public $subcategorias = ['acuerdos', 'agendas', 'actas'];

    public function index(){
        $categorias = $this->categorias;
        $subcategorias = $this->subcategorias;
        return view('index-transparencia', compact(['categorias', 'subcategorias']));
    }

    public function categoria($categoria, Request $request){
        $titulo = array_search($categoria, $this->categorias, true);
        $subcategorias = $this->subcategorias;

        if($titulo!=false){
            $categorias = $this->categorias;
            $perPage = 5;
            $query = Transparencia::where('estado', 'activo')
                ->where('publicar', 'publicado')
                ->where('categoria', $categoria);

            $resultados = $query->count();
            $documentos = $query->latest()->paginate($perPage);
            return view('Transparencia-web.documentos', compact(['documentos', 'categoria', 'titulo', 'resultados', 'categorias', 'subcategorias']));
        } else {
            return abort(404);
        }
    }

    public function subcategoria($categoria, $subcategoria, Request $request){
        $titulo = array_search($categoria, $this->categorias, true);
        $subcategorias = $this->subcategorias;

        if($titulo!=false){
            $categorias = $this->categorias;
            $perPage = 5;
            $query = Transparencia::where('estado', 'activo')
                ->where('publicar', 'publicado')
                ->where('subcategoria', $subcategoria)
                ->where('categoria', $categoria);

            $resultados = $query->count();
            $documentos = $query->latest()->paginate($perPage);
            return view('Transparencia-web.documentos', compact(['documentos', 'subcategoria' , 'categoria', 'titulo', 'resultados', 'categorias', 'subcategorias']));
        } else {
            return abort(404);
        }
    }


    public function documento($categoria, $id){
        $titulo = array_search($categoria, $this->categorias, true);

        if($titulo!=false){
            $documento = Transparencia::findOrFail($id);
            $documentos = Transparencia::where('estado', 'activo')
                ->where('categoria', $categoria)
                ->where('id', '!=', $documento->id)
                ->take(10)
                ->latest()
                ->get();
            return view('Transparencia-web.documento', compact(['documentos', 'categoria', 'documento', 'titulo']));
        } else {
            return abort(404);
        }
    }

    public function download($id){
        $msg = 'Fallo al descargar el archivo, no se encontro...!';
        $registro = Transparencia::findOrFail($id);
        $headers = array('Content-Type: application/pdf');
        $name = strtolower(preg_replace('([^A-Za-z0-9])', '', $registro->titulo));
        $pdf = public_path('storage').'/'.$registro->documento;
        return (FacadesFile::exists($pdf))
            ? response()->download($pdf, $name, $headers)
            : back()->with(['mensaje'=>$msg, 'tipo'=>'warning']);
    }

    public function busqueda(Request $request){
        $categorias = $this->categorias;
        $subcategorias = $this->subcategorias;
        $categoria = $request->category;
        $subcategoria = $request->subcategory;
        $busqueda = $request->search;
        $start = $request->start;
        $end = $request->end;
        $perPage = 5;

        $query = Transparencia::where('estado', 'activo');

        //Filtrar por categoria
        if(!empty($categoria) && strcmp('categoria',strtolower($categoria))!==0)
            $query->where('categoria', $categoria);
        //Filtrar por subcategoria siempre y cuando sea categoria Documentos-JD
        if(!empty($subcategoria) && strcmp('sub categoria',strtolower($subcategoria))!==0 && strcmp('documentos-jd', strtolower($categoria)) == 0)
            $query->where('subcategoria', $subcategoria);

        //filtrar por cuadro de texto
        if (!empty($busqueda)){
            $query->where('titulo', 'LIKE', "%$busqueda%")
                ->orwhere('descripcion', 'LIKE', "%$busqueda%");
        }

        //Filtrar por rango de fechas
        if(!empty($start) && !empty($end))
            $query->WhereBetween('created_at', [$start, $end]);

        // dd($query->toSql());

        $resultados = $query->count();
        $documentos = $query->latest()->paginate($perPage);

        return view('Transparencia-web.busqueda', compact(['documentos', 'resultados', 'categoria', 'categorias', 'subcategoria', 'subcategorias', 'busqueda' ,'start', 'end']));
    }

    public function datatable($categoria, Request $request){
        if ($request->ajax()) {
            $data = Transparencia::where('estado', 'activo')
                ->where('publicar','publicado')
                ->where('categoria', $categoria)
                ->latest('created_at')
                ->get();
            return DataTables::of($data)
                ->addColumn('action', 'Transparencia-web.dataTable.download')
                ->addColumn('titulo', 'Transparencia-web.dataTable.link')
                ->addColumn('descripcion', 'Transparencia-web.dataTable.description')
                ->editColumn('created_at', function ($data_rem) {
                    return date('d/m/Y h:i:s a', strtotime($data_rem->created_at));
                })
                ->rawColumns(['action','titulo', 'descripcion'])
                ->make(true);
        }
    }
}
