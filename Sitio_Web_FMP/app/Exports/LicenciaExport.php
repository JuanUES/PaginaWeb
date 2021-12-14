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

    public function __construct(/*$tipo_contrato,*/ $anio, $mes, $departamento, $comentario){
        $this->anio = $anio;
        $this->mes = $mes;

        //$this->tipo_contrato  = $tipo_contrato;
        $this->departamento = $departamento;
        $this->comentario = $comentario;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View{
        $query = "select TRIM(e.apellido)||','||TRIM(e.nombre) as nombre,
        null as hrs_inpunt,null as hrs_inasis,null as hrs_descont,
        
        (select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_lc_gs
        from permisos  where empleado = e.id and estado like '%Aceptado%'
        and tipo_permiso like '%LC/GS%'
        and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
        and to_char(fecha_uso,'MM')::int=". $this->mes ."),
        
        (select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_ls_gs
        from permisos where empleado = e.id and estado like '%Aceptado%' and tipo_permiso like '%LS/GS%'
        and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
        and to_char(fecha_uso,'MM')::int=". $this->mes ."),
        
        (select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_l_ofic from permisos
        where empleado = e.id and estado like '%Aceptado%' and
        (tipo_permiso like '%L.OFICIAL/A%' or tipo_permiso like '%L OFICIAL%')
        and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
        and to_char(fecha_uso,'MM')::int=". $this->mes ."),
        
        (select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_t_comp
        from permisos where empleado = e.id and estado like '%Aceptado%' and tipo_permiso like '%T COMP%'
        and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
        and to_char(fecha_uso,'MM')::int=". $this->mes ."),
        
        (select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_incap
        from permisos where empleado = e.id and estado like '%Aceptado%' and
        (tipo_permiso like '%INCAP%' or tipo_permiso like '%INCAPACIDAD/A%')
        and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
        and to_char(fecha_uso,'MM')::int=". $this->mes ."),
        
        (select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_lc_gs_jd
        from permisos where empleado = e.id and estado like '%Aceptado%' and
        (tipo_permiso like '%FUMIGACIÓN%' or tipo_permiso like '%ESTUDIO%' or tipo_permiso like '%OTROS%')
        and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
        and to_char(fecha_uso,'MM')::int=". $this->mes ."),
        
        (select count(*) cant_olvido
        from permisos where empleado = e.id and estado like '%Aceptado%' and
        tipo_permiso like '%Const. olvido%'
        and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
        and to_char(fecha_uso,'MM')::int=". $this->mes ."),
        
        (select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_paternidad_duelo
        from permisos where empleado = e.id and estado like '%Aceptado%' and
        tipo_permiso like '%DUELO O PATERNIDAD%'
        and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
        and to_char(fecha_uso,'MM')::int=". $this->mes ."),
        
        CASE WHEN (". $this->mes .">1) THEN
           (select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_lc_gs_ant
           from permisos where empleado = e.id
                  and permisos.estado like '%Aceptado%'
                  and tipo_permiso like '%LC/GS%'
                  and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
                  and to_char(fecha_uso,'MM')::int=(". $this->mes ."-1))
            ELSE
            (select '00:00' hrs_lc_gs_ant)
        END,
        
        (select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_lc_gs_acu
            from permisos  where empleado = e.id  and permisos.estado like '%Aceptado%' and
            tipo_permiso like '%LC/GS%' and to_char(fecha_uso,'YYYY')::int=". $this->anio ." and
            to_char(fecha_uso,'MM')::int<=". $this->mes ."),
        
        lcg.anuales||':00' hrs_lc_gs_anuales,
        
        (select (lcg.anuales::int-to_char(sum(hora_final-hora_inicio),'HH24')::int)||':'||to_char(sum(hora_final-hora_inicio),'MI')::int
            hrs_disp from permisos where empleado = e.id and permisos.estado like 'Aceptado' and
        tipo_permiso like '%LC/GS%' and to_char(fecha_uso,'YYYY')::int=". $this->anio ." group by lcg.anuales)
        
        from empleado e
        
        inner join tipo_jornada tj on e.id_tipo_jornada = tj.id
        inner join licencia_con_goses lcg on tj.id = lcg.id_tipo_jornada
        where e.id_depto=". $this->departamento ."
        group by e.nombre,e.apellido, lcg.anuales,e.id
        order by e.apellido asc;
        ";

        $query=trim($query);

        $permisos_mensual = DB::select($query);
        
        $depto = DB::table('departamentos')
            ->select('nombre_departamento')
            ->where('id',$this->departamento)
            ->first();

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
    /*select TRIM(e.apellido)||','||TRIM(e.nombre) as nombre,
null as hrs_inpunt,null as hrs_inasis,null as hrs_descont,

(select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_lc_gs
from permisos  where empleado = e.id and estado like '%Aceptado%'
and tipo_permiso like '%LC/GS%'
and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
and to_char(fecha_uso,'MM')::int=". $this->mes ."),

(select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_ls_gs
from permisos where empleado = e.id and estado like '%Aceptado%' and tipo_permiso like '%LS/GS%'
and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
and to_char(fecha_uso,'MM')::int=". $this->mes ."),

(select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_l_ofic from permisos
where empleado = e.id and estado like '%Aceptado%' and
(tipo_permiso like '%L.OFICIAL/A%' or tipo_permiso like 'L OFICIAL')
and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
and to_char(fecha_uso,'MM')::int=". $this->mes ."),

(select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_t_comp
from permisos where empleado = e.id and estado like '%Aceptado%' and tipo_permiso like '%T COMP%'
and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
and to_char(fecha_uso,'MM')::int=". $this->mes ."),

(select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_incap
from permisos where empleado = e.id and estado like '%Aceptado%' and
(tipo_permiso like '%INCAP%' or tipo_permiso like '%INCAPACIDAD/A%')
and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
and to_char(fecha_uso,'MM')::int=". $this->mes ."),

(select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_lc_gs_jd
from permisos where empleado = e.id and estado like '%Aceptado%' and
(tipo_permiso like '%FUMIGACIÓN%' or tipo_permiso like '%ESTUDIO%' or tipo_permiso like '%OTROS%')
and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
and to_char(fecha_uso,'MM')::int=". $this->mes ."),

(select count(*) cant_olvido
from permisos where empleado = e.id and estado like '%Aceptado%' and
tipo_permiso like '%Const. olvido%'
and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
and to_char(fecha_uso,'MM')::int=". $this->mes ."),

(select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_paternidad_duelo
from permisos where empleado = e.id and estado like 'Aceptado' and
tipo_permiso like 'DUELO O PATERNIDAD'
and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
and to_char(fecha_uso,'MM')::int=". $this->mes ."),

CASE WHEN (". $this->mes .">1) THEN
   (select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_lc_gs_ant
   from permisos where empleado = e.id
          and permisos.estado like 'Aceptado'
          and tipo_permiso like 'LC/GS'
          and to_char(fecha_uso,'YYYY')::int=". $this->anio ."
          and to_char(fecha_uso,'MM')::int=(". $this->mes ."-1))
    ELSE
    (select '00:00' hrs_lc_gs_ant)
END,

(select to_char(sum(hora_final-hora_inicio),'HH24:MI') hrs_lc_gs_acu
    from permisos  where empleado = e.id  and permisos.estado like 'Aceptado' and
    tipo_permiso like 'LC/GS' and to_char(fecha_uso,'YYYY')::int=". $this->anio ." and
    to_char(fecha_uso,'MM')::int<=". $this->mes ."),

lcg.anuales||':00' hrs_lc_gs_anuales,

(select (lcg.anuales-to_char(sum(hora_final-hora_inicio),'HH24')::int)||':'||to_char(sum(hora_final-hora_inicio),'MI')
   hrs_lc_gs_disp from permisos where empleado = e.id and permisos.estado like 'Aceptado' and
tipo_permiso like 'LC/GS' and to_char(fecha_uso,'YYYY')::int=". $this->anio ." group by lcg.anuales)

from empleado e

inner join tipo_jornada tj on e.id_tipo_jornada = tj.id
inner join licencia_con_goses lcg on tj.id = lcg.id_tipo_jornada
where e.id_depto=5
group by e.nombre,e.apellido, lcg.anuales,e.id
order by e.apellido asc;

     */
}
