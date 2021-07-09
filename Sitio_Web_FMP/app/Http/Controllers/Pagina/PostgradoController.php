<?php

namespace App\Http\Controllers\Pagina;

use App\Http\Controllers\Controller;
use App\Models\Pagina\Maestria;
use Illuminate\Http\Request;

class PostgradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Academicos.postgrado');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pagina\Maestria  $maestria
     * @return \Illuminate\Http\Response
     */
    public function show(Maestria $maestria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pagina\Maestria  $maestria
     * @return \Illuminate\Http\Response
     */
    public function edit(Maestria $maestria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pagina\Maestria  $maestria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maestria $maestria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagina\Maestria  $maestria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maestria $maestria)
    {
        //
    }
}
