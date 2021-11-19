<?php

namespace App\Exports;

use App\Models\Licencias\Permiso;
use App\Models\General\Empleado;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LicenciaExport implements FromView{
    public $tipo_contrato;
    public $anio;
    public $mes;

    public function __construct($tipo_contrato, $anio, $mes){
        $this->tipo_contrato = $periodo;
        $this->anio = $anio;
        $this->mes = $mes;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection(){
    //     return User::all();
    //return Excel::download(new JornadaExport($periodo->id, $depto), $titulo.'.xlsx');
    // }

    public function view(): View{
        $query = Empleado::select('*')
            ->join('Permiso','Permiso.empleado','=','Empleado.id')
            ->where('Permiso.estado','like','Aceptado');

        return view('Licencias.exports.licencias',compact(''));
    }

    public function subSelect($query){
        
       
       
               
              to_char(fecha_uso,'YYYY')='2021') as hrs_lc_gs,
        return $query->selectRaw('(select to_char(sum(hora_final-hora_inicio),\'HH24:MI\')
        from permisos tipo_permiso like ?  where empleado=e.id and estado like 'Aceptado' and',[]);
    }
}
