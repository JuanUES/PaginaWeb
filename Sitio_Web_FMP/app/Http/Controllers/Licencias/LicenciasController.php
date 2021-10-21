<?php

namespace App\Http\Controllers\Licencias;
use App\Models\General\Empleado;
use App\Models\Licencias\Permiso;
use App\Models\Licencias\Permiso_seguimiento;
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
            $permisos = Permiso::selectRaw('md5(id::text) as permiso, tipo_representante, tipo_permiso, fecha_uso,
                fecha_presentacion,hora_inicio,hora_final,justificacion,observaciones,estado')
            ->where('empleado',auth()->user()->empleado)->orderBy('fecha_presentacion')->get();     
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
                return response()->json(['error'=>['Error: No existe jornada asignada para este empleado.']]);
            }

            $query->join('periodos','periodos.id','=','jornada.id_periodo')
            ->where([
                ['periodos.fecha_inicio','<=',$request->fecha_de_uso],
                ['periodos.fecha_fin','>=',$request->fecha_de_uso],
                ['jornada.estado','activo'],['periodos.estado','activo']]
            );
            
            if(!$query->exists())
            {
                return response()->json(['error'=>['El campo fecha de uso: No valida fuera del rango registrado en su jornada.']]);

            }else {
                $query = $query->join('jornada_items', 'jornada_items.id_jornada', '=','jornada.id' );
                /*if ($this->obtenerDia($request->fecha_de_uso)=='Domingo') //Validacion por dia
                {
                    return response()->json(['error'=>['El campo fecha de uso: No puede registrar una licencia Domingo']]);
                }else*/if(!$query->where('jornada_items.dia',$this->obtenerDia($request->fecha_de_uso))
                        ->exists()){               
                    return response()->json(['error'=>['El campo fecha de uso: No tiene horarios para el dia.'.$this->obtenerDia($request->fecha_de_uso)]]);
                }else if(!$query->where([['hora_inicio','<=',$request->hora_inicio],['hora_fin','>=',$request->hora_inicio]])->exists()){
                    return response()->json(['error'=>['Campo hora inicio esta fuera del rango registrado en su horario.']]); 
                }else if(!$query->where([['hora_inicio','<=',$request->hora_final],['hora_fin','>=',$request->hora_final]])->exists()){
                    return response()->json(['error'=>['Campo hora final esta fuera del rango registrado en su horario.']]); 
                }                
            }
            
            if($request->tipo_de_permiso == 'LC-GS')
            {
                $horas = json_decode($this->horas_disponibles($request->fecha_de_uso));
                $hora_inicio = new \DateTime($request->hora_inicio);
                $hora_final = new \DateTime($request->hora_final);
                $diferencia = $hora_inicio -> diff($hora_final);
                $total_minutos = (\intval($diferencia->format("%H"))*60)+\intval($diferencia->format("%i"))+
                                 (\intval($horas->horas_acumuladas)*60)+\intval($horas->minutos_acumulados);

                if(\intval($total_minutos/60)>\intval($horas->mensuales)){
                    return response()->json(['error'=>['Las horas exceden el límite establecido mensual.']]); 
                }
            }
            
            $p = $request->_id == null ? new Permiso():Permiso::whereRaw('md5(id::text) = ?'[$request->_id])->first();
            $p -> tipo_representante = $request-> representante;
            $p -> tipo_permiso = $request-> tipo_de_permiso;
            $p -> fecha_uso = $request-> fecha_de_uso;
            if($request->_id == null) $p -> fecha_presentacion = $request-> fecha_de_presentación;
            $p -> hora_inicio = $request-> hora_inicio;
            $p -> hora_final = $request-> hora_final;
            $p -> justificacion = $request-> justificación;
            $p -> observaciones = $request-> observaciones;
            $p -> empleado = auth()->user()->empleado;
            $p -> estado = 'GUARDADO';
            $p ->save();      

            return $request->_id != null?
            response()->json(['mensaje'=>'Modificación exitosa']):
            response()->json(['mensaje'=>'Registro exitoso']);
        
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }//fin create

    public function horas_disponibles($fecha){
        if(Auth::check() and !empty($fecha)){
            $horas = Permiso::selectRaw('sum(date_part(\'hour\', permisos.hora_final-permisos.hora_inicio)) as horas_acumuladas,
                sum(date_part(\'minute\', permisos.hora_final-permisos.hora_inicio)) as minutos_acumulados,mensuales')
                ->join('empleado', 'empleado.id','=','permisos.empleado')
                ->join('tipo_jornada', 'tipo_jornada.id','=','empleado.id_tipo_jornada')
                ->join('licencia_con_goses','licencia_con_goses.id_tipo_jornada','=','tipo_jornada.id')
                ->whereRaw('empleado.id=? and permisos.tipo_permiso=\'LC/GS\' and to_char(permisos.fecha_uso, \'MM\')=to_char(\''.$fecha.'\'::date, \'MM\')',
                    [auth()->user()->empleado])
                ->groupBy('mensuales')->first();

            if(is_null($horas)){
                return Empleado::selectRaw('0 as horas_acumuladas,0 as  minutos_acumulados,mensuales')
                    ->join('tipo_jornada', 'tipo_jornada.id','=','empleado.id_tipo_jornada')
                    ->join('licencia_con_goses','licencia_con_goses.id_tipo_jornada','=','tipo_jornada.id')
                    ->whereRaw('empleado.id=?',[auth()->user()->empleado])->first()->toJSON();
            }else{
                return $horas->toJSON();
            }
        }
        
    }

    public function permiso($permiso){
        if(Auth::check() and !is_null($permiso)){
            return Permiso::selectRaw('md5(id::text) as permiso, tipo_representante, tipo_permiso, fecha_uso,
                    fecha_presentacion,hora_inicio,hora_final,justificacion,observaciones,estado')
            ->whereRaw('empleado = ? and md5(permisos.id::text) = ?',[auth()->user()->empleado, $permiso])
            ->first()->toJSON();  
        }
    }

    public function cancelar(Request $request){
        if(Auth::check() and isset($request)){
            $p = Permiso::select('estado','id')->whereRaw('md5(id::text) = \''.$request->_id.'\'')->first();
            $p -> estado = 'CANCELADO';
            $p -> save();
            return redirect()->route('indexLic');
        }
    }

    public function enviar(Request $request){
        if(isset($request) and Auth::check()){
            $seguimiento = new Permiso_seguimiento;
            $seguimiento -> permiso_id = $request->permiso;
            $seguimiento -> observaciones = 'Enviado a revisión Jefatura';
            $seguimiento -> estado = true;
            $exito = $seguimiento -> save();

            if($exito){
                $permiso = Permiso::findOrFail($request->permiso);
                $permiso -> estado = 'ENVIADO A JEFATURA';
                $permiso -> save();                
            }
            
            return redirect()->route('indexLic');
        }
    }
}