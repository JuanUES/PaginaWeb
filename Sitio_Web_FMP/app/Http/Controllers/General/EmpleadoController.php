<?php

namespace App\Http\Controllers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tipo_Contrato;
use App\Models\Tipo_Jornada;
use App\Models\Licencias\Empleado;
use App\Models\Horarios\Departamento;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    function index(){
        
        $empleados=Empleado::all();
        $departamentos=Departamento::get();
        $tcontrato=Tipo_Contrato::get();
        $tjornada=Tipo_Jornada::get();

        return view('Admin.empleados.empleado',
        compact('empleados','departamentos','tjornada','tcontrato'));
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
            'tipo_jefe'=>$request->tipo_jefe,
            'jefe'=>$request->jefe,
        ]);
        
        return response()->json(['code'=>200, 'mensaje'=>'Empleado añadido correctamente','data' => $empleado], 200);
        
    
    }


}
