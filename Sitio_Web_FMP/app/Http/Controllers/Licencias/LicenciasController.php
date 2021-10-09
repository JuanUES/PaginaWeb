<?php

namespace App\Http\Controllers\Licencias;
use App\Models\General\Empleado;
use App\Models\Licencias\Permiso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class LicenciasController extends Controller
{

    public function indexMisLicencias(){
        if(is_null(auth()->user()->empleado))
        {
            return view('Licencias.LicenciaEmpleado');
        }
        else
        {
            $empleado = Empleado::findOrFail(auth()->user()->empleado);       
            return view('Licencias.LicenciaEmpleado',compact('empleado'));
        }
    }

    //CODIGO PARA INSERTAR, MODIFICAR
    public function create(Request $request){
        try{
           
            $validator = Validator::make($request->all(),[
                'tipo_representante'  => 'required',
                'tipo_permiso' => 'required',
                'fecha_de_presentación' => 'required',
                'hora_inicio'  => 'required',
                'hora_final' => 'required',
                'justificación' => 'required',
                'observaciones' =>'required',
            ]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }

            $gs = $request->_id ==null ? new Permiso():Permiso::findOrFail($request->_id);
            $gs -> save();         
        
            return $request->_id != null?
            response()->json(['mensaje'=>'Modificación exitosa']):
            response()->json(['mensaje'=>'Registro exitoso']);
        
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }//fin create

    //FIN DEL CODIGO PARA INSERTAR, MODIFICAR
}