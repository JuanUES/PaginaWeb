<?php

namespace App\Http\Controllers;

use App\Models\Jornada\Jornada;
use App\Models\Jornada\JornadaItem;
use App\Models\Jornada\Periodo;
use App\Models\Tipo_Jornada;
use App\Models\Licencias\Empleado;
use App\Models\Horarios\Departamento;
use Illuminate\Http\Request;

class JornadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jornada = Jornada::join('periodos','jornada.id_periodo','=','periodos.id')
        ->join('empleado','jornada.id_emp','=','empleado.id')
        ->select('jornada.id', 'empleado.id AS empleado', 
                 Periodo::raw("concat(to_char(periodos.fecha_inicio, 'dd/TMMonth/yy') , ' - ', to_char(periodos.fecha_fin, 'dd/TMMonth/yy')) as periodo"),
                 'jornada.estado')
        ->where('empleado.id' ,'=', 1)
        ->get();

        $depto = Departamento::get();

        $empJefe = JornadaController::getEmpleJefe();



        return view('Jornada.index', compact('jornada', 'depto','empJefe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periodos = Periodo::where('estado', 'LIKE','%activo%')->get();
        $tjornada = Tipo_Jornada::join('empleado', 'tipo_jornada.id','=','empleado.id_tipo_jornada')
        ->select('empleado.id','tipo_jornada.horas_semanales')
        ->where('empleado.id', '=',1)
	    ->get();
        return view('Jornada.create', compact('periodos','tjornada'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->except('items');
        $items = json_decode($request->items);

        $jornada = Jornada::create($requestData);
        if (is_array($items) || is_object($items)){
            foreach ($items as $key => $value) { //para guardar los items del jornada
                JornadaItem::create([
                    'id_jornada' => $jornada->id,
                    'dia' => $value->dia,
                    'hora_inicio' => $value->hora_inicio,
                    'hora_fin' => $value->hora_fin,
                ]);
            }
        }
        
        return redirect('/admin/jornada/')->with('flash_message', 'Agregado');

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
    public function edit($id)
    {
        $jornadas = Jornada::findOrFail($id);
        return view('Jornada.edit', compact('jornadas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $requestData = $request->except('items');
        $items = json_decode($request->items);
        $jornadas = Jornada::findOrFail($id);
        $jornadas->update($requestData);


        //para comprobar si se ha eliminado algun item
        $items_DB = JornadaItem::select('id')->where('id_jornada', $jornadas->id)->get();


        //para actualizar los cambios en los items del presupuesto
        foreach ($items as $key => $value) { //para guardar los items del presupuesto

            $data = [
                'dia' => $value->dia,
                'hora_inicio' => $value->hora_inicio,
                'hora_fin' => $value->hora_fin,
                'id_jornada' => $jornadas->id,
                'estado' => 'activo',
            ];

            if(isset($value->id) && !empty($value->id)){// para editar el registro si existe ese dato
                $item = JornadaItem::findOrFail($value->id);
                $item->update($data);
                //para exluirlo de eliminarlo
                $items_DB->forget($key);
            }else{// para crear el registro al no existir el id
                JornadaItem::create($data);
            }

        }

        //para eliminar los items que no vienen y que han sio elimnados por el usuario
        foreach ($items_DB as $key => $value) {
            $item = JornadaItem::findOrFail($value->id);
            $item->update([
                'estado' => 'inactivo'
            ]);
        }


        return redirect('Jornada.index')->with('flash_message', 'Jornada Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jornada $jornada)
    {
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

    public function getDepto($id){
        $empleadoDepto = Empleado::join('departamentos','empleado.id_depto','=','departamentos.id')
        ->select('empleado.id', 'empleado.nombre', 'empleado.apellido', 'departamentos.nombre_departamento')
        ->where('empleado.id_depto', '=', $id)
        ->get();
        return redirect('admin/jornada/' . $id)->with('flash_message', 'Datos encontrados');
    }

    public function getEmpleJefe(){
        $empleadoJefe = Empleado::join('departamentos','empleado.id_depto','=','departamentos.id')
        ->select('empleado.id', 'empleado.nombre', 'empleado.apellido', 'departamentos.nombre_departamento')
        ->where('empleado.jefe', '=', 1)
        ->get();
        return $empleadoJefe;
    }

    
}
