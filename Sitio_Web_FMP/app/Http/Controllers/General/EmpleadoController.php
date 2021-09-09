<?php

namespace App\Http\Controllers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tipo_Contrato;
use App\Models\Tipo_Jornada;
use App\Models\General\Empleado;
use App\Models\General\CategoriaEmpleado;
use App\Models\Horarios\Departamento;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    function index(){
        
        $categorias=CategoriaEmpleado::all();
        $departamentos=Departamento::get();
        $tcontrato=Tipo_Contrato::get();
        $tjornada=Tipo_Jornada::get();

        $empleados = Empleado::
          join('categoria_empleados','categoria_empleados.id','=','empleado.categoria')
        ->join('tipo_contrato','tipo_contrato.id','=','empleado.id_tipo_contrato')
        ->join('tipo_jornada','tipo_jornada.id','=','empleado.id_tipo_jornada')
        ->join('departamentos','departamentos.id','=','empleado.id_depto')
        ->select('empleado.*', 'categoria_empleados.categorias','tipo_contrato.tipo'
                ,'tipo_jornada.tipo','departamentos.nombre_departamento')
        ->get();
        echo dd($empleados);

        return view('Admin.empleados.empleado',
        compact('empleados','departamentos','tjornada','tcontrato','categorias'));
    }

    public function store (Request $request){
  

        $validator = Validator::make($request->all(),[
            'nombre' => 'required|max:25',
            'apellido' => 'required|max:20',
            'dui' => 'required|max:10',
            'nit' => 'required|max:40',
            'telefono' => 'required|max:9',
            'categoria' => 'required',
            'tipo_contrato' => 'required',
            'tipo_jornada' => 'required',
            'departamento' => 'required',
            //'jefe' => 'required',
        ]);         

        echo dd($request);

        if($validator->fails())
        {            
            return response()->json(['error'=>$validator->errors()->all()]);
            
        }

        $empleado = Empleado::updateOrCreate([
            'nombre'=>$request->nombre,
            'apellido'=>$request->apellido,
            'dui'=>$request->dui,
            'nit'=>$request->nit,
            'telefono'=>$request->telefono,
            'categoria'=>$request->categoria,
            'id_tipo_contrato'=>$request->tipo_contrato,
            'id_tipo_jornada'=>$request->tipo_jornada,
            'id_depto'=>$request->departamento,
            //'jefe'=>$request->jefe,
            'estado' =>true,
        ]);
        
        return response()->json(['code'=>200, 'mensaje'=>'Registro exitoso','data' => $empleado], 200);
    }

    public function categoriaStore(Request $request){
        $validator = Validator::make($request->all(),[
            'categoria' => 'required|min:2',
        ]);         

        if($validator->fails())
        {            
            return response()->json(['error'=>$validator->errors()->all()]);
            
        }
        
        $cat = $request->_id != null ? CategoriaEmpleado::findOrFail($request->_id):new CategoriaEmpleado;
        $cat -> categoria = $request->categoria;
        $cat -> save();
        return response()->json(['code'=>200, 'mensaje'=>'Categoria añadido correctamente','data' => $cat], 200);        
    }

    public function categoriaDestroy(Request $request){
        $emp = Empleado::where('categoria',$request->_id)->get();
        if(count($emp)>0){
            return response()->json(['error'=>[0,'No se puede eliminar esta categoria']]);
        }else{
            $cat = CategoriaEmpleado::destroy($request->_id);
            return response()->json(['code'=>200, 'mensaje'=>'Categoria eliminada ']);
        }
    }

    public function categoriaGet(){
        return CategoriaEmpleado::select('id','categoria')->get()->toJSON();
    }

}
