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
        
        $empleados=Empleado::all();
        $departamentos=Departamento::get();
        $tcontrato=Tipo_Contrato::get();
        $tjornada=Tipo_Jornada::get();
        $categorias = CategoriaEmpleado::all();

        return view('Admin.empleados.empleado',
        compact('empleados','departamentos','tjornada','tcontrato','categorias'));
    }

    public function store (Request $request){
  

        $validator = Validator::make($request->all(),[
            'apellido' => 'required|max:20',
            'nombre' => 'required|max:25',
            'dui' => 'required|max:10',
            'nit' => 'required|max:40',
            'telefono' => 'required|max:9',
        ]);         

        echo dd($request);

        if($validator->fails())
        {            
            return response()->json(['error'=>$validator->errors()->all()]);
            
        }

        $empleado = Empleado::updateOrCreate([
            'apellido'=>$request->apellido,
            'nombre'=>$request->nombre,
            'dui'=>$request->dui,
            'nit'=>$request->nit,
            'telefono'=>$request->telefono,
            'estado' =>true,
            'jefe'=>$request->jefe,
        ]);
        
        return response()->json(['code'=>200, 'mensaje'=>'Empleado añadido correctamente','data' => $empleado], 200);
    }

    public function categoriaStore(Request $request){
        
        $cat = $request->_id != null ? CategoriaEmpleado::findOrFail($request->_id):new CategoriaEmpleado;
        $cat -> categoria = $request->categoria;
        $cat -> save();
        return response()->json(['code'=>200, 'mensaje'=>'Categoria añadido correctamente','data' => $cat], 200);        
    }

    public function categoriaDestroy($id){
        $emp = Empleado::where('categoria',$id)->get();
        if(count($emp)>0){
            return response()->json(['error'=>[0,'No se puede eliminar esta categoria']]);
        }else{
            return response()->json(['code'=>200, 'mensaje'=>'Categoria eliminada']);
        }
    }

    public function categoriaGet(){
        return CategoriaEmpleado::all()->toJSON();
    }

}
