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

class LicenciasJefeRRHHController extends Controller
{
    public function isJefe(){
        return DB::table('permisos')->where('jefatura',auth()->user()->empleado)->exists();
    }

    public function indexJefe(){
        if(Auth::check() && ($this->isJefe() || @Auth::user()->hasRole('super-admin'))){

            $permisos = Permiso::selectRaw('
                    md5(permisos.id::text) as permiso, 
                    permisos.tipo_permiso, 
                    permisos.fecha_uso,
                    permisos.fecha_presentacion,
                    permisos.hora_inicio,
                    permisos.hora_final,
                    permisos.justificacion,
                    permisos.observaciones,
                    empleado.nombre,
                    empleado.apellido')
                ->join('empleado','empleado.id','=','permisos.empleado')
                ->where('jefatura',auth()->user()->empleado)
                ->where(
                    function($query){
                        $query->where('permisos.estado','like','Aceptado')
                        ->orWhere('permisos.estado','like','Enviado a Jefatura')
                        ->orWhere('permisos.estado','like','Enviado a RRHH');
                })->where('olvido',null)->get();
                
            return view('Licencias.LicenciaJefe',compact('permisos'));
        }else {
            return redirect()->route('index');
        }
    }

    public function indexRRHH(){
        if(Auth::check() and (@Auth::user()->hasRole('Recurso-Humano') or @Auth::user()->hasRole('super-admin'))){
            $permisos = Permiso::selectRaw('md5(permisos.id::text) as permiso, 
                tipo_permiso, fecha_uso,fecha_presentacion,hora_inicio,hora_final,justificacion,
                observaciones,olvido,empleado.nombre,empleado.apellido')
                ->join('empleado','empleado.id','=','permisos.empleado')
                ->where(function($query)
                    {$query->where('permisos.estado','like','Enviado a RRHH')->orWhere('permisos.estado','like','Aceptado');}
                )->get();
            return view('Licencias.LicenciaRRHH',compact('permisos'));
        }else {
            return redirect()->route('index');
        }
    }

    public function aceptarRRHH(Request $request){
        if (Auth::check() and (@Auth::user()->hasRole('Recurso-Humano') or @Auth::user()->hasRole('super-admin'))) {
            # code...        
            $permiso = Permiso::select('estado','id')->whereRaw('md5(id::text) = ?',[$request->_id])->first();
            $permiso -> estado = 'Aceptado';
            $permiso -> gestor_rrhh = auth()->user()->empleado;
            DB::update('update permiso_seguimiento set estado = false where estado = ? and permiso_id=?', [true,$permiso->id]);

            $seguimiento = new Permiso_seguimiento;
            $seguimiento -> permiso_id = $permiso->id;
            $seguimiento -> estado = true;
            $seguimiento -> proceso = 'Aceptado';
            $seguimiento -> save();

            $permiso->save();
            return redirect()->route('indexRRHH');
        }else {
            return redirect()->route('index');
        }
    }

    public function aceptarJefatura(Request $request){
        if (Auth::check() and ($this->isJefe() or @Auth::user()->hasRole('super-admin'))) {
            # code...        
            $permiso = Permiso::select('estado','id')->whereRaw('md5(id::text) = ?',[$request->_id])->first();
            $permiso -> estado = 'Enviado a RRHH';
            DB::update('update permiso_seguimiento set estado = false where estado = ? and permiso_id=?', [true,$permiso->id]);

            $seguimiento = new Permiso_seguimiento;
            $seguimiento -> permiso_id = $permiso->id;
            $seguimiento -> estado = false;
            $seguimiento -> proceso = 'Aceptado por Jefatura';
            $seguimiento -> save();
            
            $seguimiento = new Permiso_seguimiento;
            $seguimiento -> permiso_id = $permiso->id;
            $seguimiento -> estado = true;
            $seguimiento -> proceso = 'Enviado a RRHH';
            $seguimiento -> save();

            $permiso->save();
            return redirect()->route('indexJefatura');
        }else {
            return redirect()->route('index');
        }
    }

    //PARA LAS OBSERVACIONES DE CONSTANCIA
    public function observacionJefaturaConst(Request $request){
        if(Auth::check() and ($this->isJefe() or @Auth::user()->hasRole('super-admin'))){
            $validator = Validator::make($request->all(),[
                'observaciones_jefatura_constancia' => 'required|string|min:3',
            ]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }

            $permiso = Permiso::select('estado','id')->whereRaw('md5(id::text) = ?',[$request->_id])->first();
            $permiso -> estado = 'Observaciones de Jefatura';
            DB::update('update permiso_seguimiento set estado = false where estado = ? and permiso_id=?', [true,$permiso->id]);
            
            $seguimiento = new Permiso_seguimiento;
            $seguimiento -> permiso_id = $permiso->id;
            $seguimiento -> estado = true;
            $seguimiento -> observaciones = $request->observaciones_jefatura_constancia;
            $seguimiento -> proceso = 'Observaciones de Jefatura';
            $seguimiento -> save();

            $permiso->save();
            return $request->_id != null?
            response()->json(['mensaje'=>'Observacion Registrada']):
            response()->json(['error'=>'Error no se capturo id de permiso']);
        }else {
            return redirect()->route('index');
        }

    }
    //FIN DE LAS OBSERVACIONES DE CONSTANCIA

    public function observacionJefatura(Request $request){
        if(Auth::check() and ($this->isJefe() or @Auth::user()->hasRole('super-admin'))){
            $validator = Validator::make($request->all(),[
                'observaciones_jefatura' => 'required|string|min:3',
            ]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }

            $permiso = Permiso::select('estado','id')->whereRaw('md5(id::text) = ?',[$request->_id])->first();
            $permiso -> estado = 'Observaciones de Jefatura';
            DB::update('update permiso_seguimiento set estado = false where estado = ? and permiso_id=?', [true,$permiso->id]);
            
            $seguimiento = new Permiso_seguimiento;
            $seguimiento -> permiso_id = $permiso->id;
            $seguimiento -> estado = true;
            $seguimiento -> observaciones = $request->observaciones_jefatura;
            $seguimiento -> proceso = 'Observaciones de Jefatura';
            $seguimiento -> save();

            $permiso->save();
            return $request->_id != null?
            response()->json(['mensaje'=>'Observacion Registrada']):
            response()->json(['error'=>'Error no se capturo id de permiso']);
        }else {
            return redirect()->route('index');
        }

    }

    public function observacionRRHH(Request $request){
        if(Auth::check() and ($this->isJefe() or @Auth::user()->hasRole('super-admin') or @Auth::user()->hasRole('Recurso-Humano'))){
            $validator = Validator::make($request->all(),[
                'observaciones_recursos_humanos' => 'required|string|min:3',
            ]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }

            $permiso = Permiso::select('estado','id')->whereRaw('md5(id::text) = ?',[$request->_id])->first();
            $permiso -> estado = 'Observaciones de RRHH';
            DB::update('update permiso_seguimiento set estado = false where estado = ? and permiso_id=?', [true,$permiso->id]);
            
            $seguimiento = new Permiso_seguimiento;
            $seguimiento -> permiso_id = $permiso->id;
            $seguimiento -> estado = true;
            $seguimiento -> observaciones = $request->observaciones_recursos_humanos;
            $seguimiento -> proceso = 'Observaciones de RRHH';
            $seguimiento -> save();

            $permiso->save();
            return $request->_id != null?
            response()->json(['mensaje'=>'Observacion Registrada']):
            response()->json(['error'=>'Error no se capturo id de permiso']);
        }else {
            return redirect()->route('index');
        }

    }

    //PARA LAS OBSERVACIONES DE RRHH
    public function observacionRRHHconst(Request $request){
        if(Auth::check() and ($this->isJefe() or @Auth::user()->hasRole('super-admin') or @Auth::user()->hasRole('Recurso-Humano'))){
            $validator = Validator::make($request->all(),[
                'observaciones_recursos_humanos_constancia' => 'required|string|min:3',
            ]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }

            $permiso = Permiso::select('estado','id')->whereRaw('md5(id::text) = ?',[$request->_id])->first();
            $permiso -> estado = 'Observaciones de RRHH';
            DB::update('update permiso_seguimiento set estado = false where estado = ? and permiso_id=?', [true,$permiso->id]);
            
            $seguimiento = new Permiso_seguimiento;
            $seguimiento -> permiso_id = $permiso->id;
            $seguimiento -> estado = true;
            $seguimiento -> observaciones = $request->observaciones_recursos_humanos_constancia;
            $seguimiento -> proceso = 'Observaciones de RRHH';
            $seguimiento -> save();

            $permiso->save();
            return $request->_id != null?
            response()->json(['mensaje'=>'Observacion Registrada']):
            response()->json(['error'=>'Error no se capturo id de permiso']);
        }else {
            return redirect()->route('index');
        }

    }
    //FIN DE LAS OBSERVACIONES DE RRHH
    public function permiso($permiso){
        if(Auth::check() and !is_null($permiso) and ($this->isJefe() or @Auth::user()->hasRole('super-admin') or @Auth::user()->hasRole('Recurso-Humano') )){
            return Permiso::selectRaw('md5(permisos.id::text) as permiso, tipo_representante, tipo_permiso, fecha_uso,
                    fecha_presentacion,
                    olvido,
                    to_char(hora_inicio,\'HH24:MI\') as hora_inicio,
                    to_char(hora_final,\'HH24:MI\') as hora_final,
                    justificacion,
                    observaciones,
                    permisos.estado like \'Enviado a Jefatura\' as jf,
                    permisos.estado like \'Enviado a RRHH\' as rrhh,
                    nombre,
                    apellido'
            )->join('empleado','empleado.id','=','permisos.empleado')
            ->whereRaw('md5(permisos.id::text) = ?',[$permiso])
            ->first()->toJSON();  
        }else {
            return redirect()->route('index');
        }
    }

}