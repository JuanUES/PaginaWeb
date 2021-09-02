<?php

namespace App\Http\Controllers\RolesUsuarios;

use App\Models\User;
use App\Models\Licencias\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    
    public function index()
    {
        $usuarios = User::all();
        $empleados = Empleado::all();
        return view('Admin.Sesion.Usuarios',compact('usuarios','empleados'));
    }

    public function usuario(Request $request){        
        return User::findOrFail($request->id);
    }

    public function store(Request $request)
    {       
        $validator = Validator::make($request->all(),[
            'usuario' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:users,email',
            'contraseña' =>'required|min:8',
            //'empleado' => 'required|unique:users,empleado',
            'repetir_contraseña'=> 'required|same:contraseña'
        ]);

        if($validator->fails())
        {            
            return response()->json(['error'=>$validator->errors()->all()]);                
        }

        if($request -> idUser == null)
            $user = new User();
        else{
            $user = User::findOrFail($request -> idUser);
            $user -> roles() -> detach();
        }
        
        $user -> name     = $request -> usuario;
        $user -> email    = $request -> correo;
        $user -> password = Hash::make($request->contraseña);
        $b = $user -> save(); 

        $roles = $request -> roles;

        if($b)
            for ($i=0; $i < count($roles); $i++){
                $user -> assignRole(base64_decode($roles[$i]));
            }

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
