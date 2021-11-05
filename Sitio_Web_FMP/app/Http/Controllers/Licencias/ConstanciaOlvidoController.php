<?php

namespace App\Http\Controllers\Licencias;

use App\Http\Controllers\Controller;
use App\Models\General\Empleado;
use App\Models\Licencias\Permiso;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ConstanciaOlvidoController extends Controller
{
    public function index(){
        
        $logueado= Empleado::findOrFail(auth()->user()->empleado);
        return view('Licencias.ConstanciaOlvido', compact('logueado'));
    }

    protected function obtenerDia($fecha){
        $dias = array('Lunes','Martes','Miércoles','Jueves','Viernes','Sabado','Domingo');
        $dia = $dias[(date('N', strtotime($fecha))) - 1];
        return $dia;
    }

    public function SalidaEntrada($fecha){
            $query = DB::table('empleado')
            ->join('jornada','empleado.id','=','jornada.id_emp')
            ->join('jornada_items','jornada_items.id_jornada','=','jornada.id')
            ->where([['empleado.estado',true],
                    ['empleado.id',auth()->user()->empleado],
                    ['jornada_items.dia', $this->obtenerDia($fecha)]]);

            return $query->get()->toJson();
    }//onChange modal

       //CODIGO PARA INSERTAR, MODIFICAR
       public function store(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'fecha' => 'required|date|date_format:Y-m-d',
                'hora' => 'required',
                'justificación' => 'required|min:5|string',
            ]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }

            $p = $request->_id == null ? new Permiso():Permiso::findOrFail($request->_id);
            $p -> tipo_permiso = 'Const. olvido';
            $p -> fecha_uso = $request-> fecha;//fecha_uso ocupo para la fecha que se le olvido marcar
            $p -> fecha_presentacion = $request->fecha;//esta fecha va en ese formato porq para esta constancia solo se ocupa una fecha
            $p -> hora_inicio = $request->hora;//la hora que se olvido marcar ya se de entrada o salida
            $p -> hora_final = '00:00:00';//va en este formato por que para estas constancia solo se ocupa una fecha
            $p -> justificacion = $request-> justificación;
            $p -> empleado = $p -> empleado = auth()->user()->empleado;
            $p -> estado = 'Guardado';
            $p ->save();      

            return $request->_id != null?
            response()->json(['mensaje'=>'Modificación exitosa']):
            response()->json(['mensaje'=>'Registro exitoso']);
        
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }//fin create

    public function Table(){
        $data =  Permiso::selectRaw('permisos.id,permisos.empleado, CONCAT(empleado.nombre,\' \',empleado.apellido) e_nombre, to_char(permisos.fecha_uso, \'DD/MM/YYYY\') inicio,
        to_char(permisos.fecha_presentacion,\'DD/MM/YYYY\') fin, permisos.justificacion, permisos.tipo_permiso, permisos.hora_inicio,permisos.estado')
        ->join('empleado','empleado.id','=','permisos.empleado')
        ->where('empleado.id',auth()->user()->empleado)
        ->whereRaw('tipo_permiso=\'Const. olvido\'')
        ->get()->toJson();
        return $data;
        //echo dd($data);
    }//para mostrar en la tabla

}
