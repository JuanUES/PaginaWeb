<table border="1">
    <thead>
        <tr></tr>
        <tr>
            <th></th>
            <th colspan="7" style="text-align: left; vertical-align: middle;"><strong>ASISTENCIA LABORAL: {{mb_strtoupper($mes,'UTF-8').' '.$anio}}</strong></th>
        </tr>
        <tr>
            <th></th>
            <th colspan="7" style="text-align: left; vertical-align: middle;">DEPARTAMENTO O SUBUNIDAD: {{mb_strtoupper($depto,'UTF-8')}}</th>
            <th colspan="18" style="text-align: left; vertical-align: middle;"></th>
            <th colspan="6" style="text-align: center; vertical-align: middle;">{{mb_strtoupper($comentario,'UTF-8')}}</th>
        </tr>
    </thead>
    <thead>        
        <tr>
            <th></th>
            <th style="text-align: center; vertical-align: middle;" rowspan="2">N</th>
            <th colspan="4" rowspan="2" style="text-align: left; vertical-align: middle; ">NOMBRE DEL EMPLEADO</th>  
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">Horas Impuntualidad</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">Horas Inasistencia</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">Horas a Descontar</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">Horas L.C/G.S</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">Horas L.S/G.S</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">Horas L. Oficiales</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">Tiempo Compensatorio</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">Horas de Incapacidad</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">L.C/G.S acuerdo de JD</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">Constancias Olvido de Marcaje</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">L.C/G.S Dúelo o Paternidad</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">Σ L.C/G.S Mes/Anterior</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">Σ L.C/G.S Acumuladas</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">L.C/G.S al Año</th>          
            <th colspan="2" rowspan="2" style="text-align: center; vertical-align: middle; word-wrap: break-word;">L.C/G.S Disponible</th>          
        </tr>
    </thead>
    <tbody>
        <tr></tr>
    @foreach($permisos_mensual as $index => $item)
        <tr>
            <td></td>
            <td style="text-align: center; vertical-align: middle; width:100%;">{{ ($index+1) }}</td>
            <td colspan="4" style="text-align: left; vertical-align: middle;">{{ $item->nombre}}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_inpunt==null?'00:00':$item->hrs_inpunt}}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_inasis==null?'00:00':$item->hrs_inasis}}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_descont==null?'00:00':$item->hrs_descont }}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_lc_gs==null?'00:00':$item->hrs_lc_gs }}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_ls_gs==null?'00:00':$item->hrs_ls_gs }}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_l_ofic==null?'00:00':$item->hrs_l_ofic }}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_t_comp==null?'00:00':$item->hrs_t_comp }}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_incap==null?'00:00':$item->hrs_incap }}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_lc_gs_jd==null?'00:00':$item->hrs_lc_gs_jd }}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->cant_olvido }}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_paternidad_duelo==null?'00:00':$item->hrs_paternidad_duelo }}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_lc_gs_ant==null?'00:00':$item->hrs_lc_gs_ant }}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_lc_gs_acu==null?'00:00':$item->hrs_lc_gs_acu }}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_lc_gs_anuales==null?'00:00':$item->hrs_lc_gs_anuales }}</td>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{ $item->hrs_disp}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
