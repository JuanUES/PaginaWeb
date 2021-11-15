<?php

namespace App\Http\Controllers\Licencias;

use App\Http\Controllers\Controller;
use App\Models\General\Empleado;
use App\Models\Horarios\Departamento;
use App\Models\Licencias\Permiso;
use PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConstReporteController extends Controller
{
    //TODAS LAS FUNCIONES PARA EL REPORTE CONSTANCIA DE OLVIDO
    public function indexConsResporte(){
        $permisos = Empleado::selectRaw(' permisos.id, nombre, apellido, permisos.tipo_permiso,permisos.fecha_presentacion,
        permisos.hora_inicio,permisos.hora_final, permisos.justificacion, permisos.updated_at, departamentos.nombre_departamento')
        ->join('departamentos','departamentos.id','=','empleado.id_depto')
        ->join('permisos','permisos.empleado','=','empleado.id')
        ->where([
            ['permisos.estado','=','Aceptado'],
            ['permisos.fecha_presentacion','>=','2021-11-01'],
            ['permisos.fecha_presentacion','<=','2021-11-30']]
        )->get();

        //echo dd($permisos);
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
    //PARA DIBUJAR LAS LA TABLA
    public function mostrarTabla($fecha1,$fecha2,$dep){


        
        $permisoss = Empleado::selectRaw(' permisos.id, nombre, apellido, permisos.tipo_permiso,permisos.fecha_presentacion,
        permisos.hora_inicio,permisos.hora_final, permisos.justificacion, permisos.updated_at, departamentos.nombre_departamento')
        ->join('departamentos','departamentos.id','=','empleado.id_depto')
        ->join('permisos','permisos.empleado','=','empleado.id');

        if($dep=='all'){
            $permisos=$permisoss->where([
                ['permisos.estado','=','Aceptado'],
                ['permisos.fecha_presentacion','>=',$fecha1],
                ['permisos.fecha_presentacion','<=',$fecha2]]
            )->get();
            
        }else{
           $permisos= $permisoss->where([
                ['permisos.estado','=','Aceptado'],
                ['permisos.fecha_presentacion','>=',$fecha1],
                ['permisos.fecha_presentacion','<=',$fecha2],
                ['departamentos.id','=',$dep]]
            )->get();
        }
       // echo dd($permisos);
        
        foreach ($permisos as $item) {
            # code...
            $data[] = array(
                "row0" => $item->nombre.' '.$item->apellido,
                "row1" => '<span class="badge badge-primary font-13">'.$item->tipo_permiso.'</span>',
                "row2" => Carbon::parse($item->fecha_presentacion)->format('d/m/Y'),
                "row3" => Carbon::parse($item->updated_at)->format('d/m/Y'),
                "row4" => date('H:i', strtotime($item->hora_inicio)),
                "row5" => date('H:i', strtotime($item->hora_final)),
                "row6" => '<p class="text-break"> '.Carbon::parse($item->fecha_uso.'T'.$item->hora_inicio)->diffAsCarbonInterval(Carbon::parse($item->fecha_uso.'T'.$item->hora_final)).'</p>',
                "row7" => $item->justificacion,
              
            );
        }

        return isset($data)?response()->json($data,200,[]):response()->json([],200,[]);
    } 
    //FIN DE DIBUJAR LAS TABLAS
}
