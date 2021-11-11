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
    /**ESTADOS: 'Enviado a Jefatura' , 'GUARDADO' */

    protected function obtenerDia($fecha){
        $dias = array('Lunes','Martes','Miércoles','Jueves','Viernes','Sabado','Domingo');
        $dia = $dias[(date('N', strtotime($fecha))) - 1];
        return $dia;
    }

    public function indexMisLicencias(){
        if(is_null(auth()->user()->empleado))
        {
            return view('Licencias.LicenciaEmpleado');
        }else{

            $empleado = Empleado::findOrFail(auth()->user()->empleado);  
            $permisos = Permiso::selectRaw('md5(id::text) as permiso, tipo_representante, tipo_permiso, fecha_uso,
                fecha_presentacion,hora_inicio,hora_final,justificacion,observaciones,estado')
                ->where([['empleado','=',auth()->user()->empleado],['estado','!=','CANCELADO']])
                ->orWhere([
                    ['tipo_permiso','=','LC/GS'],
                    ['tipo_permiso','=','LS/GS'],
                    ['tipo_permiso','=','T COMP'],
                    ['tipo_permiso','=','INCAP'],
                    ['tipo_permiso','=','L OFICIAL'],
                    ['tipo_permiso','=','CITA MEDICA']])
                ->orderBy('fecha_presentacion')->get();     
            return view('Licencias.LicenciaEmpleado',compact('empleado','permisos'));
        }
    }

    public function getPermisos(){
        return $permisos = Permiso::selectRaw('md5(id::text) as permiso, tipo_representante, tipo_permiso, fecha_uso,
        fecha_presentacion,hora_inicio,hora_final,justificacion,observaciones,estado')
        ->where([['empleado','=',auth()->user()->empleado],['estado','!=','CANCELADO']])
        ->orWhere([
            ['tipo_permiso','=','LC/GS'],['tipo_permiso','=','LS/GS'],['tipo_permiso','=','T COMP'],
            ['tipo_permiso','=','INCAP'],['tipo_permiso','=','L OFICIAL'],['tipo_permiso','=','CITA MEDICA']])
        ->orderBy('fecha_presentacion')->get()->toJson();
    }

    //CODIGO PARA INSERTAR, MODIFICAR
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'tipo_de_permiso' => 'required|string',
                'fecha_de_uso' => 'required|date|date_format:Y-m-d',
                'hora_inicio'  => 'required', 
                'hora_final' => 'required|after:hora_inicio',
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
            
            if($request->tipo_de_permiso === 'LC/GS'|| $request->tipo_de_permiso === 'CITA MEDICA')
            {
                $horas_m = json_decode($this->horas_disponibles($request->fecha_de_uso,'mensual',null));
                $horas_a = json_decode($this->horas_disponibles($request->fecha_de_uso,'anual',null));

                $hora_inicio = new \DateTime($request->hora_inicio);
                $hora_final = new \DateTime($request->hora_final);
                $diferencia = $hora_inicio -> diff($hora_final);
                $total_minutos_m = (\intval($diferencia->format("%H"))*60)+\intval($diferencia->format("%i"))+
                                 (\intval($horas_m->horas_acumuladas)*60)+\intval($horas_m->minutos_acumulados);

                $total_minutos_a = (\intval($diferencia->format("%H"))*60)+\intval($diferencia->format("%i"))+
                                (\intval($horas_a->horas_acumuladas)*60)+\intval($horas_a->minutos_acumulados);
                
                if(\intval($total_minutos_m/60)>\intval($horas_m->mensuales)){
                    return response()->json(['error'=>['Las horas exceden el límite establecido Anual.']]); 
                }

                if(\intval($total_minutos_a/60)>\intval($horas_a->anuales)){
                    return response()->json(['error'=>['Las horas exceden el límite establecido mensual.']]); 
                }
            }
            
            $p = $request->_id == null ? new Permiso():Permiso::whereRaw('md5(id::text) = ?',[$request->_id])->first();
            $p -> tipo_representante = $request-> representante;
            $p -> tipo_permiso = $request-> tipo_de_permiso;
            $p -> fecha_uso = $request-> fecha_de_uso;
            if($request->_id == null) $p -> fecha_presentacion = $request-> fecha_de_presentación;
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

    protected function horas_disponibles($fecha,$tipo,$permiso){
        if(Auth::check() and !empty($fecha)){
            $query = Permiso::join ('empleado','empleado.id','=','permisos.empleado')
            ->join ('tipo_jornada','tipo_jornada.id','=','empleado.id_tipo_jornada')
            ->join ('licencia_con_goses','licencia_con_goses.id_tipo_jornada','=','tipo_jornada.id')
            ->where ('empleado.id','=',auth()->user()->empleado)
            ->orWhere([['permisos.tipo_permiso','=','CITA MEDICA'],['permisos.tipo_permiso','=','LC/GS']]);
            
            if ($permiso != 'nuevo') {
                # code...
                $query = $query -> whereRaw('md5(permisos.id::text) != ?',[$permiso]);
            }
            
            $queryEmp = Empleado::
               join ('tipo_jornada', 'tipo_jornada.id', '=', 'empleado.id_tipo_jornada')
            -> join ('licencia_con_goses', 'licencia_con_goses.id_tipo_jornada', '=' ,'tipo_jornada.id')
            -> where ('empleado.id',auth()->user()->empleado);

            if ($tipo==='anual') {
                # code...            
                $queryM = $query->whereRaw('to_char(permisos.fecha_uso, \'YY\') = to_char(\''.$fecha.'\'::date,\'YY\')')            
                ->groupBy('licencia_con_goses.anuales')
                ->selectRaw('sum(date_part(\'hour\', permisos.hora_final-permisos.hora_inicio)) as horas_acumuladas,
                    sum(date_part(\'minute\', permisos.hora_final-permisos.hora_inicio)) as minutos_acumulados, licencia_con_goses.anuales');

                if($queryM->exists()){
                    return $queryM->first()->toJson();
                }else {
                    # code...
                    return $queryEmp
                        ->selectRaw ('\'0\' as horas_acumuladas,\'0\' as minutos_acumulados, licencia_con_goses.anuales')
                        ->first()->toJson();
                }
            }else {
                # code...
                if ($tipo==='mensual') {
                    # code...
                    $queryM = $query->whereRaw('to_char(permisos.fecha_uso, \'MM\') = to_char(\''.$fecha.'\'::date,\'MM\')')            
                    ->groupBy('licencia_con_goses.mensuales')->selectRaw('sum(date_part(\'hour\', permisos.hora_final-permisos.hora_inicio)) as horas_acumuladas,
                    sum(date_part(\'minute\', permisos.hora_final-permisos.hora_inicio)) as minutos_acumulados, licencia_con_goses.mensuales::text');
                    
                    if($queryM->exists()){
                        return $queryM->first()->toJson();
                    }else{
                        return $queryEmp
                        ->selectRaw ('\'0\' as horas_acumuladas,\'0\' as minutos_acumulados, licencia_con_goses.mensuales::text')
                        ->first()->toJson();
                    }

                }else {                
                    return null;
                }
            }
        }else {
            return redirect()->route('index');
        }
    }

    public function horas_anual($fecha,$permiso){
        return $this -> horas_disponibles($fecha,'anual',$permiso);
    }
    
    public function horas_mensual($fecha,$permiso){
        return $this -> horas_disponibles($fecha,'mensual',$permiso);
    }

    public function permiso($permiso){
        if(Auth::check() and !is_null($permiso)){
            return Permiso::selectRaw('md5(id::text) as permiso, tipo_representante, tipo_permiso, fecha_uso,
                    fecha_presentacion,to_char(hora_inicio,\'HH24:MI\') as hora_inicio
                    ,to_char(hora_final,\'HH24:MI\') as hora_final,justificacion,observaciones,
                    estado = \'Observaciones de Jefatura\' or estado = \'Observaciones de RRHH\' or estado = \'Guardado\'  as estado')
            ->whereRaw('empleado = ? and md5(permisos.id::text) = ?',[auth()->user()->empleado, $permiso])
            ->first()->toJSON();
        }else {
            return redirect()->route('index');
        }
    }

    public function cancelar(Request $request){
        if(Auth::check() and isset($request)){
            Permiso::select('estado','id')
                ->whereRaw('md5(id::text) = ?',[$request->_id])
                ->first()
                ->delete();
            return redirect()->route('indexLic');
        }else {
            return redirect()->route('index');
        }
    }

    public function enviar(Request $request){
        if(isset($request->_id) and Auth::check()){
            //Jefe carga administrativa del empleado logueado
            $queryJC = Empleado::join('asig_admins','asig_admins.id_empleado','=','empleado.id')
                ->join('carga_admins','carga_admins.id','=','asig_admins.id_carga')
                ->where('empleado.id',auth()->user()->empleado);

            //Jefe inmediato del empleado logueado
            $queryJ = Empleado::where('id',auth()->user()->empleado)
                ->where('jefe','!=',null);

            //Obtengo el permiso de la base de datos
            $permiso = Permiso::select('estado','id')
                ->whereRaw('md5(id::text) = ?',[$request->_id])->first();

            //Si encuenta uno de los dos jefes seguir con el proceso            
            $jc = $queryJC -> select('id_jefe') -> first();
            $j = $queryJ -> select('jefe') -> first();

            $permiso -> jefatura = is_null($jc) ? (is_null($j) ? null: $j->jefe) : $jc->id_jefe;
            
            if($queryJC->exists() || $queryJ->exists()){
                 
                if ($permiso -> estado != 'Aceptado') {
                                                        
                    $enviado_jf = 'Enviado a Jefatura';
                    $observacion_jf = 'Observaciones de Jefatura';
                    $observacion_rrhh = 'Observaciones de RRHH';

                    $seguimiento = new Permiso_seguimiento;
                    $seguimiento -> permiso_id = $permiso->id;
                    $seguimiento -> estado = false;

                    if($permiso -> estado === 'Guardado'){
                        $permiso -> estado =  $enviado_jf;
                        $permiso -> fecha_presentacion = date('Y-m-d');
                        $seguimiento -> proceso =  $enviado_jf;
                    }else {

                        if($permiso -> estado == $observacion_rrhh ||
                         $permiso -> estado == $observacion_jf){
                            $permiso -> estado =  $enviado_jf;                            
                            $seguimiento -> proceso = $enviado_jf;
                        }                             
                    }
                    $permiso -> save();                
                    $seguimiento -> save();
                }
                
            }else{
                return response()->json(['error'=>'No tiene asignado un jefe']);
            }
            return response()->json(['mensaje'=>'Envio exitoso']);                       
        }else {
            return response()->json([500,'ERROR'=>['IDENTIFICADOR DESCONOCIDO','SESSION INVALIDA']]);
        }
    }

    public function procesos($permiso){
        if(isset($permiso) and Auth::check()){
            return Permiso_seguimiento::whereRaw('md5(permiso_id::text) = ?',[$permiso])
            ->select('estado','proceso','observaciones')
            ->selectRaw('to_char(created_at, \'DD/MM/YY - HH24:MI \') as fecha')
            ->get()->toJSON();
        }else{
            return redirect()->route('index');
        }
    }
}