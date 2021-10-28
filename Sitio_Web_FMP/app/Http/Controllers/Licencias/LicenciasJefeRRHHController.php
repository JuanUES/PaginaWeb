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

            $permisos1 = DB::table('permisos')->selectRaw('md5(id::text) as permiso, tipo_representante, tipo_permiso, fecha_uso,
                fecha_presentacion,hora_inicio,hora_final,justificacion,observaciones,estado')
                ->where('jefe',auth()->user()->empleado)
                ->orWhere([
                    ['tipo_permiso','=','LC/GS'],['tipo_permiso','=','LS/GS'],['tipo_permiso','=','T COMP'],
                    ['tipo_permiso','=','INCAP'],['tipo_permiso','=','L OFICIAL'],['tipo_permiso','=','CITA MEDICA']]
                )->orderBy('fecha_presentacion')->get();

            $permisos = DB::union($permisos1)
                ->selectRaw('md5(id::text) as permiso, tipo_representante, tipo_permiso, fecha_uso,
                fecha_presentacion,hora_inicio,hora_final,justificacion,observaciones,estado')
                ->orWhere(
                    [['tipo_permiso','=','LC/GS'],['tipo_permiso','=','LS/GS'],['tipo_permiso','=','T COMP'],
                    ['tipo_permiso','=','INCAP'],['tipo_permiso','=','L OFICIAL'],['tipo_permiso','=','CITA MEDICA']]
                );

            return view('Licencias.LicenciaJefe',compat($permisos));
        }
    }
    public function indexRRHH(){
        if(Auth::check()){
            return view('Licencias.LicenciaRRHH');
        }
    }

}