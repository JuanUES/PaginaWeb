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
        if(Auth::check() and $this->isJefe()){

            $permisos = Permiso::selectRaw('md5(permisos.id::text) as permiso, tipo_permiso, fecha_uso,fecha_presentacion,hora_inicio,hora_final,justificacion,
                observaciones,empleado.nombre,empleado.apellido')
                ->join('empleado','empleado.id','=','permisos.empleado')
                ->where([
                    ['jefatura',auth()->user()->empleado],
                    ['permisos.estado','=','Enviado a Jefatura']]
                )->orWhere([
                    ['tipo_permiso','=','LC/GS'],
                    ['tipo_permiso','=','LS/GS'],
                    ['tipo_permiso','=','T COMP'],
                    ['tipo_permiso','=','INCAP'],
                    ['tipo_permiso','=','L OFICIAL'],
                    ['tipo_permiso','=','CITA MEDICA']]
                )->get();
            return view('Licencias.LicenciaJefe',compact('permisos'));
        }else {
            return redirect()->route('index');
        }
    }

    public function indexRRHH(){
        if(Auth::check() and $this->isJefe()){
            return view('Licencias.LicenciaRRHH');
        }else {
            return redirect()->route('index');
        }
    }

    public function aceptarJefatura(Request $request){
        if (Auth::check() and $this->isJefe()) {
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

    public function observacionJefatura(Request $request){
        if(Auth::check() and $this->isJefe()){
            $validator = Validator::make($request->all(),[
                'observaciones_jefatura' => 'required|string|min:3',
            ]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }

            $permiso = Permiso::select('estado','id')->whereRaw('md5(id::text) = ?',[$request->_id])->first();
            $permiso -> estado = 'Observación de Jefatura';
            DB::update('update permiso_seguimiento set estado = false where estado = ? and permiso_id=?', [true,$permiso->id]);
            
            $seguimiento = new Permiso_seguimiento;
            $seguimiento -> permiso_id = $permiso->id;
            $seguimiento -> estado = true;
            $seguimiento -> observaciones = $request->observaciones_jefatura;
            $seguimiento -> proceso = 'Observación de Jefatura';
            $seguimiento -> save();

            $permiso->save();
            return $request->_id != null?
            response()->json(['mensaje'=>'Observacion Registrada']):
            response()->json(['error'=>'Error no se capturo id de permiso']);
        }else {
            return redirect()->route('index');
        }

    }

    public function permiso($permiso){
        if(Auth::check() and !is_null($permiso) and $this->isJefe()){
            return Permiso::selectRaw('md5(permisos.id::text) as permiso, tipo_representante, tipo_permiso, fecha_uso,
                    fecha_presentacion,to_char(hora_inicio,\'HH24:MI\') as hora_inicio
                    ,to_char(hora_final,\'HH24:MI\') as hora_final,justificacion,observaciones,permisos.estado,nombre,apellido')
            ->join('empleado','empleado.id','=','permisos.empleado')
            ->whereRaw('md5(permisos.id::text) = ?',[$permiso])
            ->first()->toJSON();  
        }else {
            return redirect()->route('index');
        }
    }

}