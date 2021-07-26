<?php

namespace App\Http\Controllers\Pagina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pagina\PDF;

class Academicos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAgro()
    {
        $pdfs = PDF::where('localizacion','ccAgro')->get();
        return view('Academicos.cienciasAgronomicas',compact('pdfs'));
    }

    public function indexEcono()
    {
        $pdfs = PDF::where('localizacion','ccEco')->get();
        return view('Academicos.cienciasEconomicas',compact('pdfs'));
    }

    public function indexEdu()
    {
        $pdfs = PDF::where('localizacion','ccEdu')->get();
        return view('Academicos.cienciasEducacion',compact('pdfs'));
    }

    public function indexInfor()
    {
        $pdfs = PDF::where('localizacion','info')->get();
        return view('Academicos.informatica',compact('pdfs'));
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
        //
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
