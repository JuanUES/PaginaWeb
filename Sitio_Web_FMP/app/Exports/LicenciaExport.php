<?php

namespace App\Exports;

use App\Models\Jornada\Jornada;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LicenciaExport implements FromView{
    public $periodo;
    public $depto;

    public function __construct($periodo, $depto){
        $this->periodo = $periodo;
        $this->depto = $depto;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection(){
    //     return User::all();
    //return Excel::download(new JornadaExport($periodo->id, $depto), $titulo.'.xlsx');
    // }

    public function view(): View{
        $query = Jornada::select('jornada.*')
                        ->where('id_periodo', $this->periodo)
                        ->join('empleado', 'empleado.id', 'jornada.id_emp')
                        // ->join('periodos as p', 'p.id', 'jornada.id_periodo')
                        ->whereIn('jornada.procedimiento',['aceptado','enviado a recursos humanos'])
                        ->whereIn('tipo_empleado', ['Académico','Administrativo'] );

        if(!is_null($this->depto)){
            $query->where('empleado.id_depto', $this->depto);
        }

        $jornadas = $query->get();

        return view();
    }
}
