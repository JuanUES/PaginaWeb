<?php

namespace App\Http\Controllers\Licencias;

use App\Http\Controllers\Controller;
use App\Models\General\Empleado;
use App\Models\Horarios\Departamento;
use App\Models\Licencias\Permiso;
use PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReporteController extends Controller
{
    //PARA MOSTRAR LA VISTA EN LICENCIAS
    public function indexBladeLicencias()
    {
        $permisos = Empleado::selectRaw(' permisos.id, nombre, apellido, permisos.tipo_permiso,permisos.fecha_presentacion,
        permisos.hora_inicio,permisos.hora_final, permisos.justificacion, permisos.updated_at, departamentos.nombre_departamento')
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
            )
            ->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.fecha_presentacion', '>=', '2021-11-01'],
                    ['permisos.fecha_presentacion', '<=', '2021-11-30']
                ]
            )->get();

        //echo dd($permisos);
        $deptos = Departamento::all();
        // echo dd($deptos);
        return view('Reportes.LicenciasReportes.MostrarLicencias', compact('deptos'));
    }
    //FIN DE MOSTRAR LA VISTA EN LICENCIAS

    //TODAS LAS FUNCIONES PARA EL REPORTE CONSTANCIA DE OLVIDO
    public function indexConsResporte()
    {
        $permisos = Empleado::selectRaw(' permisos.id, nombre, apellido, permisos.tipo_permiso,permisos.fecha_presentacion,
        permisos.hora_inicio,permisos.hora_final, permisos.justificacion, permisos.updated_at, departamentos.nombre_departamento')
            ->join('departamentos', 'departamentos.id', '=', 'empleado.id_depto')
            ->join('permisos', 'permisos.empleado', '=', 'empleado.id')
            ->where(
                [
                    ['permisos.estado', '=', 'Aceptado'],
                    ['permisos.fecha_presentacion', '>=', '2021-11-01'],
                    ['permisos.fecha_presentacion', '<=', '2021-11-30']
                ]
            )->get();

        //echo dd($permisos);
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
    //PARA DIBUJAR LAS LA TABLA PARA LAS LICENCIAS
    public function mostrarTablaLicencias($fecha1, $fecha2, $dep)
    {

        $permisoss = Empleado::selectRaw(' permisos.id, nombre, apellido, permisos.tipo_permiso,permisos.fecha_presentacion,
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
                    ['permisos.fecha_presentacion', '>=', $fecha1],
                    ['permisos.fecha_presentacion', '<=', $fecha2]
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
                    ['permisos.fecha_presentacion', '>=', $fecha1],
                    ['permisos.fecha_presentacion', '<=', $fecha2],
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
                "row3" => Carbon::parse($item->updated_at)->format('d/m/Y'),
                "row4" => $col3,
                "row5" => $col4,
                "row6" => $col5,
                "row7" => $item->justificacion,

            );
        }

        return isset($data) ? response()->json($data, 200, []) : response()->json([], 200, []);
    }
    //FIN DE DIBUJAR LAS TABLA PARA LAS LICENCIAS

    //PARA GENERAR EL REPORTE
    public function licenciasPDF(Request $request)
    {

        $permisoss = Empleado::selectRaw(' permisos.id, nombre, apellido, id_depto, permisos.tipo_permiso,permisos.fecha_presentacion,
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
                    ['permisos.fecha_presentacion', '>=', $request->inicioR],
                    ['permisos.fecha_presentacion', '<=', $request->finR]
                ]
            )->get();
            $departamentos=Departamento::all();
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
                    ['permisos.fecha_presentacion', '>=', $request->inicioR],
                    ['permisos.fecha_presentacion', '<=', $request->finR],
                    ['departamentos.id', '=', $request->deptoR_R]
                ]
            )->get();
            $departamentos=Departamento::all();
        }

        // echo dd($permisos);

        $pdf = PDF::loadView('Reportes.LicenciasReportes.ReporteLicencias', compact('permisos','departamentos'));
        return $pdf->setPaper('A4', 'Landscape')->download('Licencias.pdf');
    }
    //FIN PARA GENERAR EL REPORTE
}
