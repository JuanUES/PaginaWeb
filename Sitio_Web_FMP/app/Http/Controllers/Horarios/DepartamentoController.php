<?php

namespace App\Http\Controllers\Horarios;

use App\Http\Controllers\Controller;
use App\Models\Horarios\Departamento;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepartamentoController extends Controller
{
    public function index(){

        $deptos = DB::table('departamentos')->get();
        return view('Admin.horarios.departamentos',compact('deptos'));
    }

    public function store(Request $request){
        try{

            $validator = Validator::make($request->all(),[
                'nombre_departamento' => 'required|max:255'
            ]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }

            $dep = $request->_id ==null ? new Departamento():Departamento::findOrFail($request->_id);
            $dep -> nombre_departamento   = $request->nombre_departamento; 
            $dep-> estado = true;  
            $dep -> save();         
        
            return $request->_id != null?response()->json(['mensaje'=>'Modificación exitosa.']):response()->json(['mensaje'=>'Registro exitoso.']);
        
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
    public function estado(Request $request)
    {
       //echo dd($request);

        $depto = Departamento::where('id',$request->E_depto)->first();
        $depto-> estado = $depto -> estado ? false:true;
        $depto -> save();        
        return redirect()->route('depto');
    }
    public function activarDepto(Request $request)
    {
       //echo dd($request);

        $depto = Departamento::where('id',$request->E_Activar)->first();
        $depto-> estado = $depto -> estado ? false:true;
        $depto -> save();        
        return redirect()->route('depto');
    }
}
