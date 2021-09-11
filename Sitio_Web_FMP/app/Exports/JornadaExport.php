<?php

namespace App\Exports;

// use App\Models\Jornada\Jornada;
// use App\Models\Jornada\Periodo;
// use App\Models\User;
// use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Jornada\Jornada;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class JornadaExport implements FromView{
    public $periodo;

    public function __construct($periodo){
        $this->periodo = $periodo; // errro en en linea
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection(){
    //     return User::all();
    // }

    public function view(): View{

        $jornadas = Jornada::where('id_periodo', $this->periodo)
                            ->join('periodos as p', 'p.id', 'jornada.id_periodo')
                            ->where('tipo', 'Docente')
                            ->get();

        return view('Jornada.exports.jornadas', [
            'jornadas' => $jornadas,
            'periodo' => $this->periodo
        ]);
    }
}
