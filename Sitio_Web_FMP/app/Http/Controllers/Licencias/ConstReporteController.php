<?php

namespace App\Http\Controllers\Licencias;

use App\Http\Controllers\Controller;
use App\Models\Horarios\Departamento;
use App\Models\Licencias\Permiso;
use PDF;
use Illuminate\Http\Request;

class ConstReporteController extends Controller
{
    //TODAS LAS FUNCIONES PARA EL REPORTE CONSTANCIA DE OLVIDO
    public function indexConsResporte(){
        $deptos= Departamento::all();
       // echo dd($deptos);
        return view('Reportes.Constancias.MostrarConstancia',compact('deptos'));
    }
    //FIN DE FUNCIONES CONTANCIA DE OLVIDO


    public function index(){
        $data =  Permiso::selectRaw('md5(permisos.id::text) as identificador,permisos.empleado, CONCAT(empleado.nombre,\' \',empleado.apellido) e_nombre, to_char(permisos.fecha_uso, \'DD/MM/YYYY\') inicio,
        to_char(permisos.fecha_presentacion,\'DD/MM/YYYY\') fin, permisos.justificacion, permisos.tipo_permiso, permisos.hora_inicio,permisos.estado, permisos.fecha_presentacion, permisos.olvido,permisos.fecha_uso')
        ->join('empleado','empleado.id','=','permisos.empleado')
        ->where('empleado.id',auth()->user()->empleado)
        ->whereRaw('tipo_permiso=\'Const. olvido\'')
        ->get();
     // echo dd($data);
        return view('Licencias.ConstanciaReporte',compact('data'));
    }

    public function downloadPDF(){

        $data =  Permiso::selectRaw('md5(permisos.id::text) as identificador,permisos.empleado, CONCAT(empleado.nombre,\' \',empleado.apellido) e_nombre, to_char(permisos.fecha_uso, \'DD/MM/YYYY\') inicio,
        to_char(permisos.fecha_presentacion,\'DD/MM/YYYY\') fin, permisos.justificacion, permisos.tipo_permiso, permisos.hora_inicio,permisos.estado, permisos.fecha_presentacion, permisos.olvido,permisos.fecha_uso')
        ->join('empleado','empleado.id','=','permisos.empleado')
        ->where('empleado.id',auth()->user()->empleado)
        ->whereRaw('tipo_permiso=\'Const. olvido\'')
        ->get();

        $pdf= PDF::loadView('Licencias.ConstanciaReporte',compact('data'));
        return $pdf->download('Constancia.pdf');

    }
}
