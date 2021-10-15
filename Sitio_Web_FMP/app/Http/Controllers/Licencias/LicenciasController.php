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
    protected function obtenerDia($fecha){
        $dias = array('Lunes','Martes','Miércoles','Jueves','Viernes','Sabado','Domingo');
        $dia = $dias[(date('N', strtotime($fecha))) - 1];
        return $dia;
    }

    public function indexMisLicencias(){
        if(is_null(auth()->user()->empleado))
        {
            return view('Licencias.LicenciaEmpleado');
        }
        else
        {
            $empleado = Empleado::findOrFail(auth()->user()->empleado);  
            $permisos = Permiso::where('empleado',auth()->user()->empleado)->get();     
            return view('Licencias.LicenciaEmpleado',compact('empleado','permisos'));
        }
    }

    //CODIGO PARA INSERTAR, MODIFICAR
    public function create(Request $request){
        try{

            $error = null;
            $query = DB::table('jornada')
                ->join('empleado','empleado.id','=','jornada.id_emp')
                ->join('periodos','periodos.id','=','jornada.id_periodo')
                ->where([['periodos.fecha_inicio','<=',$request->fecha_de_uso],
                    ['periodos.fecha_fin','>=',$request->fecha_de_uso],
                    ['jornada.estado','activo'],['periodos.estado','activo'],
                    ['empleado.estado',true],['empleado.id',auth()->user()->empleado]]);
            
            if(!$query->exists())
            {
                $error = 'Fecha de uso invalida fuera del rango registrado en su jornada';
            }else {

                $query = $query->join('jornada_items', 'jornada_items.id_jornada', '=','jornada.id' );

                if ($this->obtenerDia($request->fecha_de_uso)=='Domingo') 
                {
                    $error = 'El campo fecha de uso: No se puede registrar una licencia el Domingo';
                    
                }else if(!$query->where([
                    ['cast(jornada_items.hora_inicio as time)','<=',$request->hora_inicio],
                    ['cast(jornada_items.hora_fin as time)','=>',$request->hora_final],
                    ['dia','=',$this->obtenerDia($request->fecha_de_uso)]
                ])->exists()){
                    $error = 'El campo hora de inicio o fin fuera del rango registrados en su jornada';
                }
            }

            if (is_null($error)) {
                return response()->json(['error'=>[$error]]);
            }

            //echo dd($this->obtenerDia($request->fecha_de_uso));
            $validator = Validator::make($request->all(),[
                'tipo_de_permiso' => 'required',
                'fecha_de_presentación' => 'required',
                'fecha_de_uso' => 'required',
                'hora_inicio'  => 'required',
                'hora_final' => 'required',
                'justificación' => 'required',
            ]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }

            

            /*$p = $request->_id == null ? new Permiso():Permiso::findOrFail($request->_id);
            $p -> tipo_representante = $request-> representante;
            $p -> tipo_permiso = $request-> tipo_de_permiso;
            $p -> fecha_uso = $request-> fecha_de_uso;
            $p -> fecha_presentacion = $request-> fecha_de_presentación;
            $p -> hora_inicio = $request-> hora_inicio;
            $p -> hora_final = $request-> hora_final;
            $p -> justificacion = $request-> justificación;
            $p -> observaciones = $request-> observaciones;
            $p -> empleado = auth()->user()->empleado;
            $p -> estado = 'Procesando';
            $p ->save(); */        

            return $request->_id != null?
            response()->json(['mensaje'=>'Modificación exitosa']):
            response()->json(['mensaje'=>'Registro exitoso']);
        
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }//fin create

    //FIN DEL CODIGO PARA INSERTAR, MODIFICAR
}