<?php

namespace App\Http\Controllers\Licencias;

use App\Http\Controllers\Controller;
use App\Models\General\Empleado;
use App\Models\Licencias\Permiso;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Echo_;

class LicenciasAcuerdoController extends Controller
{
    public function index(){
        $empleados = Empleado::all();
        $empleado = Empleado::findOrFail(auth()->user()->empleado);  
        return view('Licencias.LicenciaAcuerdo',compact('empleados'));
    }

      //CODIGO PARA INSERTAR, MODIFICAR
      public function store(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'empleado'     => 'required',
                'tipo_de_permiso' => 'required|string',
                'fecha_de_inicio' => 'required|date|date_format:Y-m-d',
                'fecha_final' => 'required|date|date_format:Y-m-d',
                'justificación' => 'required|min:5|string',
            ]);         

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
            $p -> estado = 'GUARDADO';
            $p ->save();      

            return $request->_id != null?
            response()->json(['mensaje'=>'Modificación exitosa']):
            response()->json(['mensaje'=>'Registro exitoso']);
        
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }//fin create

    public function horas($f1,$f2,$id){
        $verificarRangos = DB::table('jornada')
        ->join('empleado','empleado.id','=','jornada.id_emp')
        ->join('periodos','periodos.id','=','jornada.id_periodo')
        ->where([['empleado.id','=',$id],['periodos.fecha_inicio','<=',$f1],
        ['periodos.fecha_fin','>=',$f2],['periodos.estado','=','activo'],['jornada.estado','=','activo']]);

        if(!$verificarRangos->exists())
            {
                return response()->json(['error'=>['El campo fecha de uso: No valida fuera del rango registrado en su jornada.']]);

            }else {
                return response()->json(['error'=>['JORNADA SI']]);
                //echo dd($verificarRangos);
            }

        
    }

}
