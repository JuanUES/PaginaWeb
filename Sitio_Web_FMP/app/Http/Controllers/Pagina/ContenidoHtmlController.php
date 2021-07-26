<?php

namespace App\Http\Controllers\Pagina;

use App\Http\Controllers\Controller;
use App\Models\Pagina\ContenidoHtml;
use Illuminate\Http\Request;

class ContenidoHtmlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contenidoArray = ContenidoHtml::where('id',$request->_id)->get();
        $contenido = count($contenidoArray) ? new ContenidoHtml : $contenidoArray[0];
        $contenido -> contenido = $request->contenido;
        $contenido -> save();
        return response()
        ->json( ['mensaje'=>count($contenidoArray) ?'Registro exitoso.':'Se modifico el registro']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pagina\ContenidoHtml  $contenidoHtml
     * @return \Illuminate\Http\Response
     */
    public function show(ContenidoHtml $contenidoHtml)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pagina\ContenidoHtml  $contenidoHtml
     * @return \Illuminate\Http\Response
     */
    public function edit(ContenidoHtml $contenidoHtml)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pagina\ContenidoHtml  $contenidoHtml
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContenidoHtml $contenidoHtml)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagina\ContenidoHtml  $contenidoHtml
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContenidoHtml $contenidoHtml)
    {
        //
    }
}
