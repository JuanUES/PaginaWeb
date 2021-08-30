<?php

namespace App\Http\Controllers\RolesUsuarios;

use App\Models\User;
use App\Models\Licencias\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
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
       
        $validator = Validator::make($request->all(),[
            'usuario' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:users',
            'contraseña' => ['required', 'confirmed', Rules\Password::min(8)],
            'empleado' => 'required',
            'repetir_contraseña'=> 'required|same:contraseña',
        ]);

        if($validator->fails())
        {            
            return response()->json(['error'=>$validator->errors()->all()]);                
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


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
