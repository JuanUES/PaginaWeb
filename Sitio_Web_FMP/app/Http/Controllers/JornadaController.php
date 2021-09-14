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
        'items' => 'required|array|min:1'
        // 'items' => 'required|array',
    ];

    public $messages = [
        'id_emp.requiered' => 'Seleccione un empleado',
        'items.array' => 'La Jornada no puede ir vacia'
    ];

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $user = Auth::user();
        $cargar = true;
        $emp = null; //para terminar que es solo un empleado y poder determinar el tipo

        // dd($roles = $user->getRoleNames());


        // dd($user);

        $periodo = isset($request->periodo) ? $request->periodo : Periodo::select('id')->OrderBy('id', 'DESC')->first()->id;
        $depto = isset($request->depto) ? $request->depto : false;
        // $idDocente = User::findOrFail(auth()->id());


        // dd($periodo);


        $query = Jornada::join('periodos','jornada.id_periodo','periodos.id')
                ->join('empleado','jornada.id_emp','empleado.id')
                ->select('jornada.*',Periodo::raw("concat(to_char(periodos.fecha_inicio, 'dd/TMMonth/yy') , ' - ', to_char(periodos.fecha_fin, 'dd/TMMonth/yy')) as periodo"),'empleado.id as idEmp')
                ->where('id_periodo', $periodo);

        if(!$user->hasRole('super-admin') && !$user->hasRole('Recurso-Humano')){ // si no es jefe filtramos la informacion dependiendo de si es jefe o empleado normal

            //determinamos si tiene un empleado relacionado
            $empleado = $user->empleado_rf;

            if(is_null($empleado)){//para que muestre una alerta de que no existe un empleado relacionado con el usuario
                $query = null;
            }else{
                if($user->hasRole('Jefe-Academico')|| $user->hasRole('Jefe-Departamento')){//para filtrar por tipo de departamento
                    $depto = $empleado->id_depto;// id que servira para filtrar los empleados por departemento
                }else{ // con esto determinamos que es un empleado sin cargos de jefatura por lo cual solo se mostrara ese empleado
                    $query->where('empleado.id', $empleado->id);
                    $emp = $empleado;
                }

            }
            // dd($empleado);
        }


        // $query2 = Jornada::join('periodos','jornada.id_periodo','periodos.id')
        //         ->join('empleado','jornada.id_emp','empleado.id')
        //         ->select('jornada.*',Periodo::raw("concat(to_char(periodos.fecha_inicio, 'dd/TMMonth/yy') , ' - ', to_char(periodos.fecha_fin, 'dd/TMMonth/yy')) as periodo"),'empleado.id as idEmp')
        //         ->where('empleado.id', $idDocente->empleado);

        // $query3 = Jornada::join('periodos','jornada.id_periodo','periodos.id')
        //         ->join('empleado','jornada.id_emp','empleado.id')
        //         ->select('jornada.*',Periodo::raw("concat(to_char(periodos.fecha_inicio, 'dd/TMMonth/yy') , ' - ', to_char(periodos.fecha_fin, 'dd/TMMonth/yy')) as periodo"),'empleado.id as idEmp')
        //         ->where('empleado.jefe', $idDocente->empleado);


        // if( Auth::user()->hasRole('Jefe-Departamento') ){
        //     ($periodo!=false && strcmp($periodo, 'all')!=0)
        //     ? $query3->where('jornada.id_periodo', $periodo)
        //     : $periodo = 'all';
        // }else{
        //     ($periodo!=false && strcmp($periodo, 'all')!=0)
        //     ? $query->where('jornada.id_periodo', $periodo)
        //     : $periodo = 'all';
        // }


        if(is_null($query)){
            $cargar = false;
            $jornadas = [];
            $deptos = [];
            $periodos = [];
            // $empleados = [];
        }else{
            ($depto != false && strcmp($depto, 'all') != 0)
                ? $query->where('empleado.id_depto', $depto)
                : $depto = 'all';


            $jornadas = $query->get();
            $deptos = Departamento::where('estado', true)->latest()->get();
            $periodos = Periodo::where('estado', 'activo')->latest()->get();
            // $empleados = $this->fnEmpleadosSegunPeriodo($periodo);

        }




        // $jornadaDocente = $query2->get();
        // $jornadaJefe = $query3->get();

        // $docente = Empleado::join('users','empleado.id','users.empleado')
        //                     ->select('empleado.nombre as nombre','empleado.apellido as apellido','empleado.id as id')
        //                     ->where('users.empleado', $idDocente->empleado )->get();





        // $empleadosJefe = Empleado::where('empleado.jefe', $idDocente->empleado)->get();

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

        // dd($request->_id);

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
                $msg = 'Modificación exitoso.';


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
            $jornadas[$key]['jornada'] = intval($dateInterval->format('%H'));
        }
        $seguimiento = $jornada->seguimiento;

        return array('jornada' => $jornada, 'items' => $jornadas, 'seguimiento' => $seguimiento);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    // public function edit($id){
    //     $periodos = Periodo::where('estado', 'LIKE','%activo%')->get();
    //     $tjornada = Tipo_Jornada::join('empleado', 'tipo_jornada.id','=','empleado.id_tipo_jornada')
    //         ->select('empleado.id','tipo_jornada.horas_semanales')
    //         ->where('empleado.id', '=',1)
    //         ->get();
    //     $jornadas = Jornada::findOrFail($id);
    //     return view('Jornada.edit', compact('jornadas','periodos','tjornada'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request,$id){
    //     $requestData = $request->except('items');
    //     $items = json_decode($request->items);
    //     $jornadas = Jornada::findOrFail($id);
    //     $jornadas->update($requestData);

    //     $items_DB = JornadaItem::select('id')->where('id_jornada', $jornadas->id)->get();

    //     foreach ($items as $key => $value) {

    //         $data = [
    //             'dia' => $value->dia,
    //             'hora_inicio' => $value->hora_inicio,
    //             'hora_fin' => $value->hora_fin,
    //             'id_jornada' => $jornadas->id,
    //             'estado' => 'activo',
    //         ];

    //         if(isset($value->id) && !empty($value->id)){
    //             $item = JornadaItem::findOrFail($value->id);
    //             $item->update($data);
    //             $items_DB->forget($key);
    //         }else{
    //             JornadaItem::create($data);
    //         }

    //     }

    //     //para eliminar los items que no vienen y que han sio elimnados por el usuario
    //     foreach ($items_DB as $key => $value) {
    //         $item = JornadaItem::findOrFail($value->id);
    //         $item->delete();
    //     }


    //     return redirect('admin/jornada/')->with('flash_message', 'Jornada Actualizada!');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jornada $jornada){

    }

    // public function getDetalle($id){
    //     // $detalle = Jornada::join('jornada_items','jornada.id','=','jornada_items.id_jornada')
    //     // ->join('periodos','jornada.id_periodo','=','periodos.id')
    //     // ->join('empleado','jornada.id_emp','=','empleado.id')
    //     // ->select('jornada.id', 'empleado.id AS empleado',
    //     //         Periodo::raw("concat(to_char(periodos.fecha_inicio, 'dd/TMMonth/yy') , ' - ', to_char(periodos.fecha_fin, 'dd/TMMonth/yy')) as periodo"),
    //     //         JornadaItem::raw("jornada_items.dia as dia, CONCAT(jornada_items.hora_inicio , ' - ' , jornada_items.hora_fin) AS detalle"))
    //     // ->where('jornada.id' ,'=', $id)
    //     // ->get();
    //     // return $detalle;
    //     $jornada = Jornada::select('jornada.id','jornada.id_emp', 'jornada.id_periodo', 'jornada.created_at')
    //                     ->where('jornada.id', $id)
    //                     ->first();
    //     $items = $jornada->items;
    //     $jornadas = [];
    //     foreach ($items as $key => $value) {
    //         $fechaUno = new DateTime($value->hora_fin);
    //         $fechaDos = new DateTime($value->hora_inicio);
    //         $dateInterval = $fechaUno->diff($fechaDos);
    //         $jornadas[$key]['dia'] = $value->dia;
    //         $jornadas[$key]['hora_inicio'] = $value->hora_inicio;
    //         $jornadas[$key]['hora_fin'] = $value->hora_fin;
    //         $jornadas[$key]['jornada'] = intval($dateInterval->format('%H'));
    //     }

    //     $seguimiento = $jornada->seguimiento;

    //     return array('jornada'=>$jornada, 'items'=> $jornadas, 'seguimiento' => $seguimiento);
    // }

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
        } else if ($user->hasRole('super-admin') && $user->hasRole('Recurso-Humano')) {
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


            // dd($request);
            $jornada = Jornada::findOrFail($request->jornada_id);
            $jornada->update([
                'procedimiento' => $request->proceso,
            ]);
            $periodo = $jornada->periodo_rf;
            $empleado = $jornada->empleado_rf;
            $jefe = $empleado->jefe_rf;
            if (!is_null($jefe)) {
                $usuario = $jefe->usuario_rf;
                if(!is_null($usuario)){
                    Notificaciones::create([
                        'usuario_id' => Auth::user()->id,
                        'mensaje' => $empleado->nombre.' '.$empleado->apellido.' ha enviado la jornada para el período ' . $periodo->titulo,
                        'tipo' => 'Jornada'
                    ]);

                }
            }

            //notificacion de jornada enviada al mismo empleado
            Notificaciones::create([
                'usuario_id' => Auth::user()->id,
                'mensaje' => 'La jornada para el período ' . $periodo->titulo . ' ha sido enviada a la Jefatura',
                'tipo' => 'Jornada',
            ]);
            Seguimiento::create($request->all());

            // Utilidades::fnSaveBitacora('Nuevo Tipo #: ' . $tipo->id, 'Registro', $this->modulo);

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
    }

}
