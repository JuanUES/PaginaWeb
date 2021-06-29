<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Licencias\Empleado;
class EmpleadoController extends Controller
{
    function index(){
        
        $empleadoJefe = Empleado::where('jefe',null)->get();

        return view('Admin.empleados.empleado',compact('empleadoJefe'));
    }

    public function store (Request $request){

        /*$request->validate(['apellido' => 'required|max:20',
        'nombre' => 'required|max:25',
        'dui' => 'required|max:10',
        'nit' => 'required|max:40',
        'telefono' => 'required|max:9',
        ]);*/
        
        $empleado = Empleado::updateOrCreate(['apellido'=>$request->apellido,
            'nombre'=>$request->nombre,
            'dui'=>$request->dui,
            'nit'=>$request->nit,
            'telefono'=>$request->telefono,
            'estado' =>true,
            'tipo_jefe'=>$request->tipo_jefe,
            'jefe'=>$request->jefe,
        ]);

        return response()->json(['code'=>200, 'message'=>'Empleado añadido correctamente','data' => $empleado], 200);
    }


}
