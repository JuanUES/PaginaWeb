<?php

namespace App\Http\Controllers\Licencias;

use App\Http\Controllers\Controller;
use App\Models\General\Empleado;
use App\Models\Horarios\Departamento;
use App\Models\Licencias\Permiso;
use PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpParser\Node\Expr\FuncCall;

class ReporteController extends Controller
{
    //PARA MOSTRAR LA VISTA A LOS EMPLEADOS
    public function indexEmpleadoLicencias()
    {
        $años = Permiso::selectRaw('distinct to_char(permisos.fecha_uso, \'YYYY\') as año')->get();
        return view('Reportes.EmpleadoLicencias.MostrarLicencias', compact('años'));
    }
    //FIN DE MOSTRAR LA VISTA A LOS EMPLEADOS
    //PARA MOSTRAR LA VISTA DE LICENCIAS POR MES PARA LOS JEFES
    public function indexBladeJefes()
    {

        $años = Permiso::selectRaw('distinct to_char(permisos.fecha_uso, \'YYYY\') as año')->get();
        return view('Reportes.Jefes.MostrarMensuales', compact('años'));
    }
    //FIN DE MOSTRAR LA VISTA DE DE LICENCIAS POR MES PARA LOS JEFES
    //PARA MOSTRAR LA VISTA DE LICENCIAS POR ACUERDO
    public function indexBladeAcuerdos()
    {

        $deptos = Departamento::all();
        // echo dd($deptos);
        return view('Reportes.LicenciasAcuerdo.MostrarLicenciasAcuerdos', compact('deptos'));
    }
    //FIN DE MOSTRAR LAS LICENCIAS POR ACUERDO

    //PARA MOSTRAR LA VISTA EN LICENCIAS
    public function indexBladeLicencias()
    {
        $deptos = Departamento::all();
        // echo dd($deptos);
        return view('Reportes.LicenciasReportes.MostrarLicencias', compact('deptos'));
    }
    //FIN DE MOSTRAR LA VISTA EN LICENCIAS

    //TODAS LAS FUNCIONES PARA EL REPORTE CONSTANCIA DE OLVIDO
    public function indexConsResporte()
    {
        $deptos = Departamento::all();
        // echo dd($deptos);
        return view('Reportes.Constancias.MostrarConstancia', compact('deptos'));
    }
    //FIN DE FUNCIONES CONTANCIA DE OLVIDO


