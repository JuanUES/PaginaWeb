<?php

namespace App\Http\Controllers\Pagina;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Pagina\Noticia;
use Illuminate\Http\Request;
use File;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $titulo)
    { 
        $idNoticia = base64_decode($id);
        $noticias  = Noticia::all();
        $noticia   = $noticias -> find($idNoticia);
        if($noticia != null and $noticia -> tipo){   
            return view('Inicio.Noticia', compact('noticia'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'imagen' => 'required',
        ]);         

        if($validator->fails())
        {            
            return response()->json(['error'=>$validator->errors()->all()]);                
        }

        $noticia = $request->_id == null ? new Noticia : Noticia:: findOrFail($request->_id);      
        
        /**Guardo en base de datos */
        $noticia -> titulo    =  $request->titulo;       
        $noticia -> tipo      =  'true'; 
        $noticia -> contenido =  $request->contenido;
        $noticia -> fuente    =  $request->fuente;        
        $noticia -> urlfuente =  $request->urlfuente;
        $noticia -> user      =  auth()->id();
        $noticia -> save();
        
        if($request->imagen=!null){
            $ruta = public_path().'\images\noticias';
            $nombreUnico = uniqid().$request->file('imagen')->getClientOriginalName();
            File::delete($ruta."/".$noticia->imagen);
            $request->file('imagen')->move($ruta,$nombreUnico);
            $noticia->imagen = $nombreUnico;
            $noticia->save();
        }else{
            $noticia->imagen = 'N/A';
            $noticia->save();
        }

        return $request->_id !=null ?response()->json(['mensaje'=>'Modificación exitosa.']):response()->json(['mensaje'=>'Registro exitoso.']);
    }

    public function storeurl(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'titulo' => 'required|max:255',
            'imagen' => 'required',
            'urlfuente' => 'required',
        ]);         

        if($validator->fails())
        {            
            return response()->json(['error'=>$validator->errors()->all()]);                
        }

        $noticia = $request->_id == null ? new Noticia : Noticia:: findOrFail($request->_id);
        
        /**Guardo en base de datos */
        
        $noticia -> titulo    =  $request->titulo;        
        $noticia -> subtitulo =  $request->subtitulo;    
        $noticia -> tipo      =  'false';  
        $noticia -> urlfuente =  $request->urlfuente;
        $noticia -> user      =  auth()->id();
        $noticia -> save();

        if($request->imagen=!null){
            $ruta = public_path().'\images\noticias';
            $nombreUnico = uniqid().$request->file('imagen')->getClientOriginalName();
            File::delete($ruta."/".$noticia->imagen);
            $request->file('imagen')->move($ruta,$nombreUnico);
            $noticia->imagen = $nombreUnico;
            $noticia->save();
        }else{
            $noticia->imagen = 'N/A';
            $noticia->save();
        }

        return $request->_id !=null ?response()->json(['mensaje'=>'Modificación exitosa.']):response()->json(['mensaje'=>'Registro exitoso.']);

    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        /**Elimino de la carpeta del servidor */
        if(Noticia::findOrFail(base64_decode($request->_id))->imagen !='sin_imagen')
        File::delete(public_path() . '/images/noticias/'.Noticia::findOrFail(base64_decode($request->_id))->imagen); 

        /**Elimino de la base de datos */
        $noticia = Noticia::destroy(base64_decode($request->_id));

        return redirect('/#noticias');
    }
}
