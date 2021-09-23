<?php

namespace App\Http\Controllers;

use Auth;
use App\Exports\JornadaExport;
use App\Models\_UTILS\Utilidades;
use App\Models\Jornada\Jornada;
use App\Models\Jornada\JornadaItem;
use App\Models\Jornada\Periodo;
use App\Models\Tipo_Jornada;
use App\Models\User;
use App\Models\General\Empleado;
use App\Models\Horarios\Departamento;
use App\Models\Horarios\Horarios;
use App\Models\Jornada\Seguimiento;
use App\Models\Notificaciones;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class JornadaController extends Controller{
    public $modulo = 'Jornadas';

    public $rules = [
        'id_emp' => 'required|integer',
        'id_periodo' => 'required|integer',
        'items' => 'required'
        // 'items' => 'required|array',
    ];

    public $messages = [
        'id_emp.requiered' => 'Seleccione un empleado',
        'items.array' => 'La Jornada no puede ir vacia'
    ];

    public $estado_procedimiento = [
        0 => ['value' => 'guardado', 'text' => 'Guardado'],
        1 => ['value' => 'enviado a jefatura', 'text' => 'Enviar a Jefatura'],
        2 => ['value' => 'la jefatura lo ha regresado por problemas', 'text' => 'Retornar con observaciones (Jefatura)'],
        3 => ['value' => 'enviado a recursos humanos', 'text' => 'Enviar a recursos humanos'],
        4 => ['value' => 'recursos humanos lo ha regresado a jefatura', 'text' => 'Retornar con observaciones (Recursos Humanos)'],
        5 => ['value' => 'aceptado', 'text' => 'Aceptado'],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $user = Auth::user();
        $estados = $this->estado_procedimiento;
        $cargar = true;
        $emp = null; //para terminar que es solo un empleado y poder determinar el tipo
        $add_jornada = false;

        $periodo = isset($request->periodo) ? $request->periodo : Periodo::select('id')->OrderBy('id', 'DESC')->first()->id;
        $depto = isset($request->depto) ? $request->depto : false;


        $query = Jornada::join('periodos','jornada.id_periodo','periodos.id')
                ->join('empleado','jornada.id_emp','empleado.id')
                ->select('jornada.*',Periodo::raw("concat(to_char(periodos.fecha_inicio, 'dd/TMMonth/yy') , ' - ', to_char(periodos.fecha_fin, 'dd/TMMonth/yy')) as periodo"))
                ->where('jornada.id_periodo', $periodo);

            //determinamos si tiene un empleado relacionado
            $empleado = $user->empleado_rf;
            if(is_null($empleado)){//para que muestre una alerta de que no existe un empleado relacionado con el usuario
                $query = null;
            }else {

                if(!$user->hasRole('super-admin') && !$user->hasRole('Recurso-Humano')){ // si no es jefe filtramos la informacion dependiendo de si es jefe o empleado normal
                    if($user->hasRole('Jefe-Academico') || $user->hasRole('Jefe-Departamento')){//para filtrar por tipo de departamento
                        $depto = $empleado->id_depto;// id que servira para filtrar los empleados por departemento
                        $query->whereIn('jornada.procedimiento', [$estados[1]['value'], $estados[2]['value'], $estados[3]['value'], $estados[4]['value'], $estados[5]['value']]);

                    }else if($user->hasRole('Docente') && strcmp($empleado->tipo_empleado,'Académico')==0){ // con esto determinamos que es un empleado sin cargos de jefatura por lo cual solo se mostrara ese empleado
                        $query->where('empleado.id', $empleado->id);
                        $emp = $empleado;
                    }else{
                        $query = null;
                    }
                } else if ($user->hasRole('Recurso-Humano')) {
                    $query->whereIn('jornada.procedimiento', [$estados[3]['value'], $estados[4]['value'], $estados[5]['value']]);
                }


                //PARA AGREGAR LA FILA DE LA JORNADA DEL JEFES Y DE RECURSO HUMANO
                if($user->hasRole('Recurso-Humano') || $user->hasRole('Jefe-Academico') || $user->hasRole('Jefe-Departamento')){
                    $add_jornada = true;
                    $jornada_query = Jornada::join('periodos', 'jornada.id_periodo', 'periodos.id')
                        ->join('empleado', 'jornada.id_emp', 'empleado.id')
                        ->select('jornada.*', Periodo::raw("concat(to_char(periodos.fecha_inicio, 'dd/TMMonth/yy') , ' - ', to_char(periodos.fecha_fin, 'dd/TMMonth/yy')) as periodo"))
                        ->where('jornada.id_periodo', $periodo)
                        ->where('empleado.id', $empleado->id);
                    ($depto != false && strcmp($depto, 'all') != 0)
                        ? $jornada_query->where('empleado.id_depto', $depto)
                        : $depto = 'all';
                    $jornada = $jornada_query->first();
                }

            }

        if(is_null($query)){
            $cargar = false;
            $jornadas = [];
            $deptos = [];
            $periodos = [];
        }else{
            ($depto != false && strcmp($depto, 'all') != 0)
                ? $query->where('empleado.id_depto', $depto)
                : $depto = 'all';

            $jornadas = $query->get();
            $deptos = Departamento::where('estado', true)->latest()->get();
            $periodos = Periodo::where('estado', 'activo')->latest()->get();

            if($add_jornada && !is_null($jornada)){

                // dd($jornada);

                if(!$jornadas->contains($jornada))
                    $jornadas->prepend($jornada);
            }
        }

        return view('Jornada.index', compact('emp','cargar','periodos','jornadas', 'deptos',  'periodos', 'periodo', 'depto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $periodos = Periodo::where('estado', 'LIKE','%activo%')->get();
        $tjornada = Tipo_Jornada::join('empleado', 'tipo_jornada.id','=','empleado.id_tipo_jornada')
            ->select('empleado.id','tipo_jornada.horas_semanales')
            ->where('empleado.id',1)
            ->get();
        return view('Jornada.create', compact('periodos','tjornada'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), $this->rules, $this->messages);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            $items = json_decode($request->items);
            $requestData = $request->except(['_id', 'items']);

            if (strcmp(trim($request->_id), '') == 0 ) {
                $msg = 'Registro exitoso.';
                $jornada = Jornada::create($requestData);
                if (is_array($items) || is_object($items)) {
                    foreach ($items as $key => $value) { //para guardar los items del jornada
                        JornadaItem::create([
                            'id_jornada' => $jornada->id,
                            'dia' => $value->dia,
                            'hora_inicio' => $value->hora_inicio,
                            'hora_fin' => $value->hora_fin,
                        ]);
                    }
                }
                Utilidades::fnSaveBitacora('Nueva Jornada #: ' . $jornada->id. ' Ciclo: '. $jornada->periodo_rf->ciclo_rf->nombre, 'Registro', $this->modulo);
            } else {
                $id = $request->_id;
                $jornada = Jornada::findOrFail($id);
                $msg = 'Modificación exitosa.';


                $jornada->update($requestData);
                $jornada->items()->delete();
                if (is_array($items) || is_object($items)) {
                    foreach ($items as $key => $value) { //para guardar los items del jornada
                        JornadaItem::create([
                            'id_jornada' => $jornada->id,
                            'dia' => $value->dia,
                            'hora_inicio' => $value->hora_inicio,
                            'hora_fin' => $value->hora_fin,
                        ]);
                    }
                }
                Utilidades::fnSaveBitacora('Jornada #: ' . $jornada->id . ' Ciclo: ' . $jornada->periodo_rf->ciclo_rf->nombre, 'Modificación', $this->modulo);
            }
            return response()->json(['mensaje' => $msg]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $user = Auth::user();

        $jornada = Jornada::select('jornada.id', 'jornada.id_emp', 'jornada.id_periodo', 'jornada.created_at')
                        ->where('jornada.id', $id)
                        ->first();
        $items = $jornada->items;
        $jornadas = [];
        foreach ($items as $key => $value) {
            $fechaUno = new DateTime($value->hora_fin);
            $fechaDos = new DateTime($value->hora_inicio);
            $dateInterval = $fechaUno->diff($fechaDos);
            $jornadas[$key]['option'] = '<button type="button" class="btn btn-sm btn-secondary" title="Eliminar Fila"> <i class="fa fa-times"></i> </button>';
            $jornadas[$key]['dia'] = $value->dia;
            $jornadas[$key]['hora_inicio'] = $value->hora_inicio;
            $jornadas[$key]['hora_fin'] = $value->hora_fin;
            $jornadas[$key]['jornada'] = $dateInterval->format('%H:%I');
        }
        $seguimiento = $jornada->seguimiento;

        return array('jornada' => $jornada, 'items' => $jornadas, 'seguimiento' => $seguimiento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jornada $jornada){

    }

    public function getEmpleadoJornada($id){
        $user = Auth::user();
        $empleado = Empleado::join('tipo_jornada as tj', 'tj.id', 'empleado.id_tipo_jornada')
                            ->where('empleado.id', $id)
                            ->first();
        $permiso = ($user->hasRole('super-admin') || $user->hasRole('Recurso-Humano') || $user->hasRole('Jefe-Depatamento') || $user->hasRole('Jefe-Academico') || strcmp($empleado->tipo_empleado, 'Académico') == 0);

        return array('empleado' => $empleado, 'permiso' => $permiso);
    }

    public function getEmpleadoPeriodo($id, Request $request){
        $is_edit = $request->updateEmpleado;
        $empleados = $this->fnEmpleadosSegunPeriodo($id, $is_edit);
        return $empleados;
    }

    public function export(Request $request){
        $user = Auth::user();
        $depto = null;
        if (!$user->hasRole('super-admin') && !$user->hasRole('Recurso-Humano')) { // si no es jefe filtramos la informacion dependiendo de si es jefe o empleado normal
            //determinamos si tiene un empleado relacionado
            $empleado = $user->empleado_rf;
            if (!is_null($empleado)) { //para que muestre una alerta de que no existe un empleado relacionado con el usuario
                if ($user->hasRole('Jefe-Academico') || $user->hasRole('Jefe-Departamento')) { //para filtrar por tipo de departamento
                    $depto = $empleado->id_depto; // id que servira para filtrar los empleados por departemento
                }
            }
        } else if ($user->hasRole('super-admin') || $user->hasRole('Recurso-Humano')) {
            if(isset($request->depto)){
                $depto = $request->depto; // id que servira para filtrar los empleados por departemento
            }
        }
        $periodo = Periodo::findOrFail($request->periodo);
        $titulo = 'jornada_'. preg_replace('/\s+/', '', ($periodo->ciclo_rf->nombre).'_generado_'.date('d_m_Y_H_m_s'));
        return Excel::download(new JornadaExport($periodo->id, $depto), $titulo.'.xlsx');
    }

    public function procedimiento(Request $request){
        $rules = [
            'jornada_id' => 'required|integer',
            'proceso' => 'required|string',
        ];

        try {
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            $jornada = Jornada::findOrFail($request->jornada_id);
            $jornada->update([
                'procedimiento' => $request->proceso,
            ]);



            $periodo = $jornada->periodo_rf;
            $empleado = $jornada->empleado_rf;
            $jefe = $empleado->jefe_rf;
            if (!is_null($jefe)) {
                $usuario_jefe = $jefe->usuario_rf;
                if(!is_null($usuario_jefe)){
                    Notificaciones::create([
                        'usuario_id' => $usuario_jefe->id,
                        'mensaje' => $request->proceso . ' ' . $empleado->nombre . ' ' . $empleado->apellido . ' ha enviado la jornada para el período ' . $periodo->titulo,
                        'tipo' => 'Jornada',
                        'observaciones' => $request->observaciones
                    ]);
                }
            }


            Seguimiento::create($request->all());
            //Notificacion de que ha sido enviado a jefatura la
            Notificaciones::create([
                'usuario_id' => Auth::user()->id,
                'mensaje' => $request->proceso . ' ' . $empleado->nombre . ' ' . $empleado->apellido . ' ha enviado la jornada para el período ' . $periodo->titulo,
                'tipo' => 'Jornada',
                'observaciones' => $request->observaciones
            ]);


            Utilidades::fnSaveBitacora('Seguimiento para la Jornada del Empleado #: ' . $empleado->nombre.' '.$empleado->apellido, 'Registro', $this->modulo);

            return response()->json(['mensaje' => 'Registro exitoso']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function fnEmpleadosSegunPeriodo($periodo, $is_edit){
        $user = Auth::user();
        $query = Empleado::where('estado', true);
        if($is_edit!='true'){
            $query->whereNotExists(function ($query) use ($periodo) {
                $query->select(DB::raw(1))
                    ->from('jornada as j')
                    ->where('j.id_periodo', $periodo)
                    ->whereRaw('j.id_emp = empleado.id');
            });
        }
        if (!$user->hasRole('super-admin') && !$user->hasRole('Recurso-Humano')) { // si no es jefe filtramos la informacion dependiendo de si es jefe o empleado normal
            //determinamos si tiene un empleado relacionado
            $empleado = $user->empleado_rf;
            if (is_null($empleado)) { //para que muestre una alerta de que no existe un empleado relacionado con el usuario
                $query = null;
            } else {
                if ($user->hasRole('Jefe-Academico') || $user->hasRole('Jefe-Departamento')) { //para filtrar por tipo de departamento
                    $depto = $empleado->id_depto; // id que servira para filtrar los empleados por departemento
                    $query->where('empleado.id_depto', $depto);
                } else { // con esto determinamos que es un empleado sin cargos de jefatura por lo cual solo se mostrara ese empleado
                    $query->where('empleado.id', $empleado->id);
                }
            }
        }
        $empleados = $query->get();
        return $empleados;
    }


    public function checkDia(Request $request){
        $empleado = Empleado::findOrFail($request->empleado);
        $periodo = Periodo::findOrFail($request->periodo);
        $ciclo = $periodo->ciclo_rf;
        $horarios = $ciclo->horarios_rf->where('id_empleado', $empleado->id);


        // dd($horarios);
    }

    public function getOpcionesSeguimiento(){
        $user = Auth::user();
        $estados = $this->estado_procedimiento;
        unset($estados[0]);


        // $estado_procedimiento = [
        //     0 => ['value' => 'guardado', 'text' => 'Guardado'],
        //     1 => ['value' => 'enviado a jefatura', 'text' => 'Enviar a Jefatura'],
        //     2 => ['value' => 'la jefatura lo ha regresado por problemas', 'text' => 'Retornar con observaciones (Jefatura)'],
        //     3 => ['value' => 'enviado a recursos humanos', 'text' => 'Enviar a recursos humanos'],
        //     4 => ['value' => 'recursos humanos lo ha regresado a jefatura', 'text' => 'Retornar con observaciones (Recursos Humanos)'],
        //     5 => ['value' => 'aceptado', 'text' => 'Aceptado'],
        // ];




        if ($user->hasRole('super-admin') || $user->hasRole('Recurso-Humano')){
            unset($estados[1], $estados[2], $estados[3]);
        } else if ($user->hasRole('Jefe-Academico') || $user->hasRole('Jefe-Departamento')){
            unset($estados[5], $estados[4], $estados[1]);
        } else if($user->hasRole('Docente')){
            unset($estados[5], $estados[4], $estados[3], $estados[2]);
        }
        return $estados;
    }

    public function fnCargaSegunEmpleado($id){
        $user = Auth::user();
        $query = Horarios::join('horas','horarios.id_hora','horas.id')
        ->join('materias','horarios.id_materia','materias.id')
        ->join('empleado','horarios.id_empleado','empleado.id')
        ->select ('horarios.id_empleado','horarios.dias as dias','materias.nombre_materia as nombre_materia','horas.inicio as inicio','horas.fin as fin');
        
        if ($user->hasRole('Docente')) {
            $empleado = $user->empleado_rf;
            $query->where('horarios.id_empleado', $empleado->id)
                  ->orderby('horarios.dias');
        }else if ($user->hasRole('Jefe-Academico') ) { 
            $query->where('horarios.id_empleado', $id)
                ->orderby('horarios.dias');
        } else if ($user->hasRole('super-admin') || $user->hasRole('Recurso-Humano')) {
            $query->where('horarios.id_empleado', $id)
                ->orderby('horarios.dias');
        } 
        
        $horarios = $query->get();
        return $horarios;
    }

}