    public function index()
    {
        $data =  Permiso::selectRaw('md5(permisos.id::text) as identificador,permisos.empleado, CONCAT(empleado.nombre,\' \',empleado.apellido) e_nombre, to_char(permisos.fecha_uso, \'DD/MM/YYYY\') inicio,
        to_char(permisos.fecha_presentacion,\'DD/MM/YYYY\') fin, permisos.justificacion, permisos.tipo_permiso, permisos.hora_inicio,permisos.estado, permisos.fecha_presentacion, permisos.olvido,permisos.fecha_uso')
            ->join('empleado', 'empleado.id', '=', 'permisos.empleado')
            ->where('empleado.id', auth()->user()->empleado)
            ->whereRaw('tipo_permiso=\'Const. olvido\'')
            ->get();
        // echo dd($data);
        return view('Licencias.ConstanciaReporte', compact('data'));
    }

    public function downloadPDF()
    {

        $data =  Permiso::selectRaw('md5(permisos.id::text) as identificador,permisos.empleado, CONCAT(empleado.nombre,\' \',empleado.apellido) e_nombre, to_char(permisos.fecha_uso, \'DD/MM/YYYY\') inicio,
        to_char(permisos.fecha_presentacion,\'DD/MM/YYYY\') fin, permisos.justificacion, permisos.tipo_permiso, permisos.hora_inicio,permisos.estado, permisos.fecha_presentacion, permisos.olvido,permisos.fecha_uso')
            ->join('empleado', 'empleado.id', '=', 'permisos.empleado')
            ->where('empleado.id', auth()->user()->empleado)
            ->whereRaw('tipo_permiso=\'Const. olvido\'')
            ->get();

        $pdf = PDF::loadView('Licencias.ConstanciaReporte', compact('data'));
        return $pdf->download('Constancia.pdf');
    }
    //PARA MOSTRAR EN LA TABLA DE CONSTANCIA DE OLVIDO DE MARCAJE
    public function mostrarTablaConst($fecha1, $fecha2, $dep)
    {
        $permisoss = Empleado::selectRaw(' permisos.id, nombre, apellido, permisos.tipo_permiso,permisos.fecha_presentacion,permisos.fecha_uso,
        permisos.hora_inicio,permisos.fecha_uso, permisos.justificacion, permisos.updated_at, permisos.olvido, departamentos.nombre_departamento')
            ->join('departamentos', 'departamentos.id', '=', 'empleado.id_depto')
            ->join('permisos', 'permisos.empleado', '=', 'empleado.id');

        if ($dep == 'all') {
            $permisos = $permisoss->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.tipo_permiso', '=', 'Const. olvido'],
                    ['permisos.fecha_uso', '>=', $fecha1],
                    ['permisos.fecha_uso', '<=', $fecha2]
                ]
            )->get();
        } else {
            $permisos = $permisoss->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.tipo_permiso', '=', 'Const. olvido'],
                    ['permisos.fecha_uso', '>=', $fecha1],
                    ['permisos.fecha_uso', '<=', $fecha2],
                    ['departamentos.id', '=', $dep]
                ]
            )->get();
        }
        // echo dd($permisos);

        foreach ($permisos as $item) {
            # CODIGO PARA MOSTRAR EN LA TABLA
            $data[] = array(
                "row0" => $item->nombre . ' ' . $item->apellido,
                "row1" => '<span class="badge badge-primary font-13">' . $item->tipo_permiso . '</span>',
                "row2" => $item->olvido,
                "row3" => date('H:i', strtotime($item->hora_inicio)),
                "row4" => Carbon::parse($item->fecha_uso)->format('d/m/Y'),
                "row5" => Carbon::parse($item->fecha_presentacion)->format('d/m/Y'),
                "row6" => Carbon::parse($item->updated_at)->format('d/m/Y'),
                "row7" =>  $item->justificacion,

            );
        }

