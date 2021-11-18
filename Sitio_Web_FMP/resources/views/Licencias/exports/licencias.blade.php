<table border="1">
    <thead>
        <tr>
            <th style="text-align: center; vertical-align: middle;" rowspan="2">N°</th>
            <th style="text-align: center; vertical-align: middle;" width='40' rowspan="2">NOMBRE</th>
            <th style="text-align: center; vertical-align: middle;" width='30' rowspan="2">TIEMPO DE CONTRATO</th>
            <th colspan="2" style="text-align: center; vertical-align: middle;">LUNES</th>
            <th colspan="2" style="text-align: center; vertical-align: middle;">MARTES</th>
            <th colspan="2" style="text-align: center; vertical-align: middle;">MIERCOLES</th>
            <th colspan="2" style="text-align: center; vertical-align: middle;">JUEVES</th>
            <th colspan="2" style="text-align: center; vertical-align: middle;">VERNES</th>
            <th colspan="2" style="text-align: center; vertical-align: middle;">SABADO</th>
            <th colspan="2" style="text-align: center; vertical-align: middle;">DOMINGO</th>
            <th  rowspan="2" style="text-align: center; vertical-align: middle;">TOTAL</th>
        </tr>
    </thead>
    <tbody>
    @foreach($jornadas as $index => $item)

        <tr>
            <td style="text-align: center; vertical-align: middle;" rowspan="2">{{ ($index+1) }}</td>
            <td style="text-align: center; vertical-align: middle;" rowspan="2">{{ $item->empleado_rf->nombre }} {{ $item->empleado_rf->apellido }}</td>
            <td style="text-align: center; vertical-align: middle;" rowspan="2">{{ $item->empleado_rf->tipo_jornada_rf->tipo }}</td>

            <td style="text-align: center; vertical-align: middle;">{{ $valores->hora_inicio }}</td>
            <td style="text-align: center; vertical-align: middle;">{{ $valores->hora_fin }}</td>                
        </tr>
    @endforeach
    </tbody>
</table>
