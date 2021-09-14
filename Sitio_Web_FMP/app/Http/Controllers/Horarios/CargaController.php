<?php

namespace App\Http\Controllers\Horarios;

use App\Http\Controllers\Controller;
use App\Models\Horarios\CargaAdmin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CargaController extends Controller
{
    public function index(){
        $carga = DB::table('carga_admins')->get();
        $empleados = DB::table('empleado')->get();
      //  echo dd($empleados);
        return view('Admin.horarios.carga',compact('carga','empleados'));
    }

    public function create(Request $request){
        try{

            $validator = Validator::make($request->all(),[
                'nombre_carga'      => 'required|max:255|unique:carga_admins,nombre_carga',
                'categoria'         =>'required'
            ]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }

            $carga = $request->_id ==null ? new CargaAdmin():CargaAdmin::findOrFail($request->_id);
            $carga -> nombre_carga   = $request->nombre_carga;
            $carga -> save();         
        
            return $request->_id != null?response()->json(['mensaje'=>'Modificación exitosa.']):response()->json(['mensaje'=>'Registro exitoso.']);
        
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }//fin create

    public function estado(Request $request){
        $carga = CargaAdmin::findOrFail($request->_id);
        $carga -> estado = !$carga -> estado;
        $estado = $carga -> save();
        if ($estado) {
            return response()->json(['mensaje'=>'Modificacion exitosa']);
        }else{
            return response()->json(['error'=>'Error']);
        }
    }
}
