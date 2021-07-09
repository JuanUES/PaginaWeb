<?php

namespace App\Http\Controllers;

use App\Models\Transparencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransparenciaWebController extends Controller
{
    public function web($categoria)
    {
        $documentos = Transparencia::where('estado', true)
            ->where('categoria', $categoria)
            ->paginate(2);
        return view('Transparencia-web.documentos', compact(['documentos', 'categoria']));
    }

    public function resultados()
    {
        return view('Transparencia-web.busqueda');
    }

    public function documento($categoria, $id)
    {
        $documentos = Transparencia::where('estado', true)
            ->where('categoria', $categoria)
            ->get();

        $documento = Transparencia::findOrFail($id);

        return view('Transparencia-web.documento', compact(['documentos', 'categoria', 'documento']));
    }

    public function dowload_Storage($file)
    {
        $dl = File::find($file);
        return Storage::download($dl->documento, $dl->titulo);
        //return response()->download(public_path('assets/'.$file));

        /*if(Storage::disk('public')->path("/uploads/transparencia/$request->documento")){
            $path = Storage::disk('public')->path("asset('storage').'/'.$request->documento");
            $content = file_get_contents($path);
            return response($content)->witHeaders([
                'Content-Type'=>mime_content_type($path)
            ]);
        }
        return redirect('/404');*/
    }

    public function busqueda(Request $request)
    {
        $categoria = $request->get('category');
        $keyword = $request->get('search');
        $fechaStart = strftime("%Y-%m-%d", strtotime($request->get('start')));
        $fechaEnd = strftime("%Y-%m-%d", strtotime($request->get('end')));
        $perPage = 10;

        if (!empty($keyword) || !empty($categoria) || !empty($fechaStart) || !empty($fechaEnd)) {
            $items = Transparencia::where('estado', true)
                ->where('categoria', $categoria)
                ->orWhere('titulo', 'LIKE', "%$keyword%")
                ->orWhere('descripcion', 'LIKE', "%$keyword%")
                ->orWhereBetween('created_at', [$fechaStart, $fechaEnd])
                ->latest()
                ->paginate($perPage);
        }
        return view('Transparencia-web.busqueda', compact(['items']));
    }
}