        return isset($data) ? response()->json($data, 200, []) : response()->json([], 200, []);
    }
    //FIN DE MOSTRAR EN LA TABLA CONSTANCIA DE OLVIDO DE MARCAJE

    //PARA DIBUJAR LAS LA TABLA PARA LAS LICENCIAS
    public function mostrarTablaLicencias($fecha1, $fecha2, $dep)
    {

        $permisoss = Empleado::selectRaw(' permisos.id, nombre, apellido, permisos.tipo_permiso,permisos.fecha_presentacion,permisos.fecha_uso,
        permisos.hora_inicio,permisos.hora_final,permisos.fecha_uso, permisos.justificacion, permisos.updated_at, permisos.olvido, departamentos.nombre_departamento')
            ->join('departamentos', 'departamentos.id', '=', 'empleado.id_depto')
            ->join('permisos', 'permisos.empleado', '=', 'empleado.id');

        if ($dep == 'all') {
            $permisos = $permisoss->Where(
                function ($query) {
                    $query->Where('tipo_permiso', 'like', 'LC/GS')
                        ->orWhere('tipo_permiso', 'like', 'LS/GS')
                        ->orWhere('tipo_permiso', 'like', 'T COMP')
                        ->orWhere('tipo_permiso', 'like', 'INCAP')
                        ->orWhere('tipo_permiso', 'like', 'L OFICIAL')
                        ->orWhere('tipo_permiso', 'like', 'CITA MEDICA');
                }
            )->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.fecha_uso', '>=', $fecha1],
                    ['permisos.fecha_uso', '<=', $fecha2]
                ]
            )->get();
        } else {
            $permisos = $permisoss->Where(
                function ($query) {
                    $query->Where('tipo_permiso', 'like', 'LC/GS')
                        ->orWhere('tipo_permiso', 'like', 'LS/GS')
                        ->orWhere('tipo_permiso', 'like', 'T COMP')
                        ->orWhere('tipo_permiso', 'like', 'INCAP')
                        ->orWhere('tipo_permiso', 'like', 'L OFICIAL')
                        ->orWhere('tipo_permiso', 'like', 'CITA MEDICA');
                }
            )->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.fecha_uso', '>=', $fecha1],
                    ['permisos.fecha_uso', '<=', $fecha2],
                    ['departamentos.id', '=', $dep]
                ]
            )->get();
        }
        // echo dd($permisos);

        foreach ($permisos as $item) {
            # code...

            $col3 = $col4 = $col5 = null;
            if ($item->olvido == 'Entrada' || $item->olvido == 'Salida') {
                $col3 = date('H:i', strtotime($item->olvido == 'Entrada' ? $item->hora_inicio : $item->hora_final));
                $col4 = date('H:i', strtotime($item->olvido == 'Salida' ? $item->hora_inicio : $item->hora_final));
                $col5 = date('H:i', strtotime($item->hora_final));
            } else {
                $col3 = date('H:i', strtotime($item->hora_inicio));
                $col4 = date('H:i', strtotime($item->hora_final));
                $col5 = '' . \Carbon\Carbon::parse($item->fecha_uso . 'T' . $item->hora_inicio)->diffAsCarbonInterval(\Carbon\Carbon::parse($item->fecha_uso . 'T' . $item->hora_final));
            }

            $data[] = array(
                "row0" => $item->nombre . ' ' . $item->apellido,
                "row1" => '<span class="badge badge-primary font-13">' . $item->tipo_permiso . '</span>',
                "row2" => Carbon::parse($item->fecha_presentacion)->format('d/m/Y'),
                "row3" => Carbon::parse($item->fecha_uso)->format('d/m/Y'),
                "row4" => Carbon::parse($item->updated_at)->format('d/m/Y'),
                "row5" => $col3,
                "row6" => $col4,
                "row7" => $col5,
                "row8" => $item->justificacion,

            );
        }

        return isset($data) ? response()->json($data, 200, []) : response()->json([], 200, []);
    }
    //FIN DE DIBUJAR LAS TABLA PARA LAS LICENCIAS

    //PARA MOSTRAR EN LA TABLA DE LA VISTA DE LICENCIAS POR ACUERDO
    public function mostrarTablaLicenciasAcuer($fecha1, $fecha2, $dep)
    {
        $permisoss = Empleado::selectRaw(' permisos.id, nombre, apellido, permisos.tipo_permiso,permisos.fecha_presentacion,permisos.fecha_uso,
        permisos.hora_inicio,permisos.hora_final,permisos.fecha_uso, permisos.justificacion, permisos.updated_at, permisos.olvido, departamentos.nombre_departamento')
            ->join('departamentos', 'departamentos.id', '=', 'empleado.id_depto')
            ->join('permisos', 'permisos.empleado', '=', 'empleado.id');

        if ($dep == 'all') {
            $permisos = $permisoss->Where(
                function ($query) {
                    $query->Where('tipo_permiso', 'like', 'INCAPACIDAD/A')
                        ->orWhere('tipo_permiso', 'like', 'ESTUDIO')
                        ->orWhere('tipo_permiso', 'like', 'FUMIGACIÓN')
                        ->orWhere('tipo_permiso', 'like', 'L.OFICIAL/A')
                        ->orWhere('tipo_permiso', 'like', 'OTROS');
                }
            )->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.fecha_uso', '>=', $fecha1],
                    ['permisos.fecha_uso', '<=', $fecha2]
                ]
            )->get();
        } else {
            $permisos = $permisoss->Where(
                function ($query) {
                    $query->Where('tipo_permiso', 'like', 'INCAPACIDAD/A')
                        ->orWhere('tipo_permiso', 'like', 'ESTUDIO')
                        ->orWhere('tipo_permiso', 'like', 'FUMIGACIÓN')
                        ->orWhere('tipo_permiso', 'like', 'L.OFICIAL/A')
                        ->orWhere('tipo_permiso', 'like', 'OTROS');
                }
            )->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.fecha_uso', '>=', $fecha1],
                    ['permisos.fecha_uso', '<=', $fecha2],
                    ['departamentos.id', '=', $dep]
                ]
            )->get();
        }
        // echo dd($permisos);

        foreach ($permisos as $item) {
            # code...

            $data[] = array(
                "row0" => $item->nombre . ' ' . $item->apellido,
                "row1" => '<span class="badge badge-primary font-13">' . $item->tipo_permiso . '</span>',
                "row2" => Carbon::parse($item->fecha_uso)->format('d/m/Y'),
                "row3" => Carbon::parse($item->fecha_presentacion)->format('d/m/Y'),
                "row4" => $item->justificacion,

            );
        }

        return isset($data) ? response()->json($data, 200, []) : response()->json([], 200, []);
    }
    //FIN MOSTRAR EN LA TABLA DE LA VISTA DE LICENCIAS POR ACUERDO

    //PARA MOSTRAR EN LA TABLA DE LA VISTA DE REVISION MENSUALE A JEFES
    public function mostrarTablaJefes($mes, $anio)
    {

        $permisos = Permiso::selectRaw('tipo_permiso, fecha_uso,fecha_presentacion,hora_inicio,hora_final,justificacion,permisos.estado,
                observaciones,olvido,empleado.nombre,empleado.apellido')
            ->join('empleado', 'empleado.id', '=', 'permisos.empleado')
            ->where(
                function ($query) {
                    $query->where([
                        ['permisos.estado', 'like', 'Aceptado'],
                        ['permisos.jefatura', '=', auth()->user()->empleado]
                    ]);
                }
            );


        if ($anio != 'todos') {
            $permisos = $permisos->whereRaw('to_char(permisos.fecha_uso,\'YYYY\')::int=' . $anio);
        }

        if ($mes != 'todos') {
            $permisos = $permisos->whereRaw('to_char(permisos.fecha_uso,\'MM\')::int=' . $mes);
        }

        $permisos = $permisos->get();

        foreach ($permisos as $item) {
            # code...
            $col3 = null;
            if ($item->olvido == 'Entrada' || $item->olvido == 'Salida') {
                $col3 = $item->olvido;
            } else {
                $col3 = '' . \Carbon\Carbon::parse($item->fecha_uso . 'T' . $item->hora_inicio)->diffAsCarbonInterval(\Carbon\Carbon::parse($item->fecha_uso . 'T' . $item->hora_final));
            }



            $data[] = array(
                "col0" => $item->nombre . ' ' . $item->apellido,
                "col1" => '<span class="badge badge-primary">' . $item->tipo_permiso . '</span>',
                "col2" => \Carbon\Carbon::parse($item->fecha_uso)->format('d/M/Y'),
                "col3" => $col3,
            );
        }
        return isset($data) ? response()->json($data, 200, []) : response()->json([], 200, []);
    }
    //FIN DE MOSTRAR EN LA TABLA DE LA VISTA DE REVISION MENSUALE A JEFES
    public function mostrarTablaEmpleado($mes, $anio)
    {
            //echo dd($mes);
        $permisos = Permiso::selectRaw('tipo_permiso, fecha_uso,fecha_presentacion,hora_inicio,hora_final,justificacion,permisos.estado,
                observaciones,olvido,empleado.nombre,empleado.apellido')
            ->join('empleado', 'empleado.id', '=', 'permisos.empleado')
            ->where(
                function ($query) {
                    $query->where([
                        ['permisos.estado', 'like', 'Aceptado'],
                        ['permisos.empleado', '=', auth()->user()->empleado]
                    ]);
                }
            );
           
            $permisos = $permisos->whereRaw('to_char(permisos.fecha_uso,\'YYYY\')::int=' . $anio);
        
            $permisos = $permisos->whereRaw('to_char(permisos.fecha_uso,\'MM\')::int=' . $mes);
            

              $permisos = $permisos->get();

        foreach ($permisos as $item) {
            # code...
            $col3 = $col4 = $col5 = null;
            if ($item->olvido == 'Entrada' || $item->olvido =='Salida') {
                $col3 = date('H:i', strtotime($item->olvido == 'Entrada'?$item->hora_inicio:$item->hora_final));
                $col4 = date('H:i', strtotime($item->olvido == 'Salida'?$item->hora_inicio:$item->hora_final));
                $col5 = date('H:i', strtotime($item->hora_final));
            }else{
                $col3 = date('H:i', strtotime($item->hora_inicio));
                $col4 = date('H:i', strtotime($item->hora_final)) ;
                $col5 = ''.\Carbon\Carbon::parse($item->fecha_uso . 'T' . $item->hora_inicio)->diffAsCarbonInterval(\Carbon\Carbon::parse($item->fecha_uso . 'T' . $item->hora_final));
            }
            $data[] = array(
                "col0" => '<span class="badge badge-primary">'.$item->tipo_permiso.'</span>',
                "col1" => \Carbon\Carbon::parse($item->fecha_presentacion)->format('d/M/Y'),
                "col2" => \Carbon\Carbon::parse($item->fecha_uso)->format('d/M/Y'),  
                "col3" => $col3,
                "col4" => $col4,
                "col5" => $col5,
                "col6" => $item->justificacion,
                
            );
        }
        return isset($data) ? response()->json($data, 200, []) : response()->json([], 200, []);
    }

    //PARA MOSTRAR EN LA TABLA DE LA VISTA DE HISTORIAL DE LICENCIAS

    //FIN DE MOSTRAR EN LA TABLA DE LA VISTA DE HISTORIAL DE LICENCIAS

    //PARA GENERAR EL REPORTE DE CONSTANCIAS EN PDF
    public function ConstDeptosPDF(Request $request)
    {

        $permisoss = Empleado::selectRaw(' permisos.id, nombre, apellido, id_depto, permisos.tipo_permiso,permisos.fecha_presentacion, permisos.fecha_uso,
        permisos.hora_inicio,permisos.hora_final, permisos.justificacion, permisos.updated_at, permisos.olvido, departamentos.nombre_departamento')
            ->join('departamentos', 'departamentos.id', '=', 'empleado.id_depto')
            ->join('permisos', 'permisos.empleado', '=', 'empleado.id');

        if ($request->deptoR_R == 'all') {
            $permisos = $permisoss->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.tipo_permiso', '=', 'Const. olvido'],
                    ['permisos.fecha_uso', '>=', $request->inicioR],
                    ['permisos.fecha_uso', '<=', $request->finR]
                ]
            )->get();
            //para mostrar solo los departamentos que tienen permisos
            $departamentos = Empleado::selectRaw(' DISTINCT id_depto,departamentos.nombre_departamento,departamentos.id')
                ->join('departamentos', 'departamentos.id', '=', 'empleado.id_depto')
                ->join('permisos', 'permisos.empleado', '=', 'empleado.id')
                ->where(
                    [
                        ['permisos.estado', '=', 'Aceptado'],
                        ['permisos.tipo_permiso', '=', 'Const. olvido'],
                        ['permisos.fecha_uso', '>=', $request->inicioR],
                        ['permisos.fecha_uso', '<=', $request->finR]
                    ]
                )->get();
            //para imprimir el reporte

        } else {
            $permisos = $permisoss->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.tipo_permiso', '=', 'Const. olvido'],
                    ['permisos.fecha_uso', '>=', $request->inicioR],
                    ['permisos.fecha_uso', '<=', $request->finR],
                    ['departamentos.id', '=', $request->deptoR_R]
                ]
            )->get();

            $departamentos = Departamento::where('id', '=', $request->deptoR_R)->get();
        }

        // echo dd($permisos);

        $pdf = PDF::loadView('Reportes.Constancias.ReporteConstancias', compact('permisos', 'departamentos', 'request'));
        return $pdf->setPaper('A4', 'Landscape')->download('Constancias.pdf');
    }
    //FIN DE GENERAR EL REPORTE DE CONTANCIAS EN PDF

    //PARA GENERAR EL REPORTE DE LICENCIAS EN PDF
    public function licenciasDeptosPDF(Request $request)
    {

        $permisoss = Empleado::selectRaw(' permisos.id, nombre, apellido, id_depto, permisos.tipo_permiso,permisos.fecha_presentacion, permisos.fecha_uso,
        permisos.hora_inicio,permisos.hora_final, permisos.justificacion, permisos.updated_at, permisos.olvido, departamentos.nombre_departamento')
            ->join('departamentos', 'departamentos.id', '=', 'empleado.id_depto')
            ->join('permisos', 'permisos.empleado', '=', 'empleado.id');

        if ($request->deptoR_R == 'all') {
            $permisos = $permisoss->Where(
                function ($query) {
                    $query->Where('tipo_permiso', 'like', 'LC/GS')
                        ->orWhere('tipo_permiso', 'like', 'LS/GS')
                        ->orWhere('tipo_permiso', 'like', 'T COMP')
                        ->orWhere('tipo_permiso', 'like', 'INCAP')
                        ->orWhere('tipo_permiso', 'like', 'L OFICIAL')
                        ->orWhere('tipo_permiso', 'like', 'CITA MEDICA');
                }
            )->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.fecha_uso', '>=', $request->inicioR],
                    ['permisos.fecha_uso', '<=', $request->finR]
                ]
            )->get();
            //para mostrar solo los departamentos que tienen permisos
            $departamentos = Empleado::selectRaw(' DISTINCT id_depto,departamentos.nombre_departamento,departamentos.id')
                ->join('departamentos', 'departamentos.id', '=', 'empleado.id_depto')
                ->join('permisos', 'permisos.empleado', '=', 'empleado.id')
                ->Where(
                    function ($query) {
                        $query->Where('tipo_permiso', 'like', 'LC/GS')
                            ->orWhere('tipo_permiso', 'like', 'LS/GS')
                            ->orWhere('tipo_permiso', 'like', 'T COMP')
                            ->orWhere('tipo_permiso', 'like', 'INCAP')
                            ->orWhere('tipo_permiso', 'like', 'L OFICIAL')
                            ->orWhere('tipo_permiso', 'like', 'CITA MEDICA');
                    }
                )->where(
                    [
                        ['permisos.estado', '=', 'Aceptado'],
                        ['permisos.fecha_uso', '>=', $request->inicioR],
                        ['permisos.fecha_uso', '<=', $request->finR]
                    ]
                )->get();
            //para imprimir el reporte

        } else {
            $permisos = $permisoss->Where(
                function ($query) {
                    $query->Where('tipo_permiso', 'like', 'LC/GS')
                        ->orWhere('tipo_permiso', 'like', 'LS/GS')
                        ->orWhere('tipo_permiso', 'like', 'T COMP')
                        ->orWhere('tipo_permiso', 'like', 'INCAP')
                        ->orWhere('tipo_permiso', 'like', 'L OFICIAL')
                        ->orWhere('tipo_permiso', 'like', 'CITA MEDICA');
                }
            )->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.fecha_uso', '>=', $request->inicioR],
                    ['permisos.fecha_uso', '<=', $request->finR],
                    ['departamentos.id', '=', $request->deptoR_R]
                ]
            )->get();

            $departamentos = Departamento::where('id', '=', $request->deptoR_R)->get();
        }

        // echo dd($permisos);
        $pdf = PDF::loadView('Reportes.LicenciasReportes.ReporteLicencias', compact('permisos', 'departamentos', 'request'));
        return $pdf->setPaper('A4', 'Landscape')->download('Licencias.pdf');
    }
    //FIN PARA GENERAR EL REPORTE DE LICENCIAS EN PDF

    //PARA GENERAR EL REPORTE DE LICENCIAS POR ACUERDO
    public function licenciasAcuerdoPDF(Request $request)
    {
        $permisoss = Empleado::selectRaw(' permisos.id, nombre, apellido, id_depto, permisos.tipo_permiso,permisos.fecha_presentacion, permisos.fecha_uso,
        permisos.hora_inicio,permisos.hora_final, permisos.justificacion, permisos.updated_at, permisos.olvido, departamentos.nombre_departamento')
            ->join('departamentos', 'departamentos.id', '=', 'empleado.id_depto')
            ->join('permisos', 'permisos.empleado', '=', 'empleado.id');

        if ($request->deptoR_R == 'all') {
            $permisos = $permisoss->Where(
                function ($query) {
                    $query->Where('tipo_permiso', 'like', 'INCAPACIDAD/A')
                        ->orWhere('tipo_permiso', 'like', 'ESTUDIO')
                        ->orWhere('tipo_permiso', 'like', 'FUMIGACIÓN')
                        ->orWhere('tipo_permiso', 'like', 'L.OFICIAL/A')
                        ->orWhere('tipo_permiso', 'like', 'OTROS');
                }
            )->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.fecha_uso', '>=', $request->inicioR],
                    ['permisos.fecha_uso', '<=', $request->finR]
                ]
            )->get();
            //para mostrar solo los departamentos que tienen permisos
            $departamentos = Empleado::selectRaw(' DISTINCT id_depto,departamentos.nombre_departamento,departamentos.id')
                ->join('departamentos', 'departamentos.id', '=', 'empleado.id_depto')
                ->join('permisos', 'permisos.empleado', '=', 'empleado.id')
                ->Where(
                    function ($query) {
                        $query->Where('tipo_permiso', 'like', 'INCAPACIDAD/A')
                            ->orWhere('tipo_permiso', 'like', 'ESTUDIO')
                            ->orWhere('tipo_permiso', 'like', 'FUMIGACIÓN')
                            ->orWhere('tipo_permiso', 'like', 'L.OFICIAL/A')
                            ->orWhere('tipo_permiso', 'like', 'OTROS')
                            ->orWhere('tipo_permiso', 'like', 'CITA MEDICA');
                    }
                )->where(
                    [
                        ['permisos.estado', '=', 'Aceptado'],
                        ['permisos.fecha_uso', '>=', $request->inicioR],
                        ['permisos.fecha_uso', '<=', $request->finR]
                    ]
                )->get();
            //para imprimir el reporte

        } else {
            $permisos = $permisoss->Where(
                function ($query) {
                    $query->Where('tipo_permiso', 'like', 'INCAPACIDAD/A')
                        ->orWhere('tipo_permiso', 'like', 'ESTUDIO')
                        ->orWhere('tipo_permiso', 'like', 'FUMIGACIÓN')
                        ->orWhere('tipo_permiso', 'like', 'L.OFICIAL/A')
                        ->orWhere('tipo_permiso', 'like', 'OTROS');
                }
            )->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.fecha_uso', '>=', $request->inicioR],
                    ['permisos.fecha_uso', '<=', $request->finR],
                    ['departamentos.id', '=', $request->deptoR_R]
                ]
            )->get();

            $departamentos = Departamento::where('id', '=', $request->deptoR_R)->get();
        }

        // echo dd($permisos);
        $pdf = PDF::loadView('Reportes.LicenciasAcuerdo.ReporteLicenciasAcuerdos', compact('permisos', 'departamentos', 'request'));
        return $pdf->setPaper('A4', 'Landscape')->download('LicenciasPorAcuerdos.pdf');
    }
    //FIN DE GENERAR REPORTE DE LICENCIAS POR ACUERDO

    //PARA GENERAR EL PDF DE REPORTE MENSUAL JEFE
    public function mensualJefePDF(Request $request)
    {
        $permisos = Permiso::selectRaw('tipo_permiso, fecha_uso,fecha_presentacion,hora_inicio,hora_final,justificacion,permisos.estado,
                observaciones,olvido,empleado.nombre,empleado.apellido')
            ->join('empleado', 'empleado.id', '=', 'permisos.empleado')
            ->where(
                function ($query) {
                    $query->where([
                        ['permisos.estado', 'like', 'Aceptado'],
                        ['permisos.jefatura', '=', auth()->user()->empleado]
                    ]);
                }
            );

        $departamentos = Empleado::selectRaw(' DISTINCT id_depto,departamentos.nombre_departamento,departamentos.id')
            ->join('departamentos', 'departamentos.id', '=', 'empleado.id_depto')
            ->join('permisos', 'permisos.empleado', '=', 'empleado.id')
            ->Where(
                function ($query) {
                    $query->Where([['permisos.estado', 'like', 'Aceptado'], ['permisos.jefatura', '=', auth()->user()->empleado]]);
                }
            )->get();


        if ($request->anio != 'todos') {
            $permisos = $permisos->whereRaw('to_char(permisos.fecha_uso,\'YYYY\')::int=' . $request->anio);
        }

        if ($request->mes != 'todos') {
            $permisos = $permisos->whereRaw('to_char(permisos.fecha_uso,\'MM\')::int=' . $request->mes);
        }

        $permisos = $permisos->get();




        // echo dd($permisos);
        $pdf = PDF::loadView('Reportes.Jefes.ReporteMensuales', compact('permisos', 'departamentos', 'request'));
        return $pdf->download('Reporte de licencias ' . $request->mes . '.pdf');
    }
    //FIN GENERAR EL REPORTE MENSUAL JEFE   

    //PARA GENERAR EL PDF DEL EMPLEADO
    public function mensualEmpleadoPDF(Request $request)
    {

        $permisos = Permiso::selectRaw('tipo_permiso, fecha_uso,fecha_presentacion,hora_inicio,hora_final,justificacion,permisos.estado,
                observaciones,olvido,empleado.nombre,empleado.apellido')
            ->join('empleado', 'empleado.id', '=', 'permisos.empleado')
            ->where(
                function ($query) {
                    $query->where([
                        ['permisos.estado', 'like', 'Aceptado'],
                        ['permisos.empleado', '=', auth()->user()->empleado]
                    ]);
                }
            );
           
            $permisos = $permisos->whereRaw('to_char(permisos.fecha_uso,\'YYYY\')::int=' . $request->anio);
        
            $permisos = $permisos->whereRaw('to_char(permisos.fecha_uso,\'MM\')::int=' . $request->mes);
            

              $permisos = $permisos->get();
              $empleado = Empleado::select('*')->where('id','=',auth()->user()->empleado)->get();


        // echo dd($permisos);
        $pdf = PDF::loadView('Reportes.EmpleadoLicencias.ReporteLicenciasEmpleado', compact('permisos','empleado','request'));
        return $pdf->download('Reporte de licencias ' . $request->mes . '.pdf');
    }

    //FIN DE GENERAR EL PDF PARA EL EMPLEADO
}
