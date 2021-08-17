<?php

namespace App\Http\Controllers\RolesUsuarios;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Licencias\Empleado;
use App\Models\Horarios\Departamento;
use Illuminate\Support\Facades\Validator;

class RolesUsuariosController extends Controller
{
    function index(){
        
        $empleadoJefe = Empleado::where('jefe',null)->get();
        $todosLosEmpleados=Empleado::get();
        $departamentos=Departamento::get();

        return view('Admin.Roles.RolesUsuarios',compact('empleadoJefe','todosLosEmpleados','departamentos'));
    }

    function store(Request $request){

        $validator = Validator::make($request->all(),[
            'apellido' => 'required|max:20',
            'nombre' => 'required|max:25',
            'dui' => 'required|max:10',
            'nit' => 'required|max:40',
            'telefono' => 'required|max:9',
        ]);         
        
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
