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
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'tipo_de_permiso' => 'required|string',
                'fecha_de_uso' => 'required|date|date_format:Y-m-d',
                'hora_inicio'  => 'required|date_format:H:i',
                'hora_final' => 'required|date_format:H:i|after:hora_inicio',
                'justificación' => 'required|min:5|string',
                'observaciones' => 'min:5|string',
            ],['hora_final.after'=>'Hora final debe ser una hora posterior a hora inicio.',]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }

            $query = DB::table('jornada')
                ->join('empleado','empleado.id','=','jornada.id_emp')
                ->where('empleado.estado',true)
                ->where('empleado.id',auth()->user()->empleado);

            if(!$query->exists()){
                return response()->json(['error'=>['Error: No existe jornada asignada para este empleado']]);
            }

            $query->join('periodos','periodos.id','=','jornada.id_periodo')
            ->where([
                ['periodos.fecha_inicio','<=',$request->fecha_de_uso],
                ['periodos.fecha_fin','>=',$request->fecha_de_uso],
                ['jornada.estado','activo'],['periodos.estado','activo']]
            );
            
            if(!$query->exists())
            {
                return response()->json(['error'=>['El campo fecha de uso: No valida fuera del rango registrado en su jornada']]);

            }else {
                $query = $query->join('jornada_items', 'jornada_items.id_jornada', '=','jornada.id' );
                if ($this->obtenerDia($request->fecha_de_uso)=='Domingo') 
                {
                    return response()->json(['error'=>['El campo fecha de uso: No puede registrar una licencia Domingo']]);
                }else if(!$query->where('jornada_items.dia',$this->obtenerDia($request->fecha_de_uso))
                        ->exists()){               
                    return response()->json(['error'=>['El campo fecha de uso: No tiene horarios para el dia '.$this->obtenerDia($request->fecha_de_uso)]]);
                }else if(!$query->where([['hora_inicio','<=',$request->hora_inicio],['hora_fin','>=',$request->hora_inicio]])->exists()){
                    return response()->json(['error'=>['Campo hora inicio esta fuera del rango registrado en su horario']]); 
                }else if(!$query->where([['hora_inicio','<=',$request->hora_final],['hora_fin','>=',$request->hora_final]])->exists()){
                    return response()->json(['error'=>['Campo hora final esta fuera del rango registrado en su horario']]); 
                }                
            }

            $query = DB::table('empleado')->join('tipo_jornada','tipo_jornada.id','=','empleado.id_tipo_jornada')
                        ->join('licencia_con_gose','licencia_con_gose.id_tipo_jornada','=','tipo_jornada.id')
                        ->where('empleado.id',auth()->user()->empleado)->select('mensuales')->first();
            
           // $query->
            $p = $request->_id == null ? new Permiso():Permiso::findOrFail($request->_id);
            $p -> tipo_representante = $request-> representante;
            $p -> tipo_permiso = $request-> tipo_de_permiso;
            $p -> fecha_uso = $request-> fecha_de_uso;
            $p -> fecha_presentacion = $request-> fecha_de_presentación;
            $p -> hora_inicio = $request-> hora_inicio;
            $p -> hora_final = $request-> hora_final;
            $p -> justificacion = $request-> justificación;
            $p -> observaciones = $request-> observaciones;
            $p -> empleado = auth()->user()->empleado;
            $p -> estado = 'Guardado';
            $p ->save();      

            return $request->_id != null?
            response()->json(['mensaje'=>'Modificación exitosa']):
            response()->json(['mensaje'=>'Registro exitoso']);
        
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }//fin create

    public function horas_disponibles(){
        if(is_null(auth()->user()->empleado))
        {return DB::table('tipo_jornada')
            ->join;}
    }

    //FIN DEL CODIGO PARA INSERTAR, MODIFICAR
}