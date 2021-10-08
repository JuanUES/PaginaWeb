<?php

namespace App\Http\Controllers\Licencias;

use App\Http\Controllers\Controller;
use App\Models\Licencias\Licencia_con_gose;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LicenciasGosesController extends Controller
{
    public function index(){
        $tipo_jornada = DB::table('tipo_jornada')->get();
        $ver =DB::table('licencia_con_goses')
        ->join('tipo_jornada', 'licencia_con_goses.id_tipo_jornada', '=', 'tipo_jornada.id')
        ->select('licencia_con_goses.*', 'tipo_jornada.tipo')
        ->where('tipo_jornada.estado',"activo")
        ->get();
        //echo dd($ver);
        return view('Licencias.LicenciasGS',compact('tipo_jornada','ver'));
    }

    //CODIGO PARA INSERTAR, MODIFICAR
    public function create(Request $request){
        try{
           
            $validator = Validator::make($request->all(),[
                'jornada'          => 'required',
                'horas_anuales'    => 'required|numeric',
                'horas_mensuales'  => 'required|numeric',
            ]);         

            if($validator->fails())
            {            
                return response()->json(['error'=>$validator->errors()->all()]);                
            }

            $gs = $request->_id ==null ? new Licencia_con_gose():Licencia_con_gose::findOrFail($request->_id);
            $gs-> anuales         = $request->horas_anuales;
            $gs-> mensuales       = $request->horas_mensuales; 
            $gs-> id_tipo_jornada = $request->jornada;
            $gs -> save();         
        
            return $request->_id != null?response()->json(['mensaje'=>'Modificación exitosa.']):response()->json(['mensaje'=>'Registro exitoso.']);
        
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }//fin create

    //FIN DEL CODIGO PARA INSERTAR, MODIFICAR
}
