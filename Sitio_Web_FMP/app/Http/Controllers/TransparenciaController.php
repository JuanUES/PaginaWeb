<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Transparencia;
use Illuminate\Support\Facades\Route;

class TransparenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoria = Route::currentRouteName();
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $items = Transparencia::where('estado', true)->where('categoria', $categoria)
                ->where('titulo', 'LIKE', "%$keyword%")
                ->orWhere('descripcion', 'LIKE', "%$keyword%")
                ->latest()
                ->paginate($perPage);
        } else {
            $items = Transparencia::where('estado', true)
                        ->where('categoria', $categoria)
                        ->latest()
                        ->paginate($perPage);
        }
        return view('Transparencia.index', compact(['items','categoria']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($categoria){
        return view('Transparencia.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        Transparencia::create($requestData);
        return redirect('admin/'.$request->categoria)->with('flash_message', 'Documento almacenado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $transparencia = Transparencia::findOrFail($id);
        return view('Transparencia.show', compact('transparencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $transparencia = Transparencia::findOrFail($id);
        $categoria = $transparencia->categoria;
        return view('Transparencia.edit', compact(['transparencia', 'categoria']));
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
        return redirect('admin/' . $request->categoria)->with('flash_message', 'Documento modificado con exito!');
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

    public function web($categoria){
        $documentos = Transparencia::where('estado', true)
            ->where('categoria', $categoria)
            ->get();
        return view('index-transparencia', compact('documentos'));
    }
}
