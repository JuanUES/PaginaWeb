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
    public function indexJefe(){
        if(Auth::check()){

            $permisos = Permiso::selectRaw('md5(permisos.id::text) as permiso, tipo_permiso, fecha_uso,fecha_presentacion,hora_inicio,hora_final,justificacion,observaciones,nombre,apellido')
                ->join('empleado','empleado.id','=','permisos.empleado')
                ->where([['jefatura',auth()->user()->empleado],['permisos.estado','=','ENVIADO A JEFATURA']])
                ->orWhere([
                    ['tipo_permiso','=','LC/GS'],['tipo_permiso','=','LS/GS'],['tipo_permiso','=','T COMP'],
                    ['tipo_permiso','=','INCAP'],['tipo_permiso','=','L OFICIAL'],['tipo_permiso','=','CITA MEDICA']]
                )->get();
            return view('Licencias.LicenciaJefe',compact('permisos'));
        }else {
            return redirect()->route('index');
        }
    }

    public function indexRRHH(){
        if(Auth::check()){
            return view('Licencias.LicenciaRRHH');
        }else {
            return redirect()->route('index');
        }
    }

    public function aceptarJefatura(Request $request){
        $permiso = Permiso::select('estado','id')->whereRaw('md5(id::text) = ?',[$request->_id])->first();
        $permiso -> estado = 'ENVIADO A RRHH';
        DB::update('update permiso_seguimiento set estado = false where estado = ? and permiso_id=?', [true,$permiso->id]);

        $seguimiento = new Permiso_seguimiento;
        $seguimiento -> permiso_id = $permiso->id;
        $seguimiento -> estado = false;
        $seguimiento -> proceso = 'ACEPTADO POR JEFATURA';
        $seguimiento -> save();
        
        $seguimiento = new Permiso_seguimiento;
        $seguimiento -> permiso_id = $permiso->id;
        $seguimiento -> estado = true;
        $seguimiento -> proceso = 'ENVIADO A RRHH';
        $seguimiento -> save();

        $permiso->save();
        return redirect()->route('indexJefatura');
    }

}