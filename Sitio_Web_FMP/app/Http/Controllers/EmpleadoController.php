<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Licencias\Empleado;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    function index(){
        
        $empleadoJefe = Empleado::where('jefe',null)->get();
        $todosLosEmpleados=Empleado::get();

        return view('Admin.empleados.empleado',compact('empleadoJefe','todosLosEmpleados'));
    }

    public function store (Request $request){
        try{

            $validator = Validator::make($request->all(),[
                'apellido' => 'required|max:20',
                'nombre' => 'required|max:25',
                'dui' => 'required|max:10',
                'nit' => 'required|max:40',
                'telefono' => 'required|max:9',
            ]);         

        if($validator->fails())
        {            
            return response()->json(['errors'=>$validator->errors()->all()]);
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
        
        return response()->json(['code'=>200, 'message'=>'Empleado añadido correctamente','data' => $empleado], 200);
        
        }catch(Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }


}
