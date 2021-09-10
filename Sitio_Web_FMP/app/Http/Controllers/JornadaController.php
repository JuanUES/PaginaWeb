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
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class JornadaController extends Controller{
    public $modulo = 'Jornadas';

    public $rules = [
        'id_emp' => 'required|integer',
        'id_periodo' => 'required|integer',
        // 'items' => 'required|array',
    ];

    public $messages = [
        'id_emp.requiered' => 'Seleccione un empleado'
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

        $periodo = isset($request->periodo) ? $request->periodo : false;
        $depto = isset($request->depto) ? $request->depto : false;
        // $idDocente = User::findOrFail(auth()->id());

        $query = Jornada::join('periodos','jornada.id_periodo','periodos.id')
                ->join('empleado','jornada.id_emp','empleado.id')
                ->select('jornada.*',Periodo::raw("concat(to_char(periodos.fecha_inicio, 'dd/TMMonth/yy') , ' - ', to_char(periodos.fecha_fin, 'dd/TMMonth/yy')) as periodo"),'empleado.id as idEmp');

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

        ($depto!=false && strcmp($depto, 'all')!=0)
                            ? $query->where('empleado.id_depto', $depto)
                            : $depto = 'all';

        $jornadas = $query->get();
        // $jornadaDocente = $query2->get();
        // $jornadaJefe = $query3->get();

        $deptos = Departamento::where('estado', true)->latest()->get();
        // $docente = Empleado::join('users','empleado.id','users.empleado')
        //                     ->select('empleado.nombre as nombre','empleado.apellido as apellido','empleado.id as id')
        //                     ->where('users.empleado', $idDocente->empleado )->get();
        $empleados = Empleado::where('estado', true)->get();
        // $empleadosJefe = Empleado::where('empleado.jefe', $idDocente->empleado)->get();
        $periodos = Periodo::where('estado', 'activo')->latest()->get();

        return view('Jornada.index', compact('periodos','jornadas', 'deptos',  'empleados','periodos', 'periodo', 'depto'));
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
        // dd($request);

        try {
            $validator = Validator::make($request->all(), $this->rules, $this->messages);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }
            $requestData = $request->except('items');
            $items = json_decode($request->items);

            $requestData = $request->except(['_id']);
            if (strcmp($request->_id, '') == 0) {
                $msg = 'Registro exitoso.';
                // $periodo = Periodo::create($requestData);

                // dd($request);
                $periodo = Periodo::findOrFail($request->id_periodo);
                $empleado = Empleado::findOrFail($request->id_emp);
                // $jefe = $empleado->jefe_rf;

                // if(!is_null($jefe)){
                //     $usuario_jefe = $jefe->usuario_rf->email;
                // }

                $jornada = Jornada::create($requestData);

                // // dd(Auth::user()->id);

                // //notificacion de jornada enviada al mismo empleado

                // Notificaciones::create([
                //     'usuario_id' => Auth::user()->id,
                //     'mensaje' => 'La jornada para el período '. $periodo->titulo .' ha sido enviada a la Jefatura',
                //     'tipo' => 'Jornada',
                // ]);


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

                Utilidades::fnSaveBitacora('Nueva Jornada #: ' . $jornada->id, 'Registro', $this->modulo);
            } else {
                // $msg = 'Modificación exitoso.';
                // $jornadas = Jornada::findOrFail($id);
                // $jornadas->update($requestData);

                // $items_DB = JornadaItem::select('id')->where('id_jornada', $jornadas->id)->get();

                // foreach ($items as $key => $value) {

                //     $data = [
                //         'dia' => $value->dia,
                //         'hora_inicio' => $value->hora_inicio,
                //         'hora_fin' => $value->hora_fin,
                //         'id_jornada' => $jornadas->id,
                //         'estado' => 'activo',
                //     ];

                //     if(isset($value->id) && !empty($value->id)){
                //         $item = JornadaItem::findOrFail($value->id);
                //         $item->update($data);
                //         $items_DB->forget($key);
                //     }else{
                //         JornadaItem::create($data);
                //     }

                // }

                // //para eliminar los items que no vienen y que han sio elimnados por el usuario
                // foreach ($items_DB as $key => $value) {
                //     $item = JornadaItem::findOrFail($value->id);
                //     $item->delete();
                // }


                // Utilidades::fnSaveBitacora('Jornada #: ' . $periodo->id . ' Título: ' . $periodo->titulo, 'Modificación', $this->modulo);
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
    public function show(Jornada $jornada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $periodos = Periodo::where('estado', 'LIKE','%activo%')->get();
        $tjornada = Tipo_Jornada::join('empleado', 'tipo_jornada.id','=','empleado.id_tipo_jornada')
            ->select('empleado.id','tipo_jornada.horas_semanales')
            ->where('empleado.id', '=',1)
            ->get();
        $jornadas = Jornada::findOrFail($id);
        return view('Jornada.edit', compact('jornadas','periodos','tjornada'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id){
        $requestData = $request->except('items');
        $items = json_decode($request->items);
        $jornadas = Jornada::findOrFail($id);
        $jornadas->update($requestData);

        $items_DB = JornadaItem::select('id')->where('id_jornada', $jornadas->id)->get();

        foreach ($items as $key => $value) {

            $data = [
                'dia' => $value->dia,
                'hora_inicio' => $value->hora_inicio,
                'hora_fin' => $value->hora_fin,
                'id_jornada' => $jornadas->id,
                'estado' => 'activo',
            ];

            if(isset($value->id) && !empty($value->id)){
                $item = JornadaItem::findOrFail($value->id);
                $item->update($data);
                $items_DB->forget($key);
            }else{
                JornadaItem::create($data);
            }

        }

        //para eliminar los items que no vienen y que han sio elimnados por el usuario
        foreach ($items_DB as $key => $value) {
            $item = JornadaItem::findOrFail($value->id);
            $item->delete();
        }


        return redirect('admin/jornada/')->with('flash_message', 'Jornada Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jornada $jornada){
        //
    }

    public function getDetalle($id){
        $detalle = Jornada::join('jornada_items','jornada.id','=','jornada_items.id_jornada')
        ->join('periodos','jornada.id_periodo','=','periodos.id')
        ->join('empleado','jornada.id_emp','=','empleado.id')
        ->select('jornada.id', 'empleado.id AS empleado',
                Periodo::raw("concat(to_char(periodos.fecha_inicio, 'dd/TMMonth/yy') , ' - ', to_char(periodos.fecha_fin, 'dd/TMMonth/yy')) as periodo"),
                JornadaItem::raw("jornada_items.dia as dia, CONCAT(jornada_items.hora_inicio , ' - ' , jornada_items.hora_fin) AS detalle"))
        ->where('jornada.id' ,'=', $id)
        ->get();
        return $detalle;
    }

    public function getEmpleadoJornada($id){
        $empleado = Empleado::findOrFail($id);
        return $empleado->tipo_jornada_rf;
    }

    public function export(){
        $periodo = 4;
        return Excel::download(new JornadaExport($periodo), 'jornada.xlsx');

        // $jornadas = Jornada::all();
        // return view('Jornada.exports.jornadas', compact('jornadas', 'periodo'));
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
                // $usuario_jefe = $jefe->usuario_rf;
            }



            // dd(Auth::user()->id);

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

}
