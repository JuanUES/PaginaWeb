<?php

namespace App\Http\Controllers\Horarios;

use App\Http\Controllers\Controller;
use App\Models\Horarios\Asig_admin;
use App\Models\Horarios\CargaAdmin;
use App\Models\Horarios\Ciclo;
use App\Models\Horarios\Proyectosociale;
use App\Models\Horarios\Trabajogrado;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AsignacionCargaController extends Controller
{
    //
    public function index(){
        $empleados = DB::table('empleado')->where('tipo_empleado','Académico')->get();
        $ciclos    = DB::table('ciclos')->where('estado','activo')->get();
        //solo para mostrar la carga admin
       /* $tablaA = DB::table('empleado')
        ->join('asig_admins', 'asig_admins.id_empleado', '=', 'empleado.id')
        ->join('ciclos', 'ciclos.id', '=', 'asig_admins.id_ciclo')
        ->join('carga_admins', 'carga_admins.id', '=', 'asig_admins.id_carga')
        ->select('empleado.id','empleado.nombre as E_nombre','empleado.apellido','asig_admins.dias','carga_admins.nombre_carga','ciclos.nombre','ciclos.año')
        ->where('ciclos.estado',true)
        ->get();*/

       //echo dd($empleados);
        return view('Admin.horarios.asignarCarga',compact('empleados','ciclos'));
    }

    public function cargaCombobox(){         
        return CargaAdmin::select('*')->get()
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

   }catch(Exception $e){
    return response()->json(['error'=>$e->getMessage()]);
    }


    }//fin create


    //fin de insertar los datos
}
