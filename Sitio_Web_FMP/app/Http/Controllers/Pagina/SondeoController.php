<?php

namespace App\Http\Controllers\Pagina;

use App\Http\Controllers\Controller;
use App\Models\Pagina\Sondeo;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Validator;

class SondeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sondeos = Sondeo::all();
        return view('Academicos.investigacion',compact('sondeos'));
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
        //echo dd($request->imagen);
        $validator = Validator::make($request->all(),[
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'imagen' => 'required'
        ]);  

        if($validator->fails())
        {            
            return response()->json(['error'=>$validator->errors()->all()]);                
        }

        $sondeo = $request->_id!=null ? Sondeo::findOrFail($request->_id): new Sondeo;

        /**Guardo en carpeta Noticia */
        $file = $request->file('imagen'); 
        $path = public_path() . '/images/sondeos/';
        $fileName = $request->imagen->getClientOriginalName();
        
        /**Elimino de la carpeta del servidor si se realiza una modificacion*/
        if($request->_id != null && count($request->files)>0){
           
            File::delete(public_path() . '/images/sondeos/'.$sondeo->imagen); 
        
            /**Guardo en base de datos */   
            $sondeo -> imagen    =  $fileName;
            /**Guardo en servidor*/
            $file->move($path, $fileName);
        }else{
            $sondeo -> imagen = $sondeo -> imagen;
            $file->move($path, $fileName);
        }

        /**Guardo en la base de datos */
        $sondeo -> titulo = $request->titulo;
        if($request->imagen !=null){
            $sondeo -> imagen = $fileName;
        }
        $sondeo -> descripcion = $request->descripcion;
        $sondeo->user = auth()->id();   
        $sondeo -> save();

        return $request->_id != null?response()->json(['mensaje'=>'Modificación exitosa.']):response()->json(['mensaje'=>'Registro exitoso.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pagina\Sondeo  $sondeo
     * @return \Illuminate\Http\Response
     */
    public function show(Sondeo $sondeo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pagina\Sondeo  $sondeo
     * @return \Illuminate\Http\Response
     */
    public function edit(Sondeo $sondeo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pagina\Sondeo  $sondeo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sondeo $sondeo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagina\Sondeo  $sondeo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Sondeo::destroy($request->_id);
        File::delete(public_path() . '/images/sondeos/'.Sondeo::findOrFail($request->id)->imagen); 
    }
}
