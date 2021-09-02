<?php

namespace App\Http\Controllers\RolesUsuarios;

use App\Models\User;
use App\Models\Licencias\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;


class UsuariosController extends Controller
{
    
    public function index()
    {
        $usuarios = User::all();
        $empleados = Empleado::all();
        return view('Admin.Sesion.Usuarios',compact('usuarios','empleados'));
    }

    public function store(Request $request)
    {
        for ($i=0; $i < count($request->roles); $i++) { 
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln(base64_decode($request->roles[$i]));
        }
       
        $validator = Validator::make($request->all(),[
            'usuario' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:users,email',
            'contraseña' =>'required|min:8',
            'repetir_contraseña'=> 'required|same:contraseña'
        ]);

        if($validator->fails())
        {            
            return response()->json(['error'=>$validator->errors()->all()]);                
        }

        $user = new User();
        $user -> name     = $request -> usuario;
        $user -> email    = $request -> correo;
        $user -> password = Hash::make($request->contraseña);
        $user -> save();
        //echo dd($user);

        return $request->_id != null ?
            response()->json(['mensaje'=>'Modificación exitosa.']):
            response()->json(['mensaje'=>'Registro exitoso.']);
    }

    public function estado(Request $request){
        
    }

    public function roles(Request $request){
        
    }

    public function destroy(Request $request)
    {
        User::destroy($request->_id);
    }
}
