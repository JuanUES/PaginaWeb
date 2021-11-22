<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class LicenciaExport implements FromView{
    public $tipo_contrato;
    public $anio;
    public $mes;
    public $departamento;
    public $comentario;

    public function __construct($tipo_contrato, $anio, $mes, $departamento, $comentario){
        $this->anio = $anio;
        $this->mes = $mes;
        $this->tipo_contrato  = $tipo_contrato;
        $this->departamento = $departamento;
        $this->mes_anio=$mes.'-'.$anio;
        $this->comentario = $comentario;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection(){
    //     return User::all();
    //return Excel::download(new JornadaExport($periodo->id, $depto), $titulo.'.xlsx');
    // }

    public function view(): View{
        $permisos_mensual = DB::select('select TRIM(e.apellido)||\',
        \'||TRIM(e.nombre) as nombre,null as hrs_inpunt,null as hrs_inasis,null as hrs_descont,
        to_char(sum(p1.hora_final-p1.hora_inicio),\'HH24:MI\') hrs_lc_gs,
        to_char(sum(p2.hora_final-p2.hora_inicio),\'HH24:MI\') hrs_ls_gs,
        to_char(sum(p3.hora_final-p3.hora_inicio),\'HH24:MI\') hrs_l_ofic,
        to_char(sum(p4.hora_final-p4.hora_inicio),\'HH24:MI\') hrs_t_comp,
        to_char(sum(p5.hora_final-p5.hora_inicio),\'HH24:MI\') hrs_incap,
        to_char(sum(p6.hora_final-p6.hora_inicio),\'HH24:MI\') hrs_lc_gs_jd,
        count(p7.*) cant_olvido,
        to_char(sum(p8.hora_final-p8.hora_inicio),\'HH24:MI\') hrs_paternidad_duelo, 
        '.($this->mes<2?'\'00:00\' hrs_lc_gs_ant':'(select to_char(sum(hora_final-hora_inicio),\'HH24:MI\') hrs_lc_gs_ant from empleado e1
        inner join permisos on empleado = e1.id and permisos.estado like \'Aceptado\' and tipo_permiso like \'LC/GS\'
        and to_char(fecha_uso,\'YYYY-MM\') like \''.($this->mes-1).'-'.$this->anio.'\' where e1.id=e.id)').',
        (select to_char(sum(hora_final-hora_inicio),\'HH24:MI\') hrs_lc_gs_acu from empleado e2
            inner join permisos  on empleado = e2.id and permisos.estado like \'Aceptado\' and
         tipo_permiso like \'LC/GS\' and to_char(fecha_uso,\'YYYY\')::int='.$this->anio.' where  e.id = e2.id), 
        lcg.anuales||\':00\' hrs_lc_gs_anuales, 
        (select lcg.anuales-to_char(sum(hora_final-hora_inicio),\'HH24\')::int||\':\'||to_char(sum(hora_final-hora_inicio),\'MI\')
            hrs_disp from empleado e3
            inner join permisos on empleado = e3.id and permisos.estado like \'Aceptado\' and
         tipo_permiso like \'LC/GS\' and to_char(fecha_uso,\'YYYY\')::int='.$this->anio.' where  e3.id = e.id)
        from empleado e
        left join permisos p1 on p1.empleado = e.id and p1.estado like \'Aceptado\' and p1.tipo_permiso like \'LC/GS\'
        and to_char(p1.fecha_uso,\'YYYY-MM\')=\''.$this->mes_anio.'\'
        left join permisos p2 on p2.empleado = e.id and p2.estado like \'Aceptado\' and p2.tipo_permiso like \'LS/GS\'
        and to_char(p2.fecha_uso,\'YYYY-MM\')=\''.$this->mes_anio.'\'
        left join permisos p3 on p3.empleado = e.id and p3.estado like \'Aceptado\' and
        (p3.tipo_permiso like \'L.OFICIAL/A\' or p3.tipo_permiso like \'L OFICIAL\')
        and to_char(p3.fecha_uso,\'YYYY-MM\')=\''.$this->mes_anio.'\'
        left join permisos p4 on p4.empleado = e.id and p4.estado like \'Aceptado\' and p4.tipo_permiso like \'T COMP\'
        and to_char(p4.fecha_uso,\'YYYY-MM\')=\''.$this->mes_anio.'\'
        left join permisos p5 on p5.empleado = e.id and p5.estado like \'Aceptado\' and
        (p5.tipo_permiso like \'INCAP\' or p5.tipo_permiso like \'INCAPACIDAD/A\')
        and to_char(p5.fecha_uso,\'YYYY-MM\')=\''.$this->mes_anio.'\'
        left join permisos p6 on p6.empleado = e.id and p6.estado like \'Aceptado\' and
        (p6.tipo_permiso like \'FUMIGACIÓN\' or p6.tipo_permiso like \'ESTUDIO\' or p6.tipo_permiso like \'OTROS\')
        and to_char(p6.fecha_uso,\'YYYY-MM\')=\''.$this->mes_anio.'\'
        left join permisos p7 on p7.empleado = e.id and p7.estado like \'Aceptado\' and
        p7.tipo_permiso like \'Const. olvido\' and to_char(p7.fecha_uso,\'YYYY-MM\')=\''.$this->mes_anio.'\'
        left join permisos p8 on p8.empleado = e.id and p8.estado like \'Aceptado\' and
        p8.tipo_permiso like \'DUELO O PATERNIDAD\' and to_char(p8.fecha_uso,\'YYYY-MM\')=\''.$this->mes_anio.'\'
        inner join tipo_jornada tj on e.id_tipo_jornada = tj.id
        inner join licencia_con_goses lcg on tj.id = lcg.id_tipo_jornada
        where e.id_tipo_contrato='.$this->tipo_contrato.' and e.id_depto='.$this->departamento.'
        group by e.nombre,e.apellido, lcg.anuales,e.id
        order by e.apellido,e.nombre asc;');
        $depto = DB::table('departamentos')->select('nombre_departamento')->where('id',$this->departamento)->first();
        $depto = $depto->nombre_departamento;
        $mes = $this->mes($this->mes);
        $anio = $this->anio;
        $comentario = $this->comentario;

        return view('Licencias.exports.licencias',compact('permisos_mensual','depto','mes','anio','comentario'));
    }

    protected function mes($mes){
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        return $meses[$mes-1];
    }

    /**CONSULTA PURA*/
    /*select TRIM(e.apellido)||','||TRIM(e.nombre) as nombre,null as hrs_inpunt,null as hrs_inasis,null as hrs_descont,
       to_char(sum(p1.hora_final-p1.hora_inicio),'HH24:MI') hrs_lc_gs,
       to_char(sum(p2.hora_final-p2.hora_inicio),'HH24:MI') hrs_ls_gs,
       to_char(sum(p3.hora_final-p3.hora_inicio),'HH24:MI') hrs_l_ofic,
       to_char(sum(p4.hora_final-p4.hora_inicio),'HH24:MI') hrs_t_comp,
       to_char(sum(p5.hora_final-p5.hora_inicio),'HH24:MI') hrs_incap,
       to_char(sum(p6.hora_final-p6.hora_inicio),'HH24:MI') hrs_lc_gs_jd,
       count(p7.*) cant_olvido,
       to_char(sum(p8.hora_final-p8.hora_inicio),'HH24:MI') hrs_paternidad_duelo,

       (select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_lc_gs_ant from empleado e1
           inner join permisos on empleado = e1.id and permisos.estado like 'Aceptado' and
       tipo_permiso like 'LC/GS' and to_char(fecha_uso,'YYYY-MM') like '2021-10' where e1.id=e.id),

       (select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_lc_gs_acu from empleado e2
           inner join permisos  on empleado = e2.id and permisos.estado like 'Aceptado' and
        tipo_permiso like 'LC/GS' and to_char(fecha_uso,'YYYY')::int=2021 where  e.id = e2.id),

       lcg.anuales||':00' hrs_lc_gs_anuales,

       (select lcg.anuales-to_char(sum(hora_final-hora_inicio),'HH24')::int||':'||to_char(sum(hora_final-hora_inicio),'MI')
           hrs_lc_gs_disp from empleado e3
           inner join permisos on empleado = e3.id and permisos.estado like 'Aceptado' and
        tipo_permiso like 'LC/GS' and to_char(fecha_uso,'YYYY')::int=2021 where  e3.id = e.id)
        from empleado e
        left join permisos p1 on p1.empleado = e.id and p1.estado like 'Aceptado' and p1.tipo_permiso like 'LC/GS'
        and to_char(p1.fecha_uso,'YYYY')::int=2021 and to_char(p1.fecha_uso,'MM')::int=11

        left join permisos p2 on p2.empleado = e.id and p2.estado like 'Aceptado' and p2.tipo_permiso like 'LS/GS'
        and to_char(p2.fecha_uso,'YYYY')::int=2021 and to_char(p2.fecha_uso,'MM')::int=11

        left join permisos p3 on p3.empleado = e.id and p3.estado like 'Aceptado' and
        (p3.tipo_permiso like 'L.OFICIAL/A' or p3.tipo_permiso like 'L OFICIAL')
        and to_char(p3.fecha_uso,'YYYY')::int=2021 and to_char(p3.fecha_uso,'MM')::int=11

        left join permisos p4 on p4.empleado = e.id and p4.estado like 'Aceptado' and p4.tipo_permiso like 'T COMP'
        and to_char(p4.fecha_uso,'YYYY')::int=2021 and to_char(p4.fecha_uso,'MM')::int=11

        left join permisos p5 on p5.empleado = e.id and p5.estado like 'Aceptado' and
        (p5.tipo_permiso like 'INCAP' or p5.tipo_permiso like 'INCAPACIDAD/A')
        and to_char(p5.fecha_uso,'YYYY')::int=2021 and to_char(p5.fecha_uso,'MM')::int=11

        left join permisos p6 on p6.empleado = e.id and p6.estado like 'Aceptado' and
        (p6.tipo_permiso like 'FUMIGACIÓN' or p6.tipo_permiso like 'ESTUDIO' or p6.tipo_permiso like 'OTROS')
        and to_char(p6.fecha_uso,'YYYY')::int=2021 and to_char(p6.fecha_uso,'MM')::int=11

        left join permisos p7 on p7.empleado = e.id and p7.estado like 'Aceptado' and
        p7.tipo_permiso like 'Const. olvido' and to_char(p7.fecha_uso,'YYYY')::int=2021 and to_char(p7.fecha_uso,'MM')::int=11

        left join permisos p8 on p8.empleado = e.id and p8.estado like 'Aceptado' and
        p8.tipo_permiso like 'DUELO O PATERNIDAD' and to_char(p8.fecha_uso,'YYYY')::int=2021 and to_char(p8.fecha_uso,'MM')::int=11

        inner join tipo_jornada tj on e.id_tipo_jornada = tj.id
        inner join licencia_con_goses lcg on tj.id = lcg.id_tipo_jornada
        where e.id_tipo_contrato=1 and e.id_depto=1

        group by e.nombre,e.apellido, lcg.anuales,e.id
        order by e.apellido,e.nombre asc;
     */
}
