<?php

namespace App\Http\Controllers\Horarios;

use App\Http\Controllers\Controller;
use App\Models\Horarios\Asig_admin;
use App\Models\Horarios\CargaAdmin;
use App\Models\Horarios\Ciclo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AsignacionCargaController extends Controller
{
    //
    public function index(){
        $empleados = DB::table('empleado')->get();
        $ciclos    = DB::table('ciclos')->where('estado',true)->get();
       // echo dd($ciclos);
        return view('Admin.horarios.asignarCarga',compact('empleados','ciclos'));
    }

    public function cargaCombobox($c){         
        return CargaAdmin::where('categoria',$c)
        ->select('*')->get()
        ->toJson();
    }

    
    //vamos a insertar los datos a la base de datos
    public function create(Request $request){
       // echo dd($request);
       try{//para verficar que mande algo del combo carga
       

        $validator = Validator::make($request->all(),[
            'A_carga'   =>'required'
        ]);         

        if($validator->fails())
        {            
            return response()->json(['error'=>$validator->errors()->all()]);                
        }

    ///************PARA INGRESAR CARGA ADMIN********* */
    if($request->A_carga=='ad'){
        try{

            $error = null;
            $validar = DB::table('asig_admins')
            ->select('*')
            ->where([['id_carga','=',$request->carga],
            ['id_ciclo','=',$request->id_ciclo]]);

            if($validar->exists())
            {
                $error = 'Carga Administrativa ya Asignada';
                return response()->json(['error'=>[$error]]);
            }


            $validator = Validator::make($request->all(),[
                'id_empleado'   =>'required',
                'carga'         =>'required',
                'id_ciclo'      =>'required',
                'dias'          =>'required'
            ]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }
          //echo dd($request);
            $asig = $request->_id ==null ? new Asig_admin():Asig_admin::findOrFail($request->_id);
            $asig -> id_empleado   = $request->id_empleado;
            $asig -> id_carga      = $request->carga;
            $asig -> id_ciclo      = $request->id_ciclo;
            $asig -> dias      = $request->dias;
            $asig -> save();         
        
            return $request->_id != null?response()->json(['mensaje'=>'Modificación exitosa.']):response()->json(['mensaje'=>'Registro exitoso.']);
        
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
    /***FIN PARA INGRESAR CARGA ADMIN */

    ///************PARA TRABAJO DE GRADO********* */
    if($request->A_carga=='tg'){
        try{

            $error = null;
            $validar = DB::table('asig_admins')
            ->select('*')
            ->where([['id_carga','=',$request->carga],
            ['id_ciclo','=',$request->id_ciclo]]);

            if($validar->exists())
            {
                $error = 'Carga Administrativa ya Asignada';
                return response()->json(['error'=>[$error]]);
            }


            $validator = Validator::make($request->all(),[
                'id_empleado'   =>'required',
                'carga'         =>'required',
                'id_ciclo'      =>'required',
                'dias'          =>'required'
            ]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }
          //echo dd($request);
            $asig = $request->_id ==null ? new Asig_admin():Asig_admin::findOrFail($request->_id);
            $asig -> id_empleado   = $request->id_empleado;
            $asig -> id_carga      = $request->carga;
            $asig -> id_ciclo      = $request->id_ciclo;
            $asig -> dias      = $request->dias;
            $asig -> save();         
        
            return $request->_id != null?response()->json(['mensaje'=>'Modificación exitosa.']):response()->json(['mensaje'=>'Registro exitoso.']);
        
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
    /***FIN PARA TRABAJO DE GRADO*******/

   }catch(Exception $e){
    return response()->json(['error'=>$e->getMessage()]);
    }


    }//fin create


    //fin de insertar los datos
}
